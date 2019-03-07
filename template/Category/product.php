<div class="container">
    <h1 class="floated"><?php echo $category ?></h1>
    <?php
    foreach ($products as $product) {
        ?>
        <a data-background="<?php echo $product->image_path ?>"
           href="/product/get/?id=<?php echo $product->id ?>" class="product">
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