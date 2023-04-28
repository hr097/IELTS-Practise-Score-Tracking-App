<?php


require_once("../logic.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="1"))
{
 $JAMES->ams_redirect("../login.php");
}

$error = "";
$student = array("stud_id"=>"","name"=>"","gender"=>"","dob"=>"","email"=>"","contact_no"=>"","stud_status"=>"");
$div_array = array("A","B","C","D","E","F","G","H","I");
$arr_length = count($div_array);
$button = "";
$update_email = "";


//update student
if(isset($_POST['updatestudent']))
{

    //PERSONAL
    $stud_spid = $_POST['studspid'];
    $stud_email = $_POST['studemail'];
    $stud_name = $JAMES->sanitizeInput($_POST['studname']);
    $stud_gender = $_POST['studgender'];
    $stud_dob = $_POST['studdob'];
    $stud_contact = $JAMES->sanitizeInput($_POST['studcontact']);
    $stud_status = $_POST['studstatus'];


    $sql= "
    update Students set
    name='$stud_name',
    email='$stud_email',
    gender='$stud_gender',
    dob='$stud_dob',
    contact_no='$stud_contact',
    stud_status=$stud_status 
    where stud_id=$stud_spid;";

    
    if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
    {    
        $error="<span id='response_msg' style='color:green;float:right;'>Student Details Updated!</span>";
        $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";

    }
    else
    {
        $error="<span id='response_msg' style='color:red;float:right;'>Failed to Update!</span>";
        $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
    }
}

//ADD student
if(isset($_POST['addstudent']))
{

  
    //PERSONAL
    $stud_spid = $JAMES->sanitizeInput($_POST['studspid']);
    $stud_email = $JAMES->sanitizeInput($_POST['studemail']);
    $stud_name = $JAMES->sanitizeInput($_POST['studname']);
    $stud_gender = $_POST['studgender'];
    $stud_dob = $_POST['studdob'];
    $stud_contact = $JAMES->sanitizeInput($_POST['studcontact']);
    $stud_status = $_POST['studstatus'];
    $stud_coach_name = $_SESSION["_userId"];

    $sql = "select * from  Students where email='$stud_email';";
    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);

    if(mysqli_num_rows($result)==1)
    {    
        $error="<span id='response_msg' style='color:red;float:right;'>Email Already Registered!</span>";
        $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
    }
    else
    {    

        $sql= "
        insert into Students 
        (stud_id,name,gender,dob,email,contact_no,coach_name,stud_status)
        values(
        '$stud_spid',
        '$stud_name',
        '$stud_gender',
        '$stud_dob',
        '$stud_email',
        '$stud_contact',
        '$stud_coach_name',
         $stud_status);";


        if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
        {    

            $error="<span id='response_msg' style='color:green;float:right;'>Student Added Successfully!</span>";
            $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";

        }
        else
        {
            $error="<span id='response_msg' style='color:red;float:right;'>Failed to Add Students!</span>";
            $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
        }

       
    }

}

//findstudent details
if(isset($_GET["spid"]))
{   

    $update_email = "readonly='true' ";
    $spid = $JAMES->sanitizeInput($_GET["spid"]);

    $sql= "select * from Students where stud_id='$spid';";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)==1)
    {
        $student = mysqli_fetch_assoc($result);
        $button = "<button type='submit' id='updatestudent' name='updatestudent' class='btn btn-dark mr-2 mt-3'>Update Student</button>";
    }
    else
    {
       $error="<span id='response_msg' style='color:red;float:right;'>Student ID Not Found!</span>";
       $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
    }

}
else
{
    $button = " <button type='submit' id='addstudent' name='addstudent' class='btn btn-dark mr-2 mt-3'>Add Student</button>";
}

$genderBox= "";
$statusBox = "";

if($student['stud_status']==1)
{

    $statusBox = "
    <select name='studstatus' class='form-control'required>
        <option value='true' selected>Active</option>
        <option value='false' >InActive</option>
    </select>
    ";

}
else if($student['stud_status']==0&&$student['stud_status']!="")
{

    $statusBox = "
    <select name='studstatus' class='form-control'required>
        <option value='true' >Active</option>
        <option value='false' selected>InActive</option>
    </select>
    ";

}
else
{
    $statusBox = "
    <select name='studstatus' class='form-control' required>
            <option value='true' selected>Active</option>
            <option value='false'>InActive</option>
    </select>
    ";
}

