<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Information</title>
</head>
<body>

<h1>Admin Information</h1>
<?php
session_start();
require_once 'authenticate.php';
//getting username
$username = $_POST['username'];
//connecting to database
try {
//getting usernames from admins list
    require_once 'database.php';
    $sql = "SELECT * FROM admins WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $admin = $cmd->fetch();
    $db = null;
} catch (Exception $e) {
    header('location:error.php');
    exit();
}
?>

</body>
</html>
