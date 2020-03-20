<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admins</title>
</head>
<body>
<a href="logout.php">Logout</a>
<h1>Admin List</h1>

<?php
session_start();
if (!empty($_SESSION['adminsId'])) {
    echo '<a href="register.php">Create a new Admin</a>';
}
require_once 'database.php';
$query = "SELECT * FROM admins;";
$cmd = $db->prepare($query);
$cmd->execute();
$admins = $cmd->fetchAll();

echo '<table><thead><th>Email</th></thead>';
foreach ($admins as $value) {
    echo '<tr>';
    if (!empty($_SESSION['adminsId'])) {
        echo '<td><a href="admin.php?adminId=' . $value['adminsId'] . '">' . $value['username'] . '</a></td>';
    } else {
        echo '<td>' . $value['username'] . '</td>';
    }
    if (!empty($_SESSION['adminsId'])) {
        echo '<td><a href="delete-admin.php?adminsId=' . $value['adminsId'] . '"
            onclick="return confirmDelete();">Delete</a></td>';
    }
    echo '</tr>';
}
echo '</table>';
$db = null;
?>
<script src="js/main.js" type="text/javascript"></script>
</body>
</html>