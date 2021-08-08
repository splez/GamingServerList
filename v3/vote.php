
<body style="background-color:#dbd9c2">
<?php
error_reporting(0);
?>
<header style="background-color: 
#8badb1">
<a href="index.php"><button style="font-size:200%; background-color: 
#8badb1; border:none; ">GamingServerList</button></a>
</header>
<br><br>

<section style="text-align:center; margin-left: 20%; margin-right:20%; border:1px solid black;">
<p>Minecraft Username:</p>
<form method="post">
<input name="username" type="text"></input>
<input type="submit" style="background-color:#dbd9c2" value="vote"></input>
</form>
</section>



<?php



include "connection.php";
include "MinecraftVotifier.php";

use \Spirit55555\Minecraft\MinecraftVotifier;

$theusername = $_POST['username'];

$inputx = $_GET['inputx'];

 $sql = "SELECT * FROM minecraftservers WHERE id='$inputx'";
 $result = $conn->query($sql);

if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {


$name = $row['name'];
$idGet = $row['id'];


$ipv = $row['ipv'];
$portv = $row['portv'] + 0;
$publickeyv = $row['publickeyv'];

}

}




if(isset($_POST['username'])){

  $sqlupdate = "UPDATE minecraftservers SET voting = voting + 1 WHERE id='$idGet'";
  $result = $conn->query($sqlupdate);
  

  $votifier = new MinecraftVotifier($publickeyv, $ipv, $portv, 'GamingServerList');
  $votifier->sendVote($theusername);

header('location: index.php');

}
?>
</body>