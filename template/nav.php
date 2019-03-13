<div id="menu">
    <h2>Menu</h2>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/category">Products</a></li>
        <?php
        if (!isset($_SESSION["user"])) {
            ?>
            <li><a href="/login">Login</a></li>
            <li><a href="/register">Register</a></li>
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
    </div>
    <div class="load"></div>
</div>
<div id="shoppingcart">
    <h1>shopping cart</h1>
    <div id="product_cart">
        <div id="template">
            <div class="pc_name">The late spätig</div>
            <div><input type="number" name="quantity" min="1" max="10"></div>
            <div class="pc_name">0.99$</div>
        </div>

        <div class="line">
            <div class="pc_name">The late spätig</div>
            <div><input type="number" name="quantity" min="1" max="10"></div>
            <div class="pc_name">0.99$</div>
        </div>
        <div class="line">
            <div class="pc_name">The late spätig</div>
            <div><input type="number" name="quantity" min="1" max="10"></div>
            <div class="pc_name">0.99$</div>
        </div>
    </div>
    <div id="total"><p></p></div>
    <button>kaufen</button>
</div>