if($student['gender']=='Male')
{

    $genderBox= "
    <div class='form-group col-sm-6 col-md-6 col-lg-6'>
        <label>Gender</label>
        <select name='studgender' class='form-control' required>
            <option value=''>Not Selected</option>
            <option value='Male' selected>Male</option>
            <option value='Female'>Female</option>
        </select>
    </div>
    ";


}
else if($student['gender']=='Female')
{
    $genderBox= "
    <div class='form-group col-sm-6 col-md-6 col-lg-6'>
        <label>Gender</label>
        <select name='studgender' class='form-control' required>
            <option value=''>Not Selected</option>
            <option value='Male'>Male</option>
            <option value='Female'selected>Female</option>
        </select>
    </div>
    ";
}
else
{

    $genderBox= "
        <div class='form-group col-sm-6 col-md-6 col-lg-6'>
            <label>Gender</label>
            <select name='studgender' class='form-control' required>
                <option value=''>Not Selected</option>
                <option value='Male'>Male</option>
                <option value='Female'>Female</option>
            </select>
        </div>
        ";

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
             <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >
                            <h4 class="card-title">Student Regisration <?php echo $error;?></h4>
                            <form autocomplete="off" class="forms-sample" name="addstudents" action='registerstudent.php' method="POST" enctype="multipart/form-data">

                              

                                <!-- SPID and Email -->
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Student ID</label>
                                        <input type="text" autocomplete="off" name="studspid" pattern="[0-9]{10}" minlength="10"  maxlength="10" class="form-control" id="studspid" placeholder="XXXXXXXXXX" value="<?php echo $student['stud_id'];?>" <?php echo $update_email;?> >
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Email</label>
                                        <input type="email" autocomplete="off" name="studemail" minlength="13"  maxlength="256" class="form-control" id="studemail" placeholder="example@vnsgu.ac.in" value="<?php echo $student['email'];?>" required>
                                    </div>
                                </div>

                                <!-- Name-->
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" autocomplete="off" name="studname" minlength="10"  maxlength="256" class="form-control" id="studname" placeholder="Enter Student's Full Name" value="<?php echo $student['name'];?>" required>
                                </div>


                                <!-- Gender and DOB -->
                                <div class="row">
                                    <?php echo $genderBox;?>

                                    <div class="form-group col-md-6">
                                        <label>Birthdate</label>
                                        <input type="date" name="studdob" class="form-control" id="studdob" value="<?php echo $student['dob'];?>" required>
                                    </div>
                                </div>

                                <!-- Joining year and Contact no -->
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Contact No</label>
                                        <input type="text" autocomplete="off"  name="studcontact" minlength="14"  maxlength="14" class="form-control" id="studcontact" value="<?php echo $student['contact_no'];?>" placeholder="+91 XXXXXXXXXX" required>
                                            
                                    </div>
                                    <!-- Status-->
                                    <div class="form-group mb-5 col-sm-6 col-md-6 col-lg-6">
                                    <label>Student Status</label>
                                    <?php echo $statusBox; ?>
                                    </div>
<!-- 
                                    <div class="form-group col-md-6">
                                        <label>Joining Year</label>
                                        <input type="number" autocomplete="off" pattern="[0-9]{4}" name="studjoiningyear" minlength="4"  maxlength="4" class="form-control" id="studjoinyear" value="<?php //echo $student['joining_year'];?>" placeholder="XXXX" required>
                                    </div> -->
                                </div>
<!-- 
                                <div class="row">
                              

                                <div class="form-group mb-5 col-sm-6 col-md-6 col-lg-6">
                                    <label>RFID Tag Number</label>
                                    <input style="<?php //echo ($update_email!="")?"pointer-events: none;":"";?>" type="text" autocomplete="off" name="studrfidno" minlength="11" pattern="[A-Za-z0-9]{2}[ ]{1}[A-Za-z0-9]{2}[ ]{1}[A-Za-z0-9]{2}[ ]{1}[A-Za-z0-9]{2}"  maxlength="11" class="form-control" id="studrfid" value="<?php// echo $student['uid'];?>" <?php //echo $update_email;?> placeholder="XX XX XX XX" required>
                                </div>

                                </div> -->


                                <!-- Course Details -->
                                <!-- <h4 class="card-title mt-4">Course Details</h4>

                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Course Name</label>
                                        <?php //echo $course_html;?>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Current Roll No</label>
                                        <input type="number" autocomplete="off" name="rollno_selection" minlength="1"  maxlength="4" name="studrollno" class="form-control" id="studrollno" value="<?php echo $student['cur_roll_no'];?>" placeholder="Enter Roll No" required> 
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Current Semester </label>
                                        <?php //echo $sem_html; ?>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Current Division</label>
                                        <?php //echo $division_html; ?>
                                    </div>
                                </div> -->


                                <!-- Parent Details -->
                                <!-- <h4 class="card-title mt-4">Parents Details</h4>

                                <div class="form-group">
                                    <label>Father's Name</label>
                                    <input type="text" autocomplete="off" name="fname" minlength="10"  maxlength="256" class="form-control dash"   value="<?php //echo $student['fathers_name'];?>" placeholder="Enter Father's Name">
                                </div>


                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Father's Email</label>
                                        <input type="email"  autocomplete="off" name="femail" minlength="13"  maxlength="256" class="form-control dash" id="femail"  value="<?php// echo $student['fathers_email'];?>"  placeholder="example@gmail.com">
                                           
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Father's Contact</label>
                                        <input type="text" autocomplete="off" name="fcontact" minlength="14"  maxlength="14" class="form-control dash" id="fcontact"  value="<?php //echo $student['fathers_contact'];?>" placeholder="+91 XXXXXXXXXX">
                                            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Mother's Name</label>
                                    <input type="text" autocomplete="off" name="mname" minlength="10"  maxlength="256" class="form-control dash" id="mname" placeholder="Enter Mother's Name"  value="<?php //echo $student['mothers_name'];?>">
                                </div>


                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Mother's Email</label>
                                        <input type="email" autocomplete="off" name="memail" minlength="13"  maxlength="256" class="form-control dash" id="memail"  value="<?php //echo $student['mothers_email'];?>" placeholder="example@vnsgu.ac.in">
                                            
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label>Mother's Contact</label>
                                        <input type="text" autocomplete="off"  name="mcontact" class="form-control dash" minlength="14"  maxlength="14" id="mcontact"  value="<?php //echo $student['mothers_contact'];?>" placeholder="+91 XXXXXXXXXX">
                                            
                                    </div>

                                </div> -->

                                <?php echo $button; ?>
                                <button type="reset" class="btn btn-light mt-3">Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Student Registration Form End-->

                <div class="col-sm-12  col-md-12  col-lg-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Student</h4>
                            <form class="forms-sample">

                                <!-- FID and Role -->
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label>Search Student</label>
                                        <input type="text" name="spidsearch" pattern="" autocomplete="off" id="Stud_spid" minlength="3" maxlength="256" class="form-control" placeholder="Enter Student email">
                                    </div>

                                    <div class="form-group col-md-2 ">
                                        <button type="button" id="searchstudentbtn"
                                            class="btn btn-dark searchbtn mt-4">Search</button>
                                    </div>
                                </div>

                            </form>

                            <div class="table-responsive mt-4">
                                <table id="" class="table">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Birthdate</th>
                                            <th>Coach</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="searchstudent">
                                        <tr>
                                            <td  colspan='6' style='font-size:1.2em;text-align:center;'>No Data</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
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
            <p class="msg unselectable" id="modalmsg"></p>
            <div class="row" style="margin:auto;margin-bottom:30px;">
            <button id="yes-button" class="modal-btn">Okay</button>
            <button id="no-button" class="modal-btn">Cancel</button>
    </div>
    </div>
    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>
</body>

<script>
$("#searchstudentbtn").on('click',function () {

let csrfToken = $("#csrfToken").val();
let spid = $("#Stud_spid").val();

$.post(
"api/findglobalstudent.php",
{
  _spid: spid,
  _ct: csrfToken
},
function (data, status) {
  if(status == "success")
  {
   $("#searchstudent").html(data);

   $(".updatebtn").on('click',function () {
    window.location.href = `registerstudent.php?spid=${$(this).attr('id')}`;
   });

  $(".deletstudbtn").on('click',function () {
          
            $.post(
            "api/deleteglobalstudent.php",
            {
            _em: $(this).attr('id'),
            _ct: csrfToken
            },
            function (data, status) {

                if(data==1)
                {
                   window.location.reload(true);
                }
                else 
                {
                  $("#modalmsg").text("Student couldn't be deleted! Try again later.");
                  $("#modal").css("display","flex");
                }

            });

  });

  }

},"text"); // must write as text string will come
});


</script>
</html>