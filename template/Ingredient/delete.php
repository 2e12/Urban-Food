<?php
$permission = \App\Authentication\Authentication::getAuthenticatedUser()->is_admin;
$repo = new \App\Repository\IngredientRepository();
$ingredients = $repo->readAll();
if ($permission == true) {
    echo '
    <div class="content">
        <div class="del">
        <h1>Zutaten löschen</h1>
        <table>
            <tr>
                <td>Zutat</td>
            </tr>';
    foreach ($ingredients as $ingredient) {
        echo '
                    <tr>
                        <td>' . $ingredient->name . '</td>
                        <td><a href="/Ingredient/del?name=' . $ingredient->name . '"><i class="fas fa-ban"></i></a></td>
                    </tr>
                ';
    }
    echo '    
        </table>
        </div>
    </div>';
}
else {
    header('Location: /User/forbidden');
}