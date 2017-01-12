<?php
$name = $_FILES['file']['name'];

$tmp_name = $_FILES['file']['tmp_name'];

if (isset($name)) {
    if (!empty($name)) {
        $location = 'uploads/';

        echo $name;

        if (move_uploaded_file($tmp_name, $location . $name)) {
            echo 'File successfully uploaded';
        }

    } else {
        echo 'Please choose a file';
    }
}

$path = "uploads/";
$dh = opendir($path);
$i=1;
echo "<tr>";
while (($file = readdir($dh)) !== false) {
    if($file != "." && $file != ".." && $file != "index.php" && $file != ".htaccess" && $file != "error_log" && $file != "cgi-bin" ) {
        echo "<td><a href='$path/$file'>$file</a><br /></td>";
        $i++;
    }
}
echo "</tr>";
closedir($dh);
?>

<form action="uploads.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file"><br><br>
    <input type="submit" value="Submit">
</form>
