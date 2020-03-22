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
//accessing session
session_start();
//if not logged in display register link
if (!empty($_SESSION['adminsId'])) {
    echo '<a href="register.php">Create a new Admin</a>';
}
//connecting to database
require_once 'database.php';
//getting admins from database
$query = "SELECT * FROM admins;";
$cmd = $db->prepare($query);
$cmd->execute();
$admins = $cmd->fetchAll();
//if empty session only shows usernames
if (empty($_SESSION['adminsId'])) {
    echo '<table><thead><th>Email</th></thead>';
    foreach ($admins as $value) {
        echo '<tr>';
        echo '<td>' . $value['username'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else
    //if session isn't empty displays edit and delete links
    if (!empty($_SESSION['adminsId'])) {
        echo '<table><thead><th>Email</th><th>Edit</th><th>Delete</th></th></thead>';
        foreach ($admins as $value) {
            echo '<tr>';
            echo '<td>' . $value['username'] . '</td>';
            echo '<td><a href="admin.php?adminsId=' . $value['adminsId'] . '">Edit</a></td>';
            echo '<td><a href="delete-admin.php?adminsId=' . $value['adminsId'] . '"
            onclick="return confirmDelete();">Delete</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
//disconnect from database
$db = null;
?>
<script src="js/main.js" type="text/javascript"></script>
</body>
</html>