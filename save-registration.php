<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save Registration</title>
</head>
<body>

<?php

$username = $_POST['username'];
$password = $_POST['password'];
$confirmPass = $_POST['confirm'];
$valid = true;
if (empty($username)) {
    echo 'Username is required<br />';
    $valid = false;
}
if (empty($password)) {
    echo 'Password is required<br />';
    $valid = false;
}
if ($password != $confirmPass) {
    echo 'Passwords must match<br />';
    $valid = false;
}
if ($valid) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    require_once 'db.php';
    $sql = "SELECT * FROM users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();
    if (!empty($user)) {
        echo 'Username already exists<br />';
    } else {
        $sql = "INSERT INTO admins (username, password) VALUES (:username, :password)";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
        $cmd->execute();
    }
    $db = null;

}
?>

</body>
</html>