<?php

require_once("./logic.php");

$JAMES = new AMS();
$JAMES->init_user_session();

if($JAMES->checkSession()===true) // if session active than redirect user to his/her dashboard
{
    $JAMES->redirect_ams_user(((int) $_SESSION['_userType'])); 
}

?>

<!DOCTYPE html>
<html lang="en-IN">

<head>

    <!-- Meta data about page -->

    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>


    <!-- Search Engine use --->

    <meta name='author' content='Team IELTS BUDDY'/>
    <meta name='description' content='An efficient & relible IELTS Practise Test Score Tracking Application'/>
    <meta name='key words' content='IELTS,Score,Test,Preparation,Tool,Guide,Track,Help,Buddy,Application'/>
    <meta http-equiv='refresh' content='120'>


    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">

    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
    <!-- bootstrap icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
   
    <!-- css  -->
    <link rel="stylesheet" href="./css/template.css">
    <link rel="stylesheet" href="./css/modal.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">

    <!--javaScript-->
    <script src="./js/authentication/register.js" type="text/javascript" defer=true></script> <!-- //!modified by hr097
    --> 
    <noscript>Your browser does not support Javascript!</noscript>

    <!--JS library files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>

    <!--jQuery file-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- page information and favicon-->
    
    <title>IELTS BUDDY | Register</title>

    <link rel="shortcut icon" href="./assets/logos/favicon.ico">

    <!-- pwa application -->  <!-- //! UNCOMMENT IT FOR PWA APP : but it has some issue with some  of the devices -->
    <!-- <link rel="manifest" href="manifest.json">
    <script src="pwa.js"></script> -->

</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5 loginbox">

                            <!-- Logo,Header and title : Start-->
                            <div class="brand-logo text-center">
                                <img src="./assets/logos/login-logo.png" alt="logo">
                                <h2 class="mt-3 title unselectable form-header">IELTS BUDDY</h2>
                            </div>
                            <h2 class="font-weight-bolder text-center unselectable form-header">Register</h2>

                            <!-- Logo,Header and title : End-->

                            <!-- Form : Start -->
                            <form class="pt-3" id="userlogin" autocomplete="on" action="#">

                                    <!-- Error message -->
                                    <div class="alert alert-danger" id="error-message">
                                        <ul id="message" style="list-style-type:none;"></ul>
                                    </div>

                                    <!-- Email and password : Start-->
                                    <div class="form-group">
                                        <input type="text" autofocus="true" class="form-control form-control-lg fieldstyle" maxlength="256" id="username" placeholder="Enter your email">
                                    </div>

                                    <div class="form-group psd-icon">
                                        <i class="bi bi-eye-slash fa-lg eye-icon" id="togglePassword"></i>
                                        <div class="form-group psd-icon">
                                        <i class="bi bi-eye-slash fa-lg eye-icon" id="togglePassword1"></i>
                                        <input type="password" autofocus="true" id="password1" minlength="8" maxlength="16" class="form-control form-control-lg fieldstyle password" placeholder="Select your password">
                                    </div>

                                    <div class="form-group psd-icon">
                                        <i class="bi bi-eye-slash fa-lg eye-icon" id="togglePassword2"></i>
                                        <input type="password"  id="password2" onpaste="return false;" ondrop="return false;" autocomplete="off" minlength="8" maxlength="16" class="form-control form-control-lg fieldstyle password" placeholder="Confirm your password">
                                    </div>

                                        <!--      //! modified by hr097                               
                                        <input type="password" class="form-control form-control-lg fieldstyle" minlength="8" maxlength="16" id="password" placeholder="select your password"> 
                                        -->
                                       
                                        <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>"> 
                                    </div>
                                    <!-- Email and password : End-->

                                    <!-- Remember me , forgot password and  login button : Start -->

                                     <!--   //! modified by hr097      
                                        <div class="my-2 d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-info ml-1 mt-1" name="_rememberMe" id="remember-me">
                                            <label for="remember-me" class="rememberme-txt unselectable mt-0" >Remember me</label>
                                        </div>
                                        <a class="auth-link text-black" style="margin-top:-6px;" id="forgotpassword">Forgot password?</a>
                                     </div> 
                                    -->

                                    <div class="mt-2 text-center">
                                        <input type="button" class="btn btn-primary btn-icon-text" name="Register" id="register" style="width:150px;height:46px;" value="Register">
                                        <br>
                                        <p style="text-align:center;font-size:0.8em;position:relative;top:30px;"><a style='text-decoration:none;color:black;' href="login.php">Already a Registered User ?</a></p>  
                        
                                        <!-- <p style="text-align:center;font-size:0.5em;position:relative;top:30px;"><a style='text-decoration:none;color:black;' href="https://ams.vnsguit.org/android-app/james.apk">Download an Android App</a></p>  //!modifield by hr097
                                        -->
                                    </div>
                                   
                                    <!-- Remember me , forgot password and  login button : End -->
                            </form>
                            <br>
                            <p class ="unselectable" style="text-align:center;text-decoration:underline;color:black;margin-top:20px;font-size:0.7em;"><span style="font-weight:bold;">NOTE:</span> Your registered email will be your username for login.</p>
                            <!-- Form : End -->
                        </div>
                        <p style="text-align:center;font-size:0.5em;position:relative;top:30px;"><?php echo date("Y") ?> <a style='text-decoration:none;color:black;' href="https://github.com/hr097/IELTS-Practise-Score-Tracking-App">Team IELTS Buddy</a> | Developed by <a href="https://slackbyte.com">SlackByte Developers</a></p> 
                    </div>
               </div>
           </div>
        </div>
    </div>

    <!-- modal -->
    <div id="modal" class="modal">
        <!-- modal content -->    
            <div class="modal-content" style="width:360px;">
            <span class="close">&times;</span>
            <p class="msg unselectable"></p>
            <div class="row" style="margin:auto;margin-bottom:30px;">
                <button id="yes-button" class="modal-btn">Okay</button>
                <!-- <button id="no-button" class="modal-btn">Cancel</button> -->
            </div>
       
        </div>
    </div>
</body>

</html>