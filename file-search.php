<?php
$title = 'Logo Upload';
require_once 'header.php';
//Authentication
require_once 'authenticate.php';
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>File Search</title>
    </head>
    <body id="logoPage">
    <!--    file upload form-->
    <form id="logoForm" method="post" action="file-upload.php" enctype="multipart/form-data">
        <fieldset>
            <label id="logoLabel" for="logo">Upload Logo to Website</label><br/>
            <input name="logo" id="logo" type="file"/>
        </fieldset>
        <button class="btn btn-primary">Submit</button>
    </form>
    </body>
    </html>
<?php
require_once 'footer.php';
?>