<html>

<head>
</head>

<body style="background-color:#dbd9c2">

<header style="background-color:#8badb1">
<a href="index.php"><button style="font-size:200%; background-color: 
#8badb1; border:none; color" >GamingServerList</button></a>
</header>

<section style="border: 1px solid black">

<?php


$button = $_GET['button'];

include "connection.php";

$sql5 = "SELECT * FROM minecraftservers WHERE id='$button'";
$result5 = $conn->query($sql5);


if ($result5->num_rows > 0) {

  while($row = $result5->fetch_assoc()) {

echo "<br>Name:" . $row['name'];
echo "<br>Ip:" . $row['ip'];
echo "<br>Description:" . $row['description'];
echo "<br>Voting Rating:" . $row['voting'];
}

}
?>
<br>

<form action="vote.php">
<button name="button" value="<?php echo $button; ?>" style="border:none; overflow:hidden; width:100%; background-color:#dbd9c2">
<input hidden name="inputx" value="<?php echo $button; ?>" style="font-size:200%; background-color: #dbd9c2; width:100%; float: right"></input>
<input name="input" type="submit" value="vote" style="font-size:200%; background-color: #dbd9c2; width:100%; float: right"></input>

</form>

</section>

</body>
</html>