<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ieltsbuddy.ml');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../../logic.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

function findStudent($spid) 
{ 
    $sql= "select * from Students where email='$spid';";

    $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
    if(mysqli_num_rows($result)==1)
    {
        $student = "";
        while($record = mysqli_fetch_assoc($result))
        {
            $student.=
            "
            <tr class='student'>
            <td>".$record['stud_id']."</td>
            <td>".$record['name']."</td>
            <td>".$record['gender']."</td>
            <td>".$record['dob']."</td>
            <td>".$record['coach_name']."</td>
            <td>
            <button id='".$record['stud_id']."' type='button' class='btn updatebtn rounded px-3 py-2 mr-2' ><i class='ti-pencil'></i></button>            
            <button id='".$record['stud_id']."' type='button' class='btn deletstudbtn btn-danger rounded px-3 py-2'><i class='ti-trash'></i></button>
                   
            </td>
            </tr>
            ";
        }
        return $student;
    }
    else
    {
        return "
        <tr>
        <td  colspan='6' style='font-size:1.2em;text-align:center;'>Student ID Not Found!</td>
        </tr>";
    }
}




if(isset($_POST['_spid'])&&isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken']&&isset($_SESSION['_userId']))
{
        $spid = $JAMES->sanitizeInput($_POST['_spid']);
        echo(findStudent($spid));
}
else
{    
    $JAMES->ams_redirect("../../login.php"); // when outside request comes redirect to login
}



?>
