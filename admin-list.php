<?php
$title = 'Admin List';
require_once 'header.php';
?>

<h1 id="listAdmin">Admin List</h1>

<?php
require_once 'authenticate.php';
//if not logged in display register link
if (!empty($_SESSION['adminsId'])) {
    echo '<a id="createAdmin" href="register.php" class="btn btn-block btn-success">Create Administrator</a>';
}
try {
//connecting to database
    require_once 'database.php';
//getting admins from database
    $query = "SELECT * FROM admins;";
    $cmd = $db->prepare($query);
    $cmd->execute();
    $admins = $cmd->fetchAll();
//if empty session only shows usernames
    if (empty($_SESSION['adminsId'])) {
        echo '<table class="table table-hover"><thead class="thead thead-dark"><th>Email</th></thead>';
        foreach ($admins as $value) {
            echo '<tr>';
            echo '<td>' . $value['username'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else
        //if session isn't empty displays edit and delete links
        if (!empty($_SESSION['adminsId'])) {
            echo '<table class="table table-hover"><thead class="thead thead-dark"><th>Email</th><th>Edit</th><th>Delete</th></th></thead>';
            foreach ($admins as $value) {
                echo '<tr>';
                echo '<td>' . $value['username'] . '</td>';
                echo '<td><a href="admin.php?adminsId=' . $value['adminsId'] . '" class="btn btn-info">Edit</a></td>';
                echo '<td><a href="delete-admin.php?adminsId=' . $value['adminsId'] . '"
            onclick="return confirmDelete();" class="btn btn-danger">Delete</a></td>';
                echo '</tr>';
            }
            echo '</table>';
        }
//disconnect from database
    $db = null;
} catch (Exception $e) {
    header('location:error.php');
    exit();
}
require_once 'footer.php';
?>

