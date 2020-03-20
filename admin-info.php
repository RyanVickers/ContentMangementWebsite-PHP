<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Information</title>
</head>
<body>

<h1>Admin Information</h1>

<?php
$username = $_POST['username'];
require_once 'database.php';
$sql = "SELECT * FROM admins WHERE username = :username";
$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();
$admin = $cmd->fetch();
$db = null;
?>

</body>
</html>
