<?php
$title = 'Format Error';
require_once 'header.php';
require_once 'authenticate.php';
require_once 'footer.php'
?>

<?php
//getting file
$file = $_FILES['logo'];
$name = $file['name'];
$tmp_name = $file['tmp_name'];
//getting content type
$type = mime_content_type($tmp_name);
$size = $file['size'];
if (!empty($file['tmp_name'])) {
    //makes sure img is jpeg or png
    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo '<h1>Incorrect file Format</h1><br/>';
        echo "Name: $name<br/>";
        echo "Type: $type<br/>";
        echo 'Photo Must be a .jpg or .png file';
        exit();
    }
    //replaces logo file
    move_uploaded_file($tmp_name, "logos/logo.png");
}

//redirect to file search page
header('location:file-search.php');

?>

