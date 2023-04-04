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
    <td>".$record['email']."</td>
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