<html>

<head>
    <script>

function reg(){
window.location.replace("register.php");
}

</script>

<?php

//index.php

//Include Configuration File
include('config.php');
include('connection.php');

$login_button = '';

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
 //It will Attempt to exchange a code for an valid authentication token.
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
 if(!isset($token['error']))
 {
  //Set the access token used for requests
  $google_client->setAccessToken($token['access_token']);

  //Store "access_token" value in $_SESSION variable for future use.
  $_SESSION['access_token'] = $token['access_token'];

  //Create Object of Google Service OAuth 2 class
  $google_service = new Google_Service_Oauth2($google_client);

  //Get user profile data from google
  $data = $google_service->userinfo->get();



  //Below you can find Get profile data and store into $_SESSION variable
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if(!isset($_SESSION['access_token']))
{
 //Create a URL to obtain user authorization
 $login_button = '<a href="'.$google_client->createAuthUrl().'"><img style="height:50px;width:50px;" src="https://icon-library.com/images/google-login-icon/google-login-icon-24.jpg" /></a>';
}

  if(isset($_SESSION['user_email_address']))
  {

$theemail = $_SESSION['user_email_address']; 

 $sql = "SELECT * FROM users WHERE email='$theemail'";
 $result = $conn->query($sql);



if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $email = $row['email'];
}

}



if(!isset($email)){
 $sql444 = "INSERT INTO users(email, username, password) VALUES ('$theemail', '$theemail', 'f3MakqPvacCPxxG2')";
 $result444 = $conn->query($sql444);

mkdir("/opt/lampp/htdocs/website/gamingserverlist/uploads/$theemail", 0777);

}

$_SESSION["usernameUser"] = $_SESSION['user_email_address'];



header("Location: index.php");
exit();
}


?>


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

<input name="register" type="button" onclick="reg()" style="background-color:#dbd9c2;font-size:150%" value="register"></input>

<input type="submit" value="login" style="background-color:#dbd9c2; font-size:150%"></input>
</form>

 <div class="container">
   <div class="panel panel-default">
   <?php
   if($login_button == '')
   {
  //  echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';

?>
<img style="height:1%;width:1%;" src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" ></img>
<?php
 //  echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';



  //  echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
  //  echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
  //  echo '<h3><a href="logout.php">Logout</h3></div>';
   }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
   }
   ?>
   </div>


<?php

error_reporting(0);

include "connection.php";
session_start();

if(isset($_POST["register"])){
header("location: register.php");
exit();
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
if(isset($usernameInput)){
  echo "email/username or password incorrect";
}
}


if($usernameInput!=null||$passwordInput!=null){

if(isset($checkUserExist)){
$_SESSION["usernameUser"] = $theUsername;
header("location: index.php");
exit();
}

}

?>


</section>
</body>

</html>