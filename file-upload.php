<?php
$title = 'Format Error';
require_once 'header.php';
require_once 'authenticate.php';
require_once 'footer.php'
?>


<?php
$file = $_FILES['logo'];
$name = $file['name'];
$tmp_name = $file['tmp_name'];
$type = mime_content_type($tmp_name);
$size = $file['size'];
if (!empty($file['tmp_name'])) {
    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo '<h1>Incorrect file Format</h1><br/>';
        echo "Name: $name<br/>";
        echo "Type: $type<br/>";
        echo 'Photo Must be a .jpg or .png file';
        exit();
    }
    move_uploaded_file($tmp_name, "logos/logo.png");
}


header('location:file-search.php');

?>
