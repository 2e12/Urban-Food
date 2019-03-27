<?php
$repo = new \App\Repository\ProductRepository();
$products = $repo->readAll();
$permission = \App\Authentication\Authentication::getAuthenticatedUser()->is_admin;
if ($permission == true) {
    echo '
    <div class="content">
        <div class="del">
        <h1>Produkte löschen</h1>
        <table>
            <tr>
                <td>Produkt</td>
                <td>Preis</td>
            </tr>';
    foreach ($products as $product) {
        echo '
                    <tr>
                        <td>' . $product->name . '</td>
                        <td>' . $product->price . '</td>
                        <td><a href="/Product/del?id=' . $product->id . '"><i class="fas fa-ban"></i></a></td>
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