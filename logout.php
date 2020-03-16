<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
</head>
<body>
<?php
session_start();
session_unset();
session_destroy();
header('location:login.php');
?>
</body>
</html>