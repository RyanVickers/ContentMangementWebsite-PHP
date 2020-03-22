<?php
$title = 'pages';
require_once 'header.php';
?>
<?php

//if not logged in redirect to login
require_once 'authenticate.php';

$username = null;
//checks if logged in
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
    $pagename = $page['title'];
    $db = null;
}
?>

    <h1>Admin Information</h1>
    <form action="save-page.php" method="post">
        <fieldset>
            <label for="title">Title:</label>
            <input name="tilte" id="title" required value="<?php echo $pagename; ?>"/>
        </fieldset>
        <input name="pagesId" id="pagesId" value="<?php echo $pagesId; ?>" type="hidden"/>
        <button>Save</button>
    </form>
<?php
require_once 'footer.php';
?>