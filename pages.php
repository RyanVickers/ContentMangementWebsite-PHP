<?php
require_once 'database.php';
if (!empty($_GET['pagesId'])) {
    $pagesId = $_GET['pagesId'];
}
$sql = "SELECT pagename FROM pages WHERE pagesId = :pagesId";
$cmd = $db->prepare($sql);
$cmd->bindParam(':pagesId', $pagesId, PDO::PARAM_INT);
$cmd->execute();
$page = $cmd->fetch();
$pagename = $page['pagename'];
$title = $pagename;
require_once 'header.php';
if (!empty($_SESSION['adminsId'])) {
    $pagesId = null;
    $pagename = null;
    $content = null;

    if (!empty($_GET['pagesId'])) {
        $pagesId = $_GET['pagesId'];
        //connecting to database
        try {
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

        } catch (Exception $e) {
            header('location:error.php');
            exit();
        }

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
} else {
    $pagesId = $_GET['pagesId'];
//connecting to database
    try {
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
        echo '<h1>' . $pagename . '</h1>';
        echo '<main>' . $content . '</main>';
    } catch (Exception $e) {
        header('location:error.php');
        exit();
    }
}
require_once 'footer.php';
?>