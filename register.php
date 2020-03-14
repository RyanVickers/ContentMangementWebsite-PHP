<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
</head>
<body>
<h1>User Registration</h1>
<form method="post" action="save-registration.php">
    <fieldset>
        <label for="username">Username:</label>
        <input name="username" id="username" required type="email" maxlength="50" placeholder="emailname@email.com"/>
    </fieldset>
    <fieldset>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
    </fieldset>
    <fieldset>
        <label for="confirm">Confirm Password:</label>
        <input type="password" name="confirm" id="confirm" required/>
    </fieldset>
    <div>
        <input type="submit" value="Register"/>
    </div>
</form>
</body>
</html>