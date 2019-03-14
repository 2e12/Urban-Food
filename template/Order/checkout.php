<div class="content">
    <h1>Checkout</h1>
    <h2>Bestellung</h2>
    <p>Überprüfen Sie Ihre Bestellung, bevor Sie sie tätigen. Merken Sie Informationen über mögliche Allergien im Feld
        "Allergien" oder "Kommentar" an.</p>
    <p>Zahlung wird direkt vor Ort vorgenommen.</p>
    <h3>Warenkorb</h3>
    <form action="/order/buy" method="POST">
        <table>
            <?php
            if (isset($_SESSION["user"])) {
            foreach ($_SESSION["order"] as $product) {
                $product = $product[0];
                echo "<tr><td>" . $product->quantity . "</td><td> " . $product->name . "</td><td>$" . $product->quantity * $product->price . "</td></tr>";
            }
            ?>
        </table>
        <h3>Allergien</h3>
        <select name="allergien">
            <option value="Keine">Keine</option>
            <option value="glutenfrei">Glutenfrei</option>
            <option value="Laktosefrei">Laktosefrei</option>
            <option value="Nuss/Schallenfrüchte">Nuss/Schallenfrüchte</option>
        </select>
        <h3>Kommentar</h3>
        <textarea name="comment"></textarea><br>
        <input type="submit" name="buy" value="buy">
    </form>
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
