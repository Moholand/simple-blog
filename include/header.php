<?php

include("./include/config.php");
include("./include/db.php");

$query = "SELECT * FROM `categories`";
$categories = $db->query($query);

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/icofont/icofont.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>MOHOLAND</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand order-md-2" href="index.php">MOHOLAND</a>
            <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="my-nav" class="collapse navbar-collapse">
                <ul class="navbar-nav order-md-1">
                    
                    <?php
                    
                    if ($categories->rowCount() > 0) {
                        foreach ($categories as $category) {
                            ?>
                            <li class="nav-item <?php echo (isset($_GET['category']) && $category['id'] == $_GET['category']) ? 'active' : ""; ?> ">
                                <a class="nav-link" href="index.php?category=<?php echo $category['id']; ?>"> <?php echo $category['title'] ?> </a>
                            </li>
                    <?php
                        }
                    }

                    ?>
                    
                </ul>
            </div>
        </div>
    </nav>
