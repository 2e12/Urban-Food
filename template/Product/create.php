<?php
$permission = \App\Authentication\Authentication::getAuthenticatedUser()->is_admin;
if ($permission == true) {
    echo '
    <div class="content">
        <h1>Neues Produkt erfassen</h1>
        <div class="formblock">
           <form method="POST" action="/Product/createProduct" class="smallform" enctype="multipart/form-data">
            <input name="productName" type="text" placeholder="Name des Produkts" required>
            <input name="productPrice" type="number" step="0.01" placeholder="Preis" required>
            <input name="productDesc" type="text" placeholder="Beschreibung des Produkts" required>
            <input name="productImage" type="file" required>
            <select name="productCategory" required>
                <option value="0">sandwich</option>
                <option value="1">burger</option>
                <option value="2">snacks</option>
                <option value="3">drinks</option>
                <option value="4">asia</option>
                <option value="5">pizza</option>
            </select>
            <div class="send"><input type="submit"></div>
            </form>
        </div>
    </div>';
}
else {
    header('Location: /User/forbidden');
}