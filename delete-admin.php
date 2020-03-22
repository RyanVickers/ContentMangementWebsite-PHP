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
$adminsId = $_GET['adminsId'];
//connecting to database
try {

    require_once 'database.php';
//deleting from database
    $sql = "DELETE FROM admins WHERE adminsId = :adminsId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':adminsId', $adminsId, PDO::PARAM_INT);
    $cmd->execute();
//disconnecting from database
    $db = null;
} catch (Exception $e) {
    header('location:error.php');
    exit();
}
//redirect to admin list
header('location:admin-list.php');
?>

</body>
</html>
