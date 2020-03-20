<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
</head>
<body>
<?php
session_start();
if (empty($_SESSION['adminsId'])) {
    header('location:login.php');
    exit();
}

$username = null;
if (!empty($_GET['adminsId'])) {
    $adminsId = $_GET['adminsId'];
    require_once 'database.php';
    $sql = "SELECT * FROM admins WHERE adminsId = :adminsId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':adminsId', $adminsId, PDO::PARAM_INT);
    $cmd->execute();
    $admin = $cmd->fetch();
    $username = $admin['username'];
    $db = null;
}
?>

<h1>Admin Information</h1>
<form action="save-admin.php" method="post">
    <fieldset>
        <label for="username">Username:</label>
        <input name="username" id="username" required value="<?php echo $username; ?>"/>
    </fieldset>
    <input name="adminsId" id="adminsId" value="<?php echo $adminsId; ?>" type="hidden"/>
    <button>Save</button>
</form>

</body>
</html>