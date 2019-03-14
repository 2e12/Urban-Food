<div class="content">
    <h1>Einkauf</h1>
    <h2>Details</h2>
    <h3>Kommentar</h3>
    <?php
    echo $comment;
    ?>
    <h3>Allergien</h3>
    <?php
    echo $allergy;
    ?>
    <h2>Warenkorb</h2>
    <table>
        <?php
        foreach ($products as $product) {
            echo "<tr><td>" . $product->quantity . "x</td><td> " . $product->name . "</td><td>$" . $product->quantity * $product->price . "</td></tr>";
        }
        ?>
    </table>
</div>