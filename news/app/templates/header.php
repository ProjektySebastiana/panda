<?php
    include_once __DIR__.'/../autoload.php';
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/main.css"/>
</head>
<body>
<div class="page">
    <div class="top">
        <div class="wrapper">
            <p>
        <?php

        if (isset($_SESSION['user'])) {
            echo '<span>Hello ' . $_SESSION['user']['first_name'] . '!</span><span><a href=".">Home</a><a href="article-create.php">Add new article</a><a href="user-logout.php">Log out</a></span>';
        }
        else {
            echo '<span><a href=".">Home</a></span><span><a href="user-form.php">Sign in</a></span>';
        }
        ?>
            </p>
        </div>
    </div>
    <div class="content">
        <div class="wrapper">