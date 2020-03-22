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
$pagename = htmlspecialchars($_POST['title']);
$pagesId = $_POST['pagesId'];
echo $title;
//validation
$valid = true;
if (empty($title)) {
    echo 'Title is required<br />';
    $valid = false;
}
//if valid updates title in database
if ($valid) {
    //connecting to database
    require_once 'database.php';
    if (!empty($pagesId)) {
        $sql = "UPDATE pages SET title = :title WHERE pagesId = :pagesId";
    }

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':title', $title, PDO::PARAM_STR, 45);
    //binding page id only if not empty
    if (!empty($pagesId)) {
        $cmd->bindParam(':pagesId', $pagesId, PDO::PARAM_INT);
    }
    $cmd->execute();
    $db = null;
    echo '<h2>Page Saved</h2>';
    //sends user to list page
    header('location:page-list.php');
}
require_once 'footer.php';
?>
