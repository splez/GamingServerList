<html>

<head>
</head>

<body style="background-color:#dbd9c2">

<header style="background-color:#8badb1">
<a href="account.php"><button style="font-size: 150%; background-color:#8badb1">GamingServerList</button></a>
</header>
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
echo $idx = $row['id'];
?>


<form method="post">
<input  style="background-color:#dbd9c2" type="submit" name="<?php echo $idx; ?>" value="X Delete"></button>

<?php

?>
</form>
</section>
<?php

if(isset($_POST[$idx])){
  $sqlQ = "DELETE FROM minecraftservers WHERE id='$idx'";
  $resultQ = $conn->query($sqlQ);
  header("location: myservers.php");
}




  }
} else {
  echo "No Servers Created";
}





?>

</body>

</html>