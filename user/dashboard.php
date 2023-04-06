<?php


require_once("../logic.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if(!($JAMES->checkSession()&&$_SESSION["_userType"]==="1"))
{
 $JAMES->ams_redirect("../login.php");
}

$student_card = "";
$sql = "select * from Students;"; 
$result = mysqli_query($JAMES->connection(),$sql);

if(mysqli_num_rows($result)>=1)
{   
    $student = "";
    while($record = mysqli_fetch_assoc($result))
    {


    if($record['stud_status']==1)
    {
        $status = "Active";
    }
    else
    {
        $status = "Inactive";
    }
    $student.=
    "
    <tr class='student'>
    <td>".$record['stud_id']."</td>
    <td>".$record['name']."</td>
    <td>".$record['gender']."</td>
    <td>".$record['dob']."</td>
    <td class='e_copy'>".$record['email']."</td>
    <td>".$record['contact_no']."</td>
    <td>".$record['coach_name']."</td>
    <td>".$status."</td>
    </td>
    </tr>
    ";

    }

    $student_card.=$student;
}
else
{

$student_card = "<tr>
<td  colspan='6' style='font-size:1.2em;text-align:center;'>No Data to Display</td>
</tr>";

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
    <title>IELTS BUDDY | Faculty Dashboard</title>
     
     <style>
        .tooltip {
        position: relative;
        display: inline-block;
        }

        .tooltip .tooltiptext {
        visibility: hidden;
        width: 140px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 150%;
        left: 50%;
        margin-left: -75px;
        opacity: 0;
        transition: opacity 0.3s;
        }

        .tooltip .tooltiptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
        }

        .tooltip:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
        }
</style>
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
         <!-- Student Spid & Search Button-->
         <div class="row">
            <div class="col-lg-10 col-md-9 col-sm-12">

                <div class="form-group">
                <label>Student Email</label>
                <input type="text" maxlength="256" minlength="3" name="_spid" class="form-control" id="Stud_spid" placeholder="Enter student email" required>
                <input type="hidden" id="csrfToken" name="_csrfToken" value="<?php echo $JAMES->generateCsrfToken();?>" >  
            </div>

        </div>
            <div class="form-group search_fetch_btn col-lg-2 mt-3 col-sm-12">
                <button type="submit" id="search" class="btn btn-dark mr-2 mt-3">Search
                </button>
            </div>
    <center><span class='tooltiptext' style="margin:auto;" id='myTooltip'></span></center>
        <div class="table-responsive mt-4">

            <table id="" class="table">
                <thead>
                    <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Birthdate</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Coach</th>
                    <th>Status</th>
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
    </div>

    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>
</body>

</html>