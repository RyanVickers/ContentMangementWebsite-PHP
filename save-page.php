<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save page</title>
</head>
<body>

<h1>save page</h1>
<?php
session_start();
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
    if (empty($content)) {
        echo 'Content is required<br />';
        $valid = false;
    }
}
//if valid updates title in database
if ($valid) {
    try {
        // connect to db
        require_once 'database.php';

        if (empty($pagesId)) {
//if no page id inserts data into database in Pageid updates database
            $sql = "INSERT INTO pages (pagename, content) VALUES (:pagename, :content)";
        } else {
            $sql = "UPDATE pages SET pagename = :pagename, content = :content WHERE pagesId = :pagesId";
        }

        $cmd = $db->prepare($sql);
        $cmd->bindParam(':pagename', $pagename, PDO::PARAM_STR, 50);
        $cmd->bindParam(':content', $content, PDO::PARAM_STR);

        if (!empty($pagesId)) {
            $cmd->bindParam(':pagesId', $pagesId, PDO::PARAM_INT);
        }

        // try to send / save the data
        $cmd->execute();

        // disconnect
        $db = null;

        // show message to user
        echo '<h2>Page Saved</h2>';
        header('location:page-list.php');
    } catch (Exception $e) {
        header('location:error.php');
        exit();
    }
}
