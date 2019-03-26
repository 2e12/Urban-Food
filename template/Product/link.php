<?php
$permission = \App\Authentication\Authentication::getAuthenticatedUser()->is_admin;
$catRepo = new \App\Repository\CategoryRepository();
$categories = $catRepo->readAll();
$prodRepo = new \App\Repository\ProductRepository();
$products = $prodRepo->readAll();
$ingRepo = new \App\Repository\IngredientRepository();
$ingredients = $ingRepo->readAll();

if ($permission == true) {
    echo '
<div class="content">
    <h1>Zutat mit Produkt verknüpfen</h1>
    <form method="POST" action="/Product/linkProdWIng" class="smallform">
        <select class="dropdown" name="product" required>';
    foreach ($categories as $category) {
        echo '<optgroup label="' . $category->name . '">';
        foreach ($products as $product) {
            if ($product->category_id == $category->id) {
                echo '<option value="' . $product->name . '">' . $product->name . '</option>';
            }
        }
        echo '</optgroup>';
    }
    echo '
        </select>
        <select class="dropdown" name="ingredient" required>';
    foreach ($ingredients as $ingredient) {
        echo '<option value="' . $ingredient->name . '">' . $ingredient->name . '</option>';
    }
    echo '
        </select>
        <div class="send"><input type="submit"></div>
    </form>
</div>
';
}
else {
    header('Location: /User/forbidden');
}
