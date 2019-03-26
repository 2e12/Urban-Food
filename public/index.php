<?php
session_start();
require_once "../vendor/autoload.php";

use App\Dispatcher\Dispatcher;

Dispatcher::dispatch();
?>
