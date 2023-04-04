<?php


require_once("../logic.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="1"))
{
 $JAMES->ams_redirect("../login.php");
}

$error = "";
$classroom_codes = "";

//ADD student
if(isset($_POST['addscore']))
{

  
    //PERSONAL
    $stud_spid = $JAMES->sanitizeInput($_POST['stud_selection']);
    $r = $JAMES->sanitizeInput($_POST['scoreBoxReading']);
    $l = $JAMES->sanitizeInput($_POST['scoreBoxListening']);
    $s = $_POST['scoreBoxSpeaking'];
    $w = $_POST['scoreBoxwriting'];
    $d = date("d/m/Y");
    
    $sql= "
        insert into Test_Exam_Score 
        (stud_id,reading_band,listening_band,speaking_band,writing_band,date)
        values(
        '$stud_spid',
        '$r',
        '$l',
        '$s',
        '$w',
         $d);";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);

    if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
    {    

        $error="<span id='response_msg' style='color:green;float:right;'>Score Added Successfully!</span>";
        $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";

    }
    else
    {
        $error="<span id='response_msg' style='color:red;float:right;'>Failed to Add Score!</span>";
        $error.="<script>setTimeout(function(){ $('#response_msg').html(''); },3000);</script>";
    }


}


//fetch related classroom id's
$sql= "select Students.stud_id,CONCAT(Students.stud_id,' - ',Students.email) As stud_name from Students;";//query
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)>0)
{
    $classroom_codes = "<label>Student Selection:</label><select name='stud_selection' id='classcode_selection' class='form-control' required><option value=''>Not Selected</option></option>";

    while($record = mysqli_fetch_assoc($result))
    {
      $classroom_codes.="<option value='".$record['stud_id']."' >".$record['stud_name']."</option>";
    }

    $classroom_codes.="</select>";
}
else
{
  $classroom_codes = "<label>Classroom Code</label><select name='classcode_selection' id='classcode_selection' class='form-control'><option value='0'>Not Selected</option></option></select>";
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
             

        <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >
        <h4 class="card-title"><?php echo $error;?></h4>
        <form autocomplete="off" class="forms-sample" name="addstudents" action='addscore.php' method="POST" enctype="multipart/form-data">

                              
        <?php echo $classroom_codes;?>
        <br>

        <div class="row">
            <div class="form-group mb-5 col-sm-6 col-md-6 col-lg-6">
            <label>Reading Band Score:</label>
            <select name='scoreBoxReading' class='form-control'>
                <option value='0' selected>0</option>
                <option value='0.5' >0.5</option>
                <option value='1' >1</option>
                <option value='1.5' >1.5</option>
                <option value='2' >2</option>
                <option value='2.5' >2.5</option>
                <option value='3' >3</option>
                <option value='3.5' >3.5</option>
                <option value='4' >4</option>
                <option value='4.5' >4.5</option>
                <option value='5' >5</option>
                <option value='5.5' >5.5</option>
                <option value='6' >6</option>
                <option value='6.5' >6.5</option>
                <option value='7' >7</option>
                <option value='7.5' >7.5</option>
                <option value='8' >8</option>
                <option value='8.5' >8.5</option>
                <option value='9.0' >9.0</option>
            </select>
            </div>

            <div class="form-group mb-5 col-sm-6 col-md-6 col-lg-6">
            <label>Listening Band Score:</label>
            <select name='scoreBoxListening' class='form-control'>
                <option value='0' selected>0</option>
                <option value='0.5' >0.5</option>
                <option value='1' >1</option>
                <option value='1.5' >1.5</option>
                <option value='2' >2</option>
                <option value='2.5' >2.5</option>
                <option value='3' >3</option>
                <option value='3.5' >3.5</option>
                <option value='4' >4</option>
                <option value='4.5' >4.5</option>
                <option value='5' >5</option>
                <option value='5.5' >5.5</option>
                <option value='6' >6</option>
                <option value='6.5' >6.5</option>
                <option value='7' >7</option>
                <option value='7.5' >7.5</option>
                <option value='8' >8</option>
                <option value='8.5' >8.5</option>
                <option value='9.0' >9.0</option>
            </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group mb-5 col-sm-6 col-md-6 col-lg-6">
            <label>Speaking Band Score:</label>
            <select name='scoreBoxSpeaking' class='form-control'>
                <option value='0' selected>0</option>
                <option value='0.5' >0.5</option>
                <option value='1' >1</option>
                <option value='1.5' >1.5</option>
                <option value='2' >2</option>
                <option value='2.5' >2.5</option>
                <option value='3' >3</option>
                <option value='3.5' >3.5</option>
                <option value='4' >4</option>
                <option value='4.5' >4.5</option>
                <option value='5' >5</option>
                <option value='5.5' >5.5</option>
                <option value='6' >6</option>
                <option value='6.5' >6.5</option>
                <option value='7' >7</option>
                <option value='7.5' >7.5</option>
                <option value='8' >8</option>
                <option value='8.5' >8.5</option>
                <option value='9.0' >9.0</option>
            </select>
            </div>

            <div class="form-group mb-5 col-sm-6 col-md-6 col-lg-6">
            <label>Writing Band Score:</label>
            <select name='scoreBoxWriting' class='form-control'>
                <option value='0' selected>0</option>
                <option value='0.5' >0.5</option>
                <option value='1' >1</option>
                <option value='1.5' >1.5</option>
                <option value='2' >2</option>
                <option value='2.5' >2.5</option>
                <option value='3' >3</option>
                <option value='3.5' >3.5</option>
                <option value='4' >4</option>
                <option value='4.5' >4.5</option>
                <option value='5' >5</option>
                <option value='5.5' >5.5</option>
                <option value='6' >6</option>
                <option value='6.5' >6.5</option>
                <option value='7' >7</option>
                <option value='7.5' >7.5</option>
                <option value='8' >8</option>
                <option value='8.5' >8.5</option>
                <option value='9.0' >9.0</option>
            </select>

            </div>


            <button type="submit" id="searchstudentbtn" name="addscore" class="btn btn-primary searchbtn mt-4">Add Score</button>                    
            <button type="reset" class="btn btn-light mt-3">Clear</button>

        </div>
        

       </form>

        </div>
    </div>


    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>
</body>

</html>