<?php
$title = 'Page List';
require_once 'header.php';
?>

    <h1 id="listPage">Page List</h1>

<?php
require_once 'authenticate.php';
//if not logged in display register link
if (!empty($_SESSION['adminsId'])) {
    echo '<a id="createPage" href="pages.php" class="btn btn-block btn-success">Create Page</a>';
}
//connecting to database
try {
    require_once 'database.php';
//getting admins from database
    $query = "SELECT * FROM pages;";
    $cmd = $db->prepare($query);
    $cmd->execute();
    $pages = $cmd->fetchAll();
//if empty session only shows title
    if (empty($_SESSION['adminsId'])) {
        echo '<table class="table table-hover"><thead class="thead thead-dark"><th>Title</th></thead>';
        foreach ($pages as $value) {
            echo '<tr>';
            echo '<td>' . $value['pagename'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else
        //if session isn't empty displays edit and delete links
        if (!empty($_SESSION['adminsId'])) {
            echo '<table class="table table-hover"><thead class="thead thead-dark"><th>Title</th><th>Edit</th><th>Delete</th></th></thead>';
            foreach ($pages as $value) {
                echo '<tr>';
                echo '<td>' . $value['pagename'] . '</td>';
                echo '<td><a href="pages.php?pagesId=' . $value['pagesId'] . '" class="btn btn-info">Edit</a></td>';
                echo '<td><a href="delete-page.php?pagesId=' . $value['pagesId'] . '"
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