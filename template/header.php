<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Urban Food<?php if(isset($title)){ echo " - " . $title; } ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans+Condensed:300,400,500%7CIBM+Plex+Sans:300,400,500"
          rel="stylesheet">
    <meta name="theme-color" content="#57d319">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/js/main.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
<div id="header">
    <div class="wrapper">
        <div id="navigation">
            <div class="menubutton" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <a href="/" id="apptitle">Urban Food</a>

            <?php
            if (isset($_SESSION["user"])) {
                ?>
                <a class="button" href="/User/index"><i class="fas fa-user"></i></a>
                <?php
            }
            ?>
            <a class="button" onclick="toggleShoppingCart()"><i class="fas fa-shopping-bag"></i></a>
        </div>
    </div>
</div>
<div id="content" class="wrapper">