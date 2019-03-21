function toggleMenu(){
    $( "#menu" ).toggle();
    $("#shoppingcart").hide();
}

function toggleShoppingCart() {
    renderCart();
    $("#shoppingcart").toggle();
    $("#menu").hide();
}

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
            renderCart();
        };
        line.appendChild(quantity);

        let price = document.createElement("div");
        price.className = "pc_price";
        price.innerHTML = (item.price * item.quantity).toFixed(2);
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

        document.getElementById("shoppingcart_buy").onclick = function () {
            $.post("/order/check", getCart())
                .done(function (data) {
                    console.log(data);
                    if (data === "ok") {
                        window.location.href = "/order/checkout";
                    }
                });
        };

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

/**
 * Adds product to cart. When product is already exists, then increment the quantity by 1 of the existing product.
 * @param json_product
 */
function addToCart(json_product) {
    let unique = true;
    let cart = getCart();
    for (let index in cart.products) {
        let item = cart.products[index];
        if (item.id === json_product.id) {
            unique = false;
            item.quantity += 1;
        }
    }
    if (unique) {
        if (json_product.quantity == null) {
            json_product.quantity = 1;
        }
        cart.products.push(json_product);
    }
    localStorage.setItem('cart', JSON.stringify(cart));
}

$(document).ready(function () {
    //Checks if there is an entry in the local stroage for the shopping cart
    let cart = getCart();

    //This functions loops after load trough every a element in #content and searches for -data-background attribute for loading background images
    $('a, div').each(function () {
        if ($(this).attr("data-background") !== undefined) {
            $(this).css('background-image', "url(" + $(this).attr("data-background") + ")");
        }
        if ($(this).attr("data-product") !== undefined) {
            $(this).click(function () {
                //Generating product overview
                $('#pv_buy').attr("value", "Buy");
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
                        $('#pv_ingredients a').attr("href", "/product/ingredients/?id=" + data.id);
                        $('#pv_price').text(data.price);

                        $('#pv_buy').attr("class", "");
                        $('#pv_buy').click(function () {
                            $('#pv_buy').off("click"); //Remove all click events, before setting a new one
                            $('#pv_buy').attr("class", "pv_added"); // Setting class. Removes "button look"
                            $('#pv_buy').attr("value", "Product added"); // Setting new text
                            addToCart(data);
                            renderCart();
                        });
                        //Loading image
                        $('#pv_image').attr("src", data.image_path);
                        $('#product_overview > .load').hide();
                        $('#product_overview > .row').show();
                    });
            });
        }
    });
});
