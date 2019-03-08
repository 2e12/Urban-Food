function toggleMenu(){
    $( "#menu" ).toggle();
}

function toggleShoppingCart() {
    $("#shoppingcart").toggle();
}

$(document).ready(function () {
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
                        $('#pv_image').attr("src", data.image_path);
                        $('#product_overview > .load').hide();
                        $('#product_overview > .row').show();
                    });
            });
        }
    });
});
