<html>

<head>
</head>

<body  style="background-color:#dbd9c2">

<?php

error_reporting(0);

?>
<header style="background-color:#8badb1">
<a href="account.php"><button style="font-size:200%; background-color: 
#8badb1; border:none; ">GamingServerList</button></a>
</header>
<form method="post">

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
$sql2 = "INSERT INTO minecraftservers(name, ip, description, username, port, ipv, portv, publickeyv) VALUES ('$namex', '$ipx', '$description', '$usernamex', '$port', '$ipv', '$portv', '$publickeyv')";
$conn->query($sql2);

header("location: myservers.php");
}else{
echo "<br>Error: All Inputs must be filled out";
}


?>


</section>


</body>

</html>