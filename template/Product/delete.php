<?php
$repo = new \App\Repository\ProductRepository();
$products = $repo->readAll();
echo '
<div class="content">
<h1>Produkte löschen</h1>
<table>
    <tr>
        <td>Produkt</td>
        <td>Preis</td>
    </tr>';

</table>
</div>
';