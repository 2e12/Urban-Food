<div class="container">
    <h1 class="floated">Categories</h1>
    <?php
    foreach ($categories as $category) {
        ?>
        <a data-background="https://foodrevolution.org/wp-content/uploads/2018/04/blog-featured-diabetes-20180406-1330.jpg"
           href="/category/products/?category=<?php echo $category->id ?>" class="category"><h2>
                <?php
                echo $category->name;
                ?></h2>
        </a>
        <?php
    }
    ?>
</div>
