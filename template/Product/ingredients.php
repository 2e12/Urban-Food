<div class="content">
    <h1><?php echo $product->name; ?></h1>
    <p><?php echo $product->description; ?></p>
    <h2>Zutaten</h2>
    <?php
    foreach ($ingredients as $ingredient) {
        echo $ingredient->name . "<br>";
    }
    ?>
    <hr>
    <p>Sämtliche Zutaten kommen aus der Schweiz. Ausgenommen sind ausländische Getränke.</p>

</div>