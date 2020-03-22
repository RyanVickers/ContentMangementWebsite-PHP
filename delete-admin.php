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
if (empty($_SESSION['adminsId'])) {
    header('location:login.php');
    exit();
}
//storing admin id
$adminsId = $_GET['adminsId'];
//connecting to database
require_once 'database.php';
//deleting from database
$sql = "DELETE FROM admins WHERE adminsId = :adminsId";
$cmd = $db->prepare($sql);
$cmd->bindParam(':adminsId', $adminsId, PDO::PARAM_INT);
$cmd->execute();
//disconnecting from database
$db = null;
//redirect to admin list
header('location:admin-list.php');
?>

</body>
</html>
