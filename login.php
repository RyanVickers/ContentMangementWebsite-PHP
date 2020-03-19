<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h1>Login</h1>
<a href="register.php">Register</a>
<?php
//checks for invalid login
if (!empty($_GET['invalid'])) {
    if ($_GET['invalid'] == "true") {
        echo '<div>Invalid Login</div>';
    } else {
        echo '<div>Enter Login Information</div>';
    }
} else {
    echo '<div>Enter Login Information</div>';
}
?>

<form method="post" action="validation.php">
    <fieldset>
        <label for="username">Username:</label>
        <input name="username" id="username" required type="email" placeholder="emailname@email.com"/>
    </fieldset>
    <fieldset>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required/>
    </fieldset>
    <div>
        <input type="submit" value="Login"/>
    </div>
</form>

</body>
</html>