<?php
try {
    require_once 'database.php';
    $query = "SELECT pagesId,pagename from pages;";
    $cmd = $db->prepare($query);
    $cmd->execute();
    $pages = $cmd->fetchAll();
} catch (Exception $e) {
    header('location:error.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css"/>
</head>
<body>
<main>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="index.php"><img class="navbar-brand" src="logos/logo.png" alt="Logo"></a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <?php
                session_start();
                if (empty($_SESSION['adminsId'])) {
                    foreach ($pages as $value) {
                        echo '<li class="nav-item active"><a class="nav-link" href="pages.php?pagesId=' . $value['pagesId'] . '">' . $value['pagename'] . '</a></li>';

                    }
                } else {
                    echo '<li class="nav-item active"><a class="nav-link" href="admin-list.php">Administrators</a></li>
                    <li class="nav-item active"><a class="nav-link" href="page-list.php">Pages</a></li>',
                    '<li class="nav-item active"><a class="nav-link" href="file-search.php">Logo</a></li>';
                }
                ?>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php

                if (!empty($_SESSION['adminsId'])) {
                    echo '<li class="nav-item active"><a class="nav-link" href="control-panel.php">Control Panel</a></li>',
                    '<li class="nav-item"><a class="nav-link" href="logout.php">Logout<span class="sr-only">(current)</span></a></li>';
                } else {
                    echo '<li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
                }
                ?>
            </ul>
        </div>
    </nav>