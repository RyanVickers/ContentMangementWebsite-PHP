<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save Admin</title>
</head>
<body>

<h1>Save Admin</h1>
<?php
session_start();
if (empty($_SESSION['adminsId'])) {
    header('location:login.php');
    exit();
}

$username = htmlspecialchars($_POST['username']);
$adminsId = $_POST['adminsId'];
echo $username;

$valid = true;
if (empty($username)) {
    echo 'Username is required<br />';
    $valid = false;
}
if ($valid) {
    require_once 'database.php';
    if (!empty($adminsId)) {
        $sql = "UPDATE admins SET username = :username WHERE adminsId = :adminsId";
    }

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    if (!empty($adminsId)) {
        $cmd->bindParam(':adminsId', $adminsId, PDO::PARAM_INT);
    }
    $cmd->execute();
    $db = null;
    echo '<h2>Admin Saved</h2>';
    header('location:admin-list.php');
}

?>

</body>
</html>