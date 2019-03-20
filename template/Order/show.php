<div class="content">
    <h1>Einkauf</h1>
    <h2>Details</h2>
    <h3>Adresse</h3>
    <p>
        <?php
        echo $user->prename . " " . $user->lastname . "<br>" . $adress->postal_code . " " . $adress->city . "<br>" . $adress->street;
        ?></p>
    <h3>Kommentar</h3>
    <p>
        <?php
        echo $comment;
        ?></p>
    <h3>Allergien</h3>
    <?php
    echo $allergy;
    ?>
    <h2>Warenkorb</h2>
    <table>
        <?php
        $total = 0;
        foreach ($products as $product) {
            $price = $product->quantity * $product->price;
            $total += $price;
            echo "<tr><td>" . $product->quantity . "x</td><td> " . $product->name . "</td><td>$" . $price . "</td></tr>";
        }
        ?>
    </table>
    Total: $<?php echo $total; ?>
</div>