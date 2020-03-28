<?php
//setting title
$title = 'Admin';
//getting header
require_once 'header.php';
?>
<?php

//if not logged in sends back to login
require_once 'authenticate.php';

$username = null;
//if logged in
if (!empty($_GET['adminsId'])) {
    $adminsId = $_GET['adminsId'];
    //connecting to database
    try {
        require_once 'database.php';
        //getting usernames
        $sql = "SELECT * FROM admins WHERE adminsId = :adminsId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':adminsId', $adminsId, PDO::PARAM_INT);
        $cmd->execute();
        $admin = $cmd->fetch();
        $username = $admin['username'];
        $db = null;
    } catch (Exception $e) {
        header('location:error.php');
        exit();
    }
}
?>
    <div id="editAdmin"
    <h1>Admin Information</h1>
    <form action="save-admin.php" method="post">
        <fieldset>
            <div class="form-group">
                <label for="username">Username:</label>
                <input class="form-control" name="username" id="username" required value="<?php echo $username; ?>"/>
            </div>
        </fieldset>
        <input name="adminsId" id="adminsId" value="<?php echo $adminsId; ?>" type="hidden"/>
        <button class="btn btn-primary btn-block">Save Admin</button>
    </form>
    </div>
<?php
//getting footer
require_once 'footer.php';
?>