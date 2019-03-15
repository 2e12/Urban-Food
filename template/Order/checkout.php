<div class="content">
    <h1>Checkout</h1>
    <?php
    if (isset($_SESSION["user"])) {
        ?>
        <h2>Bestellung</h2>
        <p>Überprüfen Sie Ihre Bestellung, bevor Sie sie tätigen. Merken Sie Informationen über mögliche Allergien im Feld
            "Allergien" oder "Kommentar" an.</p>
        <p>Zahlung wird direkt vor Ort vorgenommen.</p>

        <h3>Adresse</h3>
        <?php
        echo $user->prename . " " . $user->lastname . "<br>" . $adress->postal_code . " " . $adress->city . "<br>" . $adress->street;
        ?>
        <h3>Warenkorb</h3>
        <form action="/order/buy" method="POST">
            <table>


                <?php
                $total = 0;
                foreach ($_SESSION["order"] as $product) {
                    $price = $product[0]->quantity * $product[0]->price;
                    $total += $price;
                    $product = $product[0];
                    echo "<tr><td>" . $product->quantity . "</td><td> " . $product->name . "</td><td>$" . $product->quantity * $product->price . "</td></tr>";
                }
                ?>
            </table>
            <strong>Total:</strong> $<?php echo $total; ?>
            <h3>Allergien</h3>
            <select name="allergy">
                <option value="Keine">Keine</option>
                <option value="glutenfrei">Glutenfrei</option>
                <option value="Laktosefrei">Laktosefrei</option>
                <option value="Nuss/Schallenfrüchte">Nuss/Schallenfrüchte</option>
            </select>
            <h3>Kommentar</h3>
            <textarea maxlength="500" name="comment"></textarea><br>
            <input type="submit" class="linkbutton" name="buy" value="kaufen">
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
