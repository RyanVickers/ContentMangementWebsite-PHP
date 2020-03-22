<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete</title>
</head>
<body>

<?php
//access session
session_start();
//if not logged in sends back to login
require_once 'authenticate.php';

//storing admin id
$pagesId = $_GET['pagesId'];
//connecting to database
require_once 'database.php';
//deleting from database
$sql = "DELETE FROM pages WHERE pagesId = :pagesId";
$cmd = $db->prepare($sql);
$cmd->bindParam(':pagesId', $pagesId, PDO::PARAM_INT);
$cmd->execute();
//disconnecting from database
$db = null;
//redirect to admin list
header('location:page-list.php');
?>

</body>
</html>