<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Validation</title>
</head>
<body>
<?php
//getting username and password and storing in variables
$username = $_POST['username'];
$password = $_POST['password'];
//connecting to DB
try {
    require_once 'database.php';
    $sql = "SELECT adminsId, password FROM admins WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();
//verifying password
    if (!password_verify($password, $user['password'])) {
        header('location:login.php?invalid=true');
        exit();
    } else {
        //access user session
        session_start();
        //getting user id
        $_SESSION['adminsId'] = $user['adminsId'];
        //redirect to admin list page
        header('location:admin-list.php');
    }
//disconnecting from database
    $db = null;
} catch (Exception $e) {
    header('location:error.php');
    exit();
}

?>
</body>
</html>