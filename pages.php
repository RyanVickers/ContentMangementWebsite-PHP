<?php
$title = 'pages';
require_once 'header.php';
?>
<?php

//if not logged in redirect to login
require_once 'authenticate.php';

$pagename = null;
$content = null;

if (!empty($_GET['pagesId'])) {
    $pagesId = $_GET['pagesId'];
    //connecting to database
    require_once 'database.php';
    //getting usernames
    $sql = "SELECT * FROM pages WHERE pagesId = :pagesId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':pagesId', $pagesId, PDO::PARAM_INT);
    $cmd->execute();
    $page = $cmd->fetch();
    $pagename = $page['pagename'];
    $content = $page['content'];
    $db = null;
}
?>

    <h1>Page Information</h1>
    <form action="save-page.php" method="post">
        <fieldset>
            <label for="pagename">Title:</label>
            <input name="pagename" id="pagename" required value="<?php echo $pagename; ?>"/>
        </fieldset>
        <fieldset>
            <label for="content">Content:</label>
            <input name="content" id="content" required value="<?php echo $content; ?>"/>
        </fieldset>
        <input name="pagesId" id="pagesId" value="<?php echo $pagesId; ?>" type="hidden"/>
        <button>Save</button>
    </form>
<?php
require_once 'footer.php';
?>