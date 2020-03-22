<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save Registration</title>
</head>
<body>

<?php
//storing inputs from HTML form
$username = $_POST['username'];
$password = $_POST['password'];
$confirmPass = $_POST['confirm'];
$valid = true;
//validating inputs
if (empty($username)) {
    echo 'Username is required<br/>';
    $valid = false;
}
if (empty($password)) {
    echo 'Password is required<br/>';
    $valid = false;
}
if ($password != $confirmPass) {
    echo 'Passwords must match<br/>';
    $valid = false;
}
//if valid inputs hash password
if ($valid) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    //connecting to DB
    try {
        require_once 'database.php';
        //check to see if duplicate usernames
        $sql = "SELECT * FROM admins WHERE username = :username";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->execute();
        $user = $cmd->fetch();
        if (!empty($user)) {
            echo 'Username already exists<br/>';
        } else {
            //inserting user and password into DB
            $sql = "INSERT INTO admins (username, password) VALUES (:username, :password)";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
            $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
            $cmd->execute();
        }
        //disconnect from DB
        $db = null;
        //redirect to login
        header('location:login.php');
    } catch (Exception $e) {
        header('location:error.php');
        exit();
    }
}
?>

</body>
</html>