<?php
require_once("../logic.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="3"))
{
 $JAMES->ams_redirect("../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- including header -->
    <?php
          include './common/header.php'
        ?>

    <!-- Page info -->
    <title>IELTS BUDDY | About Us</title>

    <!-- css  -->
    <link rel="stylesheet" href="../css/faculty.css">

</head>

<body>
    <!-------------------------------------------------------Main Content------------------------------------------------------->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="container" style="display: inline-block;">
                <!-- <h2 class="underline">About IELTS BUDDY AMS</h2> -->

                <h5 class="small_titles"> About IELTS BUDDY</h5>
                <p class="about-content">
                  IELTS(International English Language Testing System) is English proficiency examination conducted by IDP Australia where Entire Test is consist of 4 module(Listening,Reading,Writing,Speaking) and each module is assessed by 0-9 band score. This App is specifically designed for IELTS coach and students to keep track of their IELTS preparation(mock test) record in digitalized manner and shows real time progress as well well proficiency level of student and based on machine learning model it suggest to enroll for upcoming official IELTS test.</p><br>

                <h5 class="small_titles">About Developers</h5>
                <p class="about-content">
                <a style='text-decoration:none;color:black;' href="https://www.linkedin.com/in/harshil-ramani-2b528920b/" >Harshil Ramani</a><br>
                <a style='text-decoration:none;color:black;' href="https://www.linkedin.com/in/shubham-khunt/" >Shubham khunt</a><br>
                <a style='text-decoration:none;color:black;' href="https://www.linkedin.com/in/architghevariya/">Archit Ghevariya</a><br>
                    
                </p><br>

                <!-- 
                <h5 class="small_titles">About Features</h5>
                <p class="about-content">This is a fully functional RFID based attendance management system. Enables the
                    faculties to record students' attendance in a fuss-free manner. It is basically a fusion of
                    software, hardware and web-based application. The system is directly connected to the database
                    without any intermediary.<br><br>

                    Extremely fast, secure and reliable system for the department to maintain the daily attendance of
                    students without any hassle. A major benefit of the system is its automation and quick
                    response charateristic.

                </p><br> -->

                <h5 class="small_titles">Contact Us</h5>
                <p class="about-content">Phone : +91 9624561892,
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <br />Email: &nbsp;&nbsp;&nbsp;harshilramani9777@gmail.com
                </p><br>

                <!-- <h5 class="small_titles"><i>Address</i></h5>
                <p class="about-content"><i>ABC XYZ,
                        <br />ABC XYZ
                        <br />ABCD XYTZ
                        <br />ABCDEF GHUIJSK
                        <br />ABJKDBDKBDLDD 
                        <br />DANKJBFAKFBFK</i></p> -->
            </div>
        </div>
    </div>

</body>
<!-- including footer -->
<?php
    include './common/footer.php'
    ?>
</body>

</html>