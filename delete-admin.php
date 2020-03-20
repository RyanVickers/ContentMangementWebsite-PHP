<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete</title>
</head>
<body>

<?php

session_start();
if (empty($_SESSION['adminsId'])) {
    header('location:login.php');
    exit();
}
$adminsId = $_GET['adminsId'];
require_once 'database.php';
$sql = "DELETE FROM admins WHERE adminsId = :adminsId";
$cmd = $db->prepare($sql);
$cmd->bindParam(':adminsId', $adminsId, PDO::PARAM_INT);
$cmd->execute();
$db = null;
header('location:admin-list.php');
?>

</body>
</html>
