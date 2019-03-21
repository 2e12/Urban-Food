<div class="banner">
    <h1>Urban Food</h1>
    <h2>fast & healthy food</h2>
</div>

<div class="container front">
    <a class="row" href="/category/products/?category=1">
        <div data-background="<?php echo $categories[1]->image_path; ?>" class="product">
            <div class="top">Burger</div>
        </div>
        <div class="description desktop"><p><?php echo $categories[1]->description; ?></p></div>
    </a>

    <a class="row" href="/category/products/?category=5">
        <div class="description desktop"><p><?php echo $categories[5]->description; ?></p></div>
        <div data-background="<?php echo $categories[5]->image_path; ?>" class="product">
            <div class="top">Pizza</div>
        </div>
    </a>

    <a class="row" href="/category/products/?category=2">
        <div data-background="<?php echo $categories[2]->image_path; ?>" class="product">
            <div class="top">Snacks</div>
        </div>
        <div class="description desktop"><p><?php echo $categories[2]->description; ?></p></div>
    </a>

    <a class="row" href="/category/products/?category=3">
        <div class="description desktop"><p><?php echo $categories[3]->description; ?></p></div>
        <div data-background="<?php echo $categories[3]->image_path; ?>" class="product">
            <div class="top">Drinks</div>
        </div>
    </a>


    <!--<div class="row"><div class="product burger" onclick="location.href='/category/products/?category=1'"><div class="top">Burger</div></div><div class="linkbutton right"><a href="/category/products/?category=1">Zur Kategorie</a></div></div><br>
    <div class="row"><div class="linkbutton left"><a href="/category/products/?category=5">Zur Kategorie</a></div><div class="product pizza" onclick="location.href='/category/products/?category=5'"><div class="top">Pizza</div></div></div><br>
    <div class="row"><div class="product softdrinks" onclick="location.href='/category/products/?category=3'"><div class="top">Softdrinks</div></div><div class="linkbutton right"><a href="/category/products/?category=3">Zur Kategorie</a></div></div>
    -->
</div>