<div class="banner" data-background="<?php echo $image ?>">
    <h1 class="floated"><?php echo $category ?></h1>
</div>
<div class="container">
    <?php
    foreach ($products as $product) {
        ?>
        <a data-background="<?php echo $product->image_path ?>"
           data-product="/product/get/?id=<?php echo $product->id ?>" class="product">
            <div class="top"><?php
                echo $product->name;
                ?></div>
            <div class="bottom"><?php
                echo $product->price;
                ?></div>
        </a>
        <?php
    }
    ?>

</div>
<div class="inline_element">
    <div class="linkbutton back"><a href="/category">Zurück zur Auswahl</a></div>
</div>