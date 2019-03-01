<?php
    require_once "../vendor/autoload.php";

    use App\Dispatcher\Dispatcher;

    require "../template/header.php";
    //Content start
    Dispatcher::dispatch();
    require "../template/test_content.php";

    //Content end
    require "../template/nav.php";
    require "../template/footer.php";
?>
