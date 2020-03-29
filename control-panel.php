<?php
$title = 'Control Panel';
require_once 'header.php';
//Authentication
require_once 'authenticate.php';
?>
    <!--Control Panel-->
    <h1>Control Panel</h1>
    <a class="btn btn-block btn-light btn-outline-dark" href="admin-list.php" role="button">Administrators</a></br>
    <a class="btn btn-block btn-light btn-outline-dark" href="page-list.php" role="button">Pages</a></br>
    <a class="btn btn-block btn-light btn-outline-dark" href="file-search.php" role="button">Logo</a></br>
<?php
require_once 'footer.php'
?>