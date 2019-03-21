<div id="footer">
    <p>© Urban Food 2019</p>
    <div class="row">
        <strong>About us</strong><br>
        <a href="/static/team">Team</a><br>
        <a href="/static/impressum">Impressum</a><br>
    </div>
    <div class="row">
        <strong>Store</strong><br>
        <a href="/">Home</a><br>
        <a href="/Category">Products</a><br>
        <?php
        if (isset($_SESSION["user"])) {
            ?>
            <a href="/User">My Profile</a><br>
            <?php
        }
        else {
            ?>
            <a href="/register">Register</a><br>
            <a href="/login">Login</a><br>
            <?php
        }
        ?>
    </div>
</div>
</div>
</body>
</html>