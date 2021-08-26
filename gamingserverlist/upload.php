<?php

include "connection.php";
session_start();


$theusernameget = $_SESSION["usernameUser"];

$target_dir = "uploads/$theusernameget/";
$target_file = $target_dir;
$target_file2 = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file2)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {


$sql = "SELECT * FROM users WHERE username='$theusernameget'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {

$intx = $row['inputint'];

}
}

$sql2 = "UPDATE users SET inputint=inputint + 1 WHERE username='$theusernameget'";
$result2 = $conn->query($sql2);

 $filename = "$intx".".".$imageFileType;

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file . $filename)) {
    // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

  } else {

    echo "<h1>Sorry, there was an error uploading your file.</h1>";

  }


}
?>