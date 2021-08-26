<html>

<body style="background-color:#dbd9c2">

<?php
error_reporting(0);
session_start();
 $vNumber = $_SESSION['varname'];
?>

<h1>Verify Number</h1>
<p>may take some time (up to 5mins)</p>
<form method="post">
<input name="vNumCheck"></input>
<button type="submit">Submit</button>
</form>

<?php
include 'connection.php';

$vNumCheck = $_POST["vNumCheck"];

$emailUser = $_SESSION['email'];

$usernameUser = $_SESSION['username'];

$passwordUser = $_SESSION['password'];

$confirmpassword = $_SESSION['confirmpassword'];

if($vNumCheck==$vNumber){
echo "TRUE";

  $sql = "INSERT INTO users(email,username,password) VALUES ('$emailUser', '$usernameUser', '$passwordUser')";
  $result = $conn->query($sql);

echo "XX" .  $_SESSION["usernameUser"] = $usernameUser;

mkdir("/opt/lampp/htdocs/website/gamingserverlist/uploads/$usernameUser", 0777);

header("location: index.php");
exit();
}else{

if(isset($vNumCheck)){
echo "Verfication Number Is Wrong";
}
}

?>



</body>

</html>