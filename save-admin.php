<?php
$title = 'Save Admin';
require_once 'header.php';
?>
<h1>Save Admin</h1>
<?php
//accessing session
session_start();
//if not logged in sends back to login
require_once 'authenticate.php';


$username = htmlspecialchars($_POST['username']);
$adminsId = $_POST['adminsId'];
echo $username;
//validation
$valid = true;
if (empty($username)) {
    echo 'Username is required<br />';
    $valid = false;
}
//if valid updates username in database
if ($valid) {
    //connecting to database
    require_once 'database.php';
    if (!empty($adminsId)) {
        $sql = "UPDATE admins SET username = :username WHERE adminsId = :adminsId";
    }

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    //binding admin id only if not empty
    if (!empty($adminsId)) {
        $cmd->bindParam(':adminsId', $adminsId, PDO::PARAM_INT);
    }
    $cmd->execute();
    $db = null;
    echo '<h2>Admin Saved</h2>';
    //sends user to list page
    header('location:admin-list.php');
}
require_once 'footer.php';
?>
