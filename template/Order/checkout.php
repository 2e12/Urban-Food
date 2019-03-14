<div class="content">
    <h1>Checkout</h1>
    <table>
        <?php
        if (isset($_SESSION["user"])) {
        foreach ($_SESSION["order"] as $product) {
            $product = $product[0];
            echo "<tr><td>" . $product->quantity . "</td><td> " . $product->name . "</td><td>$" . $product->quantity * $product->price . "</td></tr>";
        }
        ?>
    </table>
    <?php
    }
    else {
        ?>
        <p>Oh, nein! Es scheint Du bist nicht angemeldet.</p><p><strong>Klicke <a href="/register">hier</a> um Dir einen
                Account zu erstellen.</strong> Es dauert nicht lange, versprochen. </p>
        <?php
    }
    ?>
</div>
