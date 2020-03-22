<?php
$title = 'Register';
require_once 'header.php';
?>
    <h1>User Registration</h1>
    <form method="post" action="save-registration.php">
        <fieldset>
            <label for="username">Username:</label>
            <input name="username" id="username" required type="email" maxlength="50"
                   placeholder="emailname@email.com"/>
        </fieldset>
        <fieldset>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password"/>
        </fieldset>
        <fieldset>
            <label for="confirm">Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" required/>
        </fieldset>
        <div>
            <input type="submit" value="Register"/>
        </div>
    </form>
<?php
require_once 'footer.php';
?>