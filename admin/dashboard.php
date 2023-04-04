<?php


require_once("../logic.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="2"))
{
 $JAMES->ams_redirect("../login.php");
}


echo "this is admin side dashboard";

?>

<button onclick=" window.location.href ='../logout.php'">Logout</button>