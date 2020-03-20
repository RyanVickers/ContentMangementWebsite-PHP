<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
</head>
<body>
<?php

if (empty($_SESSION['userId'])) {
    header('location:login.php');
    exit();
}
$adminId = null;
$username = null;
if (!empty($_GET['adminId'])) {
    $adminId = $_GET['adminId'];
    require_once 'db.php';
    $sql = "SELECT * FROM admins WHERE adminId = :adminId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':adminId', $adminId, PDO::PARAM_INT);
    $cmd->execute();
    $admin = $cmd->fetch();
    $username = $admin['username'];
    $db = null;
}
?>

<h1>Admin Information</h1>
<form action="save-admin.php" method="post">
    <fieldset>
        <label for="email">Email:</label>
        <input name="name" id="name" required value="<?php echo $username; ?>"/>
    </fieldset>
    <input name="adminId" id="adminId" value="<?php echo $adminId; ?>" type="hidden"/>
    <button>Save</button>
</form>

</body>
</html>