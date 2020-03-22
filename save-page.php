<?php
$title = 'Save Page';
require_once 'header.php';
?>
    <h1>Save Page</h1>
<?php

//if not logged in sends back to login
require_once 'authenticate.php';
$pagename = $_POST['pagename'];
$content = htmlspecialchars($_POST['content']);
$pagesId = $_POST['pagesId'];
echo $pagename;
//validation
$valid = true;
if (empty($pagename)) {
    echo 'Title is required<br />';
    $valid = false;
}
//if valid updates title in database
if ($valid) {
    //connecting to database
    require_once 'database.php';
    if (!empty($pagesId)) {
        $sql = "UPDATE pages SET pagename = :pagename, content = :content WHERE pagesId = :pagesId";
    } else {
        if (empty($pagesId))
            $sql = "INSERT INTO pages (pagename, content) VALUES (:pagename, :content)";
    }

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':pagename', $pagename, PDO::PARAM_STR, 45);
    $cmd->bindParam(':content', $content, PDO::PARAM_STR, 255);

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