<html>

<head>
</head>

<body  style="background-color:#dbd9c2">

<?php

error_reporting(0);
include "connection.php";

session_start();
$usernameSession = $_SESSION["usernameUser"];



$sqlSelectSession3 = "SELECT * FROM users WHERE username='$usernameSession' OR email='$usernameSession'";
$resultSelectSession = $conn->query($sqlSelectSession3);

if ($resultSelectSession->num_rows > 0) {
  // output data of each row
  while($row = $resultSelectSession->fetch_assoc()) {
 $imgNumber = $row['img'];
 $emailNumber = $row['email'];
}

}





?>
<header style="background-color:#8badb1">
<a href="account.php"><button style="font-size:200%; background-color: 
#8badb1; border:none; ">GamingServerList</button></a>
</header>
<form method="post" method="post" enctype="multipart/form-data">

<h1 style="text-align:center; width:100%">Create Minecraft Server</h1>

<section style="border: 1px solid black; text-align: center">

<p>Name:</p>
<input name="name" type="text"></input>

<p>Ip:</p>
<input name="ip" type="text"></input>

<p>Port:</p>
<input name="port" type="text"></input>

<p>Description:</p>
<textarea style="height: 20%;width:50%;name="description"></textarea>
<br>
<br>

  <input type="file" name="fileToUpload" id="fileToUpload">
 <br><br>

<?php

$target_dir = "uploads/amosvorn@gmail.com/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//echo $target_file;

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

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
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 3000000) {
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

$fileName = $imgNumber.".".$imageFileType;
$returnTarget = $target_dir.$fileName;
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $returnTarget)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

$sqlSelectSession2 = "UPDATE users SET img = img + 1 WHERE username='$usernameSession' OR email='$usernameSession'";
$resultSelectSession2 = $conn->query($sqlSelectSession2);


  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

?>


<h1>Votifier</h1>

<p>Ip</p>
<input name="ipv"></input>
<p>Port</p>
<input name="portv"></input>
<p>PublicKey</p>
<input name="publickeyv"></input>

<br><br>
<input style="background-color: #dbd9c2;font-size:150%" type="submit"></input>
</form>

<?php
session_start();
include "connection.php";

$namex = $_POST["name"];
$ipx = $_POST["ip"];
$description = $_POST['description'];
$usernamex = $_SESSION['usernameUser'];
$portx = $_POST["port"];


//votifer

$ipv = $_POST["ipv"];
$portv = $_POST["portv"];
$publickeyv = str_replace(' ', '+', $_POST["publickeyv"]);

//ip address of you server
$ip = $ipx;
//port of your minecraft server
if($portx==null){
$port = 25565;
}else{
$port = $portx;
}


if($namex!=null||$ipx!=null||$description!=null){
$sql2 = "INSERT INTO minecraftservers(name, ip, description, username, port, ipv, portv, publickeyv, img) VALUES ('$namex', '$ipx', '$description', '$usernamex', '$port', '$ipv', '$portv', '$publickeyv', '$fileName')";
$conn->query($sql2);

if($uploadOk == 1){
header("location: myservers.php");
exit();
}
}else{
echo "<br>Error: All Inputs must be filled out";
}


?>


</section>


</body>

</html>