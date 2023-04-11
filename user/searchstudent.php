<?php


require_once("../logic.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="1"))
{
 $JAMES->ams_redirect("../login.php");
}


$student_card = "";
$student_card1 = "";

if(isset($_POST['stud_selection'])&&isset($_POST['_csrfToken'])&&$_POST['_csrfToken']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
    $spid = $JAMES->sanitizeInput($_POST['stud_selection']);

    $testType = $_POST['examType'];
    if($testType=="speaking")
    {
        $sql = "select Speaking_Test_Exam_Score.* from Students,Speaking_Test_Exam_Score where Speaking_Test_Exam_Score.stud_id=Students.stud_id and Students.email='$spid';"; 
        $result = mysqli_query($JAMES->connection(),$sql);
    
        if(mysqli_num_rows($result)>=1)
        {   
            $student = "";
            
            while($record = mysqli_fetch_assoc($result))
            {
    
            $student.=
            "
            <tr class='student'>
            <td>".$record['date']."</td>
            <td>".$record['intro']."</td>
            <td>".$record['cue_card']."</td>
            <td>".$record['follow']."</td>
            <td>".$record['overall']."</td>
            <td>".$record['errors']."</td>
            <td>".$record['suggestion']."</td>
            </tr>
            ";
    
            }
    
            $student_card1.=$student;
        }
        else
        {
            $student_card1 = "<tr>
            <td  colspan='7' style='font-size:1.2em;text-align:center;'>Student Score Data Not Found!</td>
            </tr>";
        }
    }
    else
    {
        $sql = "select Test_Exam_Score.* from Students,Test_Exam_Score where Test_Exam_Score.stud_id=Students.stud_id and Students.email='$spid';"; 
        $result = mysqli_query($JAMES->connection(),$sql);
    
        if(mysqli_num_rows($result)>=1)
        {   
            $student = "";
            
            while($record = mysqli_fetch_assoc($result))
            {
    
            $overall =  floatval($record['reading_band'])+ floatval($record['listening_band'])+floatval($record['writing_band'])+floatval($record['speaking_band']);
            $overall /=4;
            $overall = round($overall);
    
            $student.=
            "
            <tr class='student'>
            <td>".$record['date']."</td>
            <td>".$record['reading_band']."</td>
            <td>".$record['listening_band']."</td>
            <td>".$record['speaking_band']."</td>
            <td>".$record['writing_band']."</td>
            <td>".$overall."</td>
            </td>
            </tr>
            ";
    
            }
    
            $student_card.=$student;
        }
        else
        {
            $student_card = "<tr>
            <td  colspan='6' style='font-size:1.2em;text-align:center;'>Student Score Data Not Found!</td>
            </tr>";
        }
    }
    //@query


}
else
{
    
     $student_card = "<tr>
    <td  colspan='6' style='font-size:1.2em;text-align:center;'>No Data to Display</td>
    </tr>";

    $student_card1 ="<tr>
    <td  colspan='7' style='font-size:1.2em;text-align:center;'>No Data to Display</td>
    </tr>";
}

//fetch related classroom id's
$sql= "select email from Students;";//query
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)>0)
{
    $classroom_codes = "<label>Student Selection:</label><select name='stud_selection' id='classcode_selection' class='form-control' required><option value=''>Not Selected</option></option>";

    while($record = mysqli_fetch_assoc($result))
    {
      $classroom_codes.="<option value='".$record['email']."' >".$record['email']."</option>";
    }

    $classroom_codes.="</select>";
}
else
{
  $classroom_codes = "<label>Classroom Code</label><select name='stud_selection' id='classcode_selection' class='form-control'><option value='0'>Not Selected</option></option></select>";
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
             
        <div class="row">

        <button type='button' onclick="window.history.back()" style="verticle-align:middle;padding:9px;width:90px;height:40px;float:left;position:relative;bottom:10px;display:inline;border-radius:12px;" class='btn form-control btn-dark btn-icon-text ml-3 mb-3'>
                                                        
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
        </svg>
        Back
        </button>
            <!-- Search Student -->
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Track Student</h4>
                        <form class="forms-sample" action="searchstudent.php" method="post" autocomplete="off">

                            <!-- Student Spid & Search Button-->
                            <!-- <div class="row">
                                <div class="col-lg-10 col-md-9 col-sm-12">

                                    <div class="form-group">
                                    <label>Student Email</label>
                                    <input type="text" maxlength="256" minlength="3" name="_spid" class="form-control" id="Stud_spid" placeholder="Enter student email" required>
                                    
                                </div>

                            </div>
                            -->
                                <?php echo $classroom_codes;?>
                                <br>
                                <label>Exam Type:</label>
                                <select name='examType' class='form-control' required>
                                    <option value='mock' selected>Mock Test</option>
                                    <option value='speaking' >Speaking</option>
                                </select>
                                <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >  
                                <div class="form-group search_fetch_btn col-lg-2 mt-3 col-sm-12">
                                    <button type="submit" id="search" class="btn btn-dark mr-2 mt-3">Search
                                    </button>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive mt-4">
            <h4>Speaking Test:</h4>
            <table id="" class="table">
                <thead>
                    <tr>
                        <th>DateTime</th>
                        <th>Intro</th>
                        <th>Cue Card</th>
                        <th>Follow Up</th>
                        <th>OverAll</th>
                        <th>Errors</th>
                        <th>Suggestions</th>
                    </tr>
                </thead>
                <tbody id="searchstudent">
                    <tr>
                        <?php echo $student_card1; ?>
                    </tr>
                </tbody>
            </table>
            <div class="table-responsive mt-4">
            <h4>Mock Test:</h4>
            <table id="" class="table">
                <thead>
                    <tr>
                        <th>DateTime</th>
                        <th>Reading</th>
                        <th>Listening</th>
                        <th>Writing</th>
                        <th>Speaking</th>
                        <th>OverAll</th>
                    </tr>
                </thead>
                <tbody id="searchstudent">
                    <tr>
                        <?php echo $student_card; ?>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>
</body>

</html>