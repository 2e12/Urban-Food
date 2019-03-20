<div id="menu">
    <h2>Menu</h2>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/category">Produkte</a></li>
        <?php
        if (!isset($_SESSION["user"])) {
            ?>
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
            <?php
        }
        else {
            ?>
            <li><a href="/User/index">Profil</a></li>
            <?php
        }
        ?>
    </ul>
</div>

<div id="black_overlay"></div>
<div id="product_overview">
    <div class="row">
        <img id="pv_image" src="">
    </div>
    <div class="row">
        <span id="pv_name">Loading</span>
        <p><span id="pv_description">Loading</span></p>
        <p id="price">$<span id="pv_price">Loading</span></p>
        <input id="pv_buy" type="submit">
        <div id="pv_ingredients"><a>Zutaten</a></div>
    </div>
    <div class="load"></div>
</div>
<div id="shoppingcart">
    <h1>shopping cart</h1>
    <div id="product_cart">

    </div>
    <div id="total"><p></p></div>
    <button class="linkbutton" id="shoppingcart_buy">kaufen</button>
</div>