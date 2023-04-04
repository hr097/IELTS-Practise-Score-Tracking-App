<?php


require_once("../logic.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="1"))
{
 $JAMES->ams_redirect("../login.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- including header -->
    <?php
    include './common/header.php';
    ?>

    <!-- css  -->
    <link rel="stylesheet" href="../css/faculty.css">

    <!-- js  -->
    <script src="../js/faculty/dashboard.js" type="text/javascript" defer=true></script>

    <!-- Page information -->
    <title>IELTS BUDDY| Faculty Dashboard</title>


</head>

<body>

     <div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
             <div class="col-12 col-xl-8 mb-4 mb-xl-50">
                    <h3 class="font-weight-bold">Welcome  Coach,
                    </h3>
                    <h6 id="daymode" class="font-weight-normal mb-10"></h6>
             </div>
        </div>
             

        </div>
    </div>
    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>
</body>

</html>