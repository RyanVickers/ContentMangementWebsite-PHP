<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
</head>
<body>
<?php
session_start();//enter user session
session_unset();//unset variables
session_destroy();//end session
//redirect to login page
header('location:login.php');
?>
</body>
</html>