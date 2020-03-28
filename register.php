<?php
$title = 'Register';
require_once 'header.php';
?>
    <div id="register">
        <h1 id="registerHeader">User Registration</h1>
        <form id="registerForm" method="post" action="save-registration.php">
            <fieldset>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input class="form-control" name="username" id="username" required type="email" maxlength="50"
                           placeholder="Enter Email"/>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input class="form-control" type="password" name="password" id="password"/>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label for="confirm">Confirm Password:</label>
                    <input class="form-control" type="password" name="confirm" id="confirm" required/>
                </div>
            </fieldset>
            <div>
                <input class="btn btn-primary btn-block" type="submit" value="Register"/>
            </div>
        </form>
    </div>
<?php
require_once 'footer.php';
?>