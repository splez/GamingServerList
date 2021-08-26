<html>
<?php

?>
<head>

</head>

<body style="background-color:#dbd9c2" >
<?php

//include "connection.php";

?>

<header style="background-color:#8badb1">
<a href="index.php"><button style="font-size:200%; background-color: 
#8badb1; border:none; ">GamingServerList</button></a>

<?php



 	//using the class
	//use MCServerStatus\MCPing;
	//include composer autoload
//	require_once('../vendor/autoload.php');


$showLogout = 0;

echo $_SESSION['user_email_address'];

/*
	if(isset($_SESSION["usernameUser"])){

$showLogout = 1;

}else{

if(isset($_SESSION["user_email_address"])){

$showLogout = 1;

}else{

$showLogout = 0;

}

}
*/

session_start();
if(isset($_SESSION["usernameUser"])){
?>
<a href="logout.php" style="float: right;"><button style="font-size:200%;background-color:#8badb1; border:none">Logout</button></a>
<a href="myservers.php" style="float: right"><button style="font-size:200%;background-color:#8badb1; border:none">Add Server</button></a>
</header>

<div style="background-color: #b7cfbe; text-align: right; width: 99.8%; border: 1px solid black;float:right;"><?php
echo $theUsername = $_SESSION["usernameUser"];
?></div>
</nav>

<?php
}else{
?>
<a href="login.php" style="float: right"><button style="font-size:200%;background-color: 
#8badb1; border:none">Login</button></a>
</header>
<?php
}
?>
<h1>Minecraft Java Servers:</h1>


<?php
//session_start();

session_start();
$usernameUser = $_SESSION["usernameUser"];

include "connection.php";

$sql5 = "SELECT * FROM minecraftservers ORDER BY voting DESC";
$result5 = $conn->query($sql5);

if (!$conn->query($sql5)){
  echo("Error description: " . $conn -> error);
}else{
//echo "sd";
}


if ($result5->num_rows > 0) {
  // output data of each row
  while($row = $result5->fetch_assoc()) {

echo "<br>";


?>



<form action="read.php" style="background-color: none;text-decoration: none; color:black">
<button name="button" value="<?php echo $row['id']; ?>" style="border:none; overflow:hidden; width:100%; background-color:#dbd9c2">

<div style="background-color: #9cbcba;text-align: center;border:1px solid black; width:100%;height:10%;overflow:hidden">

<img style="height:60px; width:468px;" src="<?php

$path = 'uploads/'.$row['username'].'/' . $row['img'];

echo $path;

?>" alt=""></img>

</div>
<div name="serverClick" style="background-color: #9cbcba;text-align: center;border:1px solid black; width:100%;height:10%;overflow:hidden">
<?php
echo "<br>Name:" . $getName = $row['name'];
?>
</div>
<div style="background-color: #9cbcba;text-align: center;border:1px solid black; width:100%;height:10%;overflow:hidden">
<?php
echo "<br>Ip:" . $getIp = $row['ip'];
?>
</div>
<div style="background-color: #9cbcba;text-align: center;border:1px solid black; width:100%;height:10%;overflow:hidden">
<?php
echo "<br>Description:" . $getDes = $row['description'];
?>
</div>
<div style="background-color: #9cbcba;text-align: center;border:1px solid black; width:100%;height:10%;overflow:hidden">
<?php
echo "<br>Vote Rating:" .$getVote = $row['voting'];
?>

</div>

<div style="background-color: #9cbcba;text-align: center;border:1px solid black; width:100%;height:10%;overflow:hidden">

<?php

$getport = $row['port'];
$host = $getIp; 
$port = $getport; 
$waitTimeoutInSeconds = 1; 
if($fp = fsockopen($host,$port,$errCode,$errStr,$waitTimeoutInSeconds)){   

echo "<br>Online";
   // It worked 
} else {

echo "<br>Offline";
   // It didn't work 
} 
fclose($fp);

?>

</div>


</button>
</form>




<?php

$ip = $row['ip'];
$port = $row['port'];


 

	

	//checking account
	//$response=MCPing::check('play.loxcraft.com');


//$output = print_r($array, true);

//echo $response['online'];

	//get informations from object
//	var_dump($response);
	
	//or from array
//	var_dump($response->toArray());
 



//check if the connection worked and the server is online





}

}else {
 // echo "No Servers Created";
}

?>




</body>

</html>