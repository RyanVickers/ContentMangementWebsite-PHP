<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Validation</title>
</head>
<body>
<?php
$username = $_POST['username'];
$password = $_POST['password'];
require_once 'database.php';
$sql = "SELECT adminsId, password FROM admins WHERE username = :username";
$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();
$user = $cmd->fetch();
if (!password_verify($password, $user['password'])) {
    header('location:login.php?invalid=true');
    exit();
} else {
    session_start();
    $_SESSION['adminsId'] = $user['adminsId'];
    header('location:admins.php');
}
$db = null;

?>
</body>
</html>