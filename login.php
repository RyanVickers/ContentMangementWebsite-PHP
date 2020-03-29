<?php
$title = 'Login';
require_once 'header.php';
?>
    <div id="login">
        <h1 id="loginHeader">Login</h1>
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
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input class="form-control" name="username" id="username" required type="email"
                           placeholder="Enter Email"/>
                </div>
            </fieldset>
            <fieldset>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input class="form-control" type="password" name="password" id="password" required/>
                </div>
            </fieldset>
            <div>
                <input class="btn btn-primary btn-block" type="submit" value="Login"/>
            </div>
        </form>
    </div>
<?php
require_once 'footer.php';
?>