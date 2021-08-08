<html>

<head>
</head>

<body style="background-color:#dbd9c2">
<header style="background-color:#8badb1">
<a href="index.php"><button style="font-size:200%; background-color:#8badb1; border:none">GamingServerList</button></a>
</header>

<section style="border: 1px solid black; margin-left: 20%; margin-right: 20%; text-align: center">
<form method="post">
<p>Username/Email</p>
<input name="usernameInput" type="input"></input>
<p>Password</p>
<input name="passwordInput" type="password"></input>
<br><br>

<input name="register" type="submit" style="background-color:#dbd9c2;font-size:150%" value="register"></input>

<input type="submit" value="login" style="background-color:#dbd9c2; font-size:150%"></input>
</form>


<?php

error_reporting(0);

include "connection.php";
session_start();

if(isset($_POST["register"])){
header("location: register.php");
}


$usernameInput = $_POST['usernameInput'];
$passwordInput = $_POST['passwordInput'];

//  $sql = "SELECT * FROM users WHERE (username=$usernameInput OR email=$emailInput) AND password=$passwordInput";
//  $result = $conn->query($sql);


 $sql = "SELECT * FROM users WHERE (username='$usernameInput' OR email = '$usernameInput') AND password='$passwordInput'";
 $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    
$checkUserExist = $row["id"];
$theUsername = $row["username"];

}
} else {
  echo "email/username or password incorrect";
}


if($usernameInput!=null||$passwordInput!=null){

if(isset($checkUserExist)){
$_SESSION["usernameUser"] = $theUsername;
header("location: index.php");
}

}



?>
</section>
</body>

</html>