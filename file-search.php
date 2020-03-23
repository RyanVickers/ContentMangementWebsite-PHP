<?php
$title = 'Logo Upload';
require_once 'header.php';
require_once 'authenticate.php';
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>File Search</title>
    </head>
    <body>
    <form method="post" action="file-upload.php" enctype="multipart/form-data">
        <fieldset>
            <label for="logo">Upload Logo:</label>
            <input name="logo" id="logo" type="file"/>
        </fieldset>
        <button>Submit</button>
    </form>
    </body>
    </html>
<?php
require_once 'footer.php';
?>