<?php
$title = 'Create page';
try {
    require_once 'database.php';
    if (!empty($_GET['pagesId'])) {
        $pagesId = $_GET['pagesId'];

        $sql = "SELECT pagename FROM pages WHERE pagesId = :pagesId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':pagesId', $pagesId, PDO::PARAM_INT);
        $cmd->execute();
        $page = $cmd->fetch();
        $pagename = $page['pagename'];
        $title = $pagename;
    }
} catch (Exception $e) {
    header('location:error.php');
    exit();
}
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
            //getting pages
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
    <div id="editPages">
        <h1>Page Information</h1>
        <form action="save-page.php" method="post">
            <fieldset>
                <div class="form-group">
                    <label for="pagename">Title:</label>
                    <input class="form-control" name="pagename" id="pageName" required
                           value="<?php echo $pagename; ?>"/>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea class="form-control" name="content" id="content" rows="4"
                              cols="50"><?php echo $content; ?></textarea>
                </div>
            </fieldset>
            <input name="pagesId" id="pagesId" value="<?php echo $pagesId; ?>" type="hidden"/>
            <button class="sv btn btn-primary">Save Page</button>
        </form>
    </div>
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
        echo '<h1 id="pageName">' . $pagename . '</h1>';
        echo '<main id="content">' . $content . '</main>';
    } catch (Exception $e) {
        header('location:error.php');
        exit();
    }
}
require_once 'footer.php';
?>