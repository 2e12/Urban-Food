<div class="content">
    <h1>Bestellungen</h1>
    <table>
        <?php
        foreach ($orders as $order) {
            echo "<tr><td><a href='/order/show?id={$order->id}'>{$order->id}</a></td><td>{$order->order_time}</td></tr>";
        }
        ?>
    </table>
</div>