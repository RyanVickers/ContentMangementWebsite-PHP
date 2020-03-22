<?php
// check for if user is not logged in
if (empty($_SESSION['adminsId'])) {
    header('location:login.php');
    exit();
}
?>