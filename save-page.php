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

        // adding or editing depending if we already have an artistId or not
        if (empty($pagesId)) {
            // set up the SQL INSERT command - use 3 paramter placeholders for the values (prefixed with :)
            $sql = "INSERT INTO pages (pagename, content) VALUES (:pagename, :content)";
        } else {
            $sql = "UPDATE pages SET pagename = :pagename, content = :content WHERE pagesId = :pagesId";
        }

        // create a PDO command object and fill the parameters 1 at a time for type & safety checking
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':pagename', $pagename, PDO::PARAM_STR, 50);
        $cmd->bindParam(':content', $content, PDO::PARAM_STR);


        // if we have an artistId, we need to bind the 4th parameter (but only if we have an id already)
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
