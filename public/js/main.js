function toggleMenu(){
    $( "#menu" ).toggle();
    $("#shoppingcart").hide();
}

function toggleShoppingCart() {
    renderCart();
    $("#shoppingcart").toggle();
    $("#menu").hide();
}

//<div class="line">
//    <div class="pc_name">The late spätig</div><div><input type="number" name="quantity" min="1" max="10"></div><div class="pc_name">0.99$</div>
//</div>

function renderCart() {
    $("#product_cart").html("");
    let products = getCart().products;
    for (let index in products) {
        let item = products[index];
        let line = document.createElement("div");
        line.className = "line";

        let name = document.createElement("div");
        name.className = "pc_name";
        name.innerHTML = item.name;
        line.appendChild(name);

        let quantity = document.createElement("div");
        quantity.innerHTML = '<input value="' + item.quantity + '" type="number" name="quantity" min="1" max="10">';
        quantity.className = "pc_quantity";
        quantity.onchange = function () {
            item.quantity = parseInt(quantity.getElementsByTagName('input')[0].value);
            localStorage.setItem('cart', '{"products": ' + JSON.stringify(products) + '}');
        };
        line.appendChild(quantity);

        let price = document.createElement("div");
        price.className = "pc_price";
        price.innerHTML = item.price;
        line.appendChild(price);

        let deleter = document.createElement("div");
        deleter.className = "pc_delete";
        deleter.innerHTML = '<i class="fas fa-ban"></i>';
        deleter.onclick = function () {
            products.splice(index, 1);
            localStorage.setItem('cart', '{"products": ' + JSON.stringify(products) + '}');
            renderCart();
        };
        line.appendChild(deleter);
        document.getElementById("product_cart").appendChild(line);

    }
}

function getCart() {
    let cart = localStorage.getItem('cart');
    if (cart == null) {
        localStorage.setItem('cart', '{"products": []}');
        cart = localStorage.getItem('cart');
    }
    cart = JSON.parse(cart);
    return cart;
}

function addToCart(json_product) {
    let cart = getCart();
    if (json_product.quantity == null) {
        json_product.quantity = 1;
    }
    cart.products.push(json_product);
    localStorage.setItem('cart', JSON.stringify(cart));
}

$(document).ready(function () {
    //Checks if there is an entry in the local stroage for the shopping cart
    let cart = getCart();

    //This functions loops after load trough every a element in #content and searches for -data-background attribute for loading background images
    $('#content .container').children('a').each(function () {
        if ($(this).attr("data-background") !== undefined) {
            $(this).css('background-image', "url(" + $(this).attr("data-background") + ")");

        }
        if ($(this).attr("data-product") !== undefined) {
            $(this).click(function () {
                $('#product_overview > .row').hide();
                $('#black_overlay').show();
                $('#product_overview > .load').show();
                $('#product_overview').css('display', 'flex');
                $('#black_overlay')[0].onclick = function () {
                    $('#product_overview').hide();
                    $('#black_overlay').hide();
                };
                fetch($(this).attr("data-product"))
                    .then(function (response) {
                        $(this).show();
                        return response.json();
                    })
                    .then(function (data) {
                        $('#pv_name').text(data.name);
                        $('#pv_description').text(data.description);
                        $('#pv_price').text(data.price);
                        $('#pv_buy').off("click"); //Remove all click events, befor setting a new one
                        $('#pv_buy').click(function () {
                            addToCart(data);
                        });
                        $('#pv_image').attr("src", data.image_path);
                        $('#product_overview > .load').hide();
                        $('#product_overview > .row').show();
                    });
            });
        }
    });
});
