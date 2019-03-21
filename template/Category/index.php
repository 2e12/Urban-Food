<div class="container">
    <h1 class="floated">Categories</h1>
    <?php
    foreach ($categories as $category) {
        ?>
        <a data-background="<?php echo $category->image_path ?>"
           href="/category/products/?category=<?php echo $category->id ?>" class="category"><h2>
                <?php
                echo $category->name;
                ?></h2>
        </a>
        <?php
    }
    ?>
</div>
