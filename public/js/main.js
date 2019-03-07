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
    });
});
