<?php

//logout.php

//include('config.php');

//Reset OAuth access token
//$google_client->revokeToken();

//Destroy entire session data.
session_destroy();


session_start();
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
session_regenerate_id(true);
header("Location: index.php");
exit();
?>