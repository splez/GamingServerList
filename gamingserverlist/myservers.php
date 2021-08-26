<html>

<head>
</head>

<body style="background-color:#dbd9c2">

<header style="background-color:#8badb1">
<a href="index.php"><button style="font-size: 200%;background-color: 
#8badb1; border:none; ">GamingServerList</button></a>
</header>
<br>

<a href="createServer.php"><button style=" background-color: #b7cfbe;font-size: 200%;float:left">Add Minecraft Server</button></a>
<br><br>

<h1>My Servers</h1>




<?php
session_start();
include "connection.php";

$usernameUser = $_SESSION["usernameUser"];

$sql5 = "SELECT * FROM minecraftservers WHERE username='$usernameUser'";
$result5 = $conn->query($sql5);

if ($result5->num_rows > 0) {
  // output data of each row
  while($row = $result5->fetch_assoc()) {

?>
<section style="border: 1px solid black">
<?php
echo "<br>";
echo "<br>Name:" . $getName = $row['name'];
echo "<br>Ip:" .$getIp = $row['ip'];
echo "<br>Description:" .$getDes = $row['description'];
$idx = $row['id'];
?>
<br>
<img style="height:60px; width:468px;" src="<?php
echo "uploads/$usernameUser/" . $row['img'];
?>"></img>
<br>
<form method="post">
<input  style="background-color:#dbd9c2" type="submit" name="<?php echo $idx; ?>" value="X Delete"></button>
</form>
</section>
<?php

if(isset($_POST[$idx])){
  $sqlQ = "DELETE FROM minecraftservers WHERE id='$idx'";
  $resultQ = $conn->query($sqlQ);
  header("Location: myservers.php");
exit();
}




  }
} else {
  echo "No Servers Created";
}





?>

</body>

</html>