<html>

<head>
</head>

<body style="background-color:#dbd9c2">
<header style="background-color:#8badb1">
<a href="index.php"><button style="font-size:200%; background-color: 
#8badb1; border:none;" >GamingServerList</button></a>
</header>
<?php include "connection.php"; ?>

<section style="border: 1px solid black; text-align: center">

<a href="login.php"><button style="float:left; font-size: 200%; background-color: #dbd9c2;">back</button></a>
<br><br>
<form method="post">
<p>Email</p>
<input name="email" type="input"></input>
<p>Username</p>
<input name="username" type="input"></input>
<p>Password</p>
<input name="password" type="password"></input>
<p>ConfirmPassword</p>
<input name="confirmpassword" type="password"></input>

<br><br>
<input style="background-color: #dbd9c2;font-size: 150%" type="submit" value="Register"></input>
</form>




<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


error_reporting(0);
session_start();
include 'connection.php';

$dataWorked = 0;

$emailInput  = $_POST["email"];
$usernameInput = $_POST["username"];
$passwordInput = $_POST["password"];
$confirmpasswordInput = $_POST["confirmpassword"];

$_SESSION['email'] = $emailInput;

$_SESSION['username'] = $usernameInput;

$_SESSION['password'] = $passwordInput;

$_SESSION['confirmpassword'] = $confirmpasswordInput;

$emailCheck = "/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/";
$passwordCheck  = "/.{8,}/";

if($emailInput!=null){
if(preg_match($emailCheck, $emailInput)){
$dataWorked = 1;
}else{
$dataWorked = 0;
echo "<br>Error: Must be vaild email.";
}

if(preg_match($passwordCheck, $passwordInput)){
$dataWorked = 1;
}else{
$dataWorked = 0;
echo "<br>Error: Password must be more then 8 character";
}


if($passwordInput!=$confirmpasswordInput){
$dataWorked = 0;
echo "<br>Error: Password must match";
}

//check if user exist?

$sql = "SELECT * FROM users WHERE username='$usernameInput'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

$usernameCheck .= $row['username'];

  }
} else {

}

if(isset($usernameCheck)){
echo "<br>Username Already Exist";
$dataWorked=0;
}




$sql = "SELECT * FROM users WHERE email='$emailInput'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

 $emailCheckx = $row['email'];

  }
} else {

}

if($emailCheckx!=null){
echo "<br>Email Already Exist";
$dataWorked=0;
}


if($dataWorked==1){

$vNumber = rand(1000,9999);
$_SESSION["vNumCheck"] = $vNumber;

/*
    $to      = "$emailInput";
    $subject = 'GamingServerList Verfication Number';
    $message = "Your Verfication Number Is $vNumber";
    $headers = 'From: webmaster@example.com'       . "\r\n" .
                 'Reply-To: webmaster@example.com' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
*/    
    
/*
$vNumber = 0;
$vNumber = rand(1000,9999);


    $to      = "$email";
    $subject = 'GamingServerList Verfication Number';
    $message = "Your Verfication Number Is $vNumber";

    mail($to, $subject, $message);


    $_SESSION['varname'] = $vNumber;
*/


//Load Composer's autoloader
// require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
  //  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'kappabirdy@gmail.com';                     //SMTP username
    $mail->Password   = 'Greenwolf17$';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress($emailInput, 'Joe User');     //Add a recipient
   // $mail->addAddress('ellen@example.com');               //Name is optional
  //  $mail->addReplyTo('info@example.com', 'Information');
 //   $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    //Attachments
//    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
 //   $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'GamingServerList Verification code';
    $mail->Body    = "This is your Verification Number:  <b>$vNumber</b>";
    $mail->AltBody = 'Thanks for using GamingServerList';

    $mail->send();
    echo 'Message has been sent';
header("location: emailcheck.php");

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
echo $emailInput;
}




}

}

?>
</section>
</body>

</html>