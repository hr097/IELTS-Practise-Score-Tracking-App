<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin:ieltsbuddy.ml');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods,Authorization');

require_once("../logic.php");
$JAMES = new AMS("Admin");
$JAMES->init_user_session();
    
  
    function sendRegistrationEmail($u_email,$password) 
    {

      $GLOBALS['JAMES']->todayTime =  date("h:i:s A",  time()); // fetch latest time 
    
      $username = $u_email;

      //@email template    

      $htmlContent = "
        

      <!DOCTYPE html>
      <html>
      <head>
          <title></title>
          <meta http-equiv='Content-Type' content='text/html, charset=utf-8' />
          <meta name='viewport' content='width=device-width, initial-scale=1'>
          <meta http-equiv='X-UA-Compatible' content='IE=edge' />
          <style type='text/css'>
             
              body,
              table,
              td,
              a {
                  -webkit-text-size-adjust: 100%;
                  -ms-text-size-adjust: 100%;
              }
      
              table,
              /* td {
                  mso-table-lspace: 0pt;
                  mso-table-rspace: 0pt;
              } */
      
              img {
                  -ms-interpolation-mode: bicubic;
              }
      
              
              img {
                  border: 0;
                  height: auto;
                  line-height: 100%;
                  outline: none;
                  text-decoration: none;
              }
      
              table {
                  border-collapse: collapse !important;
              }
      
              body {
                  height: 100% !important;
                  margin: 0 !important;
                  padding: 0 !important;
                  width: 100% !important;
              }
      
            
              a[x-apple-data-detectors] {
                  color: inherit !important;
                  text-decoration: none !important;
                  font-size: inherit !important;
                  font-family: inherit !important;
                  font-weight: inherit !important;
                  line-height: inherit !important;
              }
              .AttendanceTable{
                margin-top:20px;
              }
              
              .AttendanceTable,.AttendanceTable tr td{
                border: 2px solid black;
                padding: 5px 25px 5px 15px;
                font-family: poppins;
                font-size: 14px;
  
              }
              @media screen and (max-width:600px) {
                  h1 {
                      font-size: 32px !important;
                      line-height: 32px !important;
                  }
              }
      
             
              div[style*='margin: 16px 0;'] {
                  margin: 0 !important;
              }
          </style>
      </head>
      
      <body style='background-color: #ffffff;margin: 0 !important; padding: 0 !important;'>
          
      
          <table border='0' cellpadding='0' cellspacing='0' width='100%'>
             
              <tr>
                  <td align='center' style ='background: #5755a5'>
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                          <tr>
                              <td align='center' valign='top' style='padding: 40px 10px 40px 10px;'> </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              <tr>
                  <td  align='center' style='padding: 0px 10px 0px 10px;background : #5755a5'>
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                          <tr>
                              <td bgcolor='#ffffff' align='center' valign='top' style='padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #4b49ac; font-family: poppins; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;'>
                                  <h1 style='font-size: 35px; font-weight: 500; margin: 2;'><b>Registration Successful</b></h1> <img src='https://live.staticflickr.com/65535/52097859173_5b6d3573df_n.jpg' width='250' height='120' style='display: block; border: 0px;' />
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
              
              <tr>
                  <td  align='center' style='padding: 0px 10px 0px 10px; background-color: #f4f4f4;'>
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                          <tr>
                              <td bgcolor='#ffffff' align='center' style='padding: 20px 30px 20px 30px; color: #000000; font-family: poppins; font-size: 14px; font-weight: 400; line-height: 30px;'>
                                  <p style='margin: 0; '><span style='font-size: 20px;'>Welcome ,<br><b> Coach</b></span><br><br>This is to notify that you're successfully registered as a <b>Coach</b> on digital IELTS Practise Score Tracking App Plateform</b>.<br>                               
                                  </p>
                                  <p style='margin-top:25px;font-size:18px;'><b>Your credentials are given below: </b></p>
                                  <p style='margin-top:40px;'> <b>Username:    </b>  <em>".$u_email."</em> </p>
                                  <p> <b>Password:    </b>   <em> ".$password." </em> </p>
                                  <p> <b>Dashboard:   </b>   <a href='https://ieltsbuddy.ml/login.php'> login here  </a></p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
  
              <tr>
            
              </tr>
              
              <tr>
                <td  align='center' style='padding: 0px 10px 0px 10px; background-color: #f4f4f4;'>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                        <tr>
                            <td bgcolor='#ffffff' align='center' style='padding: 0px 30px 40px 30px; color: #000000; font-family: poppins; font-size: 14px; font-weight: 400; line-height: 30px;'>
                                <p style='margin: 0;margin-top:20px; '><b style='text-decoration:underline;'>NOTE: You are requested to login into dashboard and change your password as soon as you receive an invitation email. </b>
                                </p><br/>
  
                                <p style='margin:0;text-align: center;'><br><b><a style='color:black;' href='mailto:harshilramani9777@gmail.com' >IELTS BUDDY Admin</a></b><br></p>
                            </td>
                        </tr>
                    </table>
                </td>
             </tr>
  
            <tr>
                  <td bgcolor='#f4f4f4' align='center' style='padding: 30px 10px 40px 10px;'>
                      <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
                          <tr>
                              <td align='center' style='color: white!important;background-color:#5755a5;padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: poppins; font-size: 18px; font-weight: 400; line-height: 30px;'>
                                  <h2 style='font-size:18px; font-weight: 400; color: white!important; margin: 0;'>Have any questions for us or need more information ? </h2>
                                  <p style='margin: 0;'><a href='mailto:harshilramani9777@gmail.com' target='_blank' style='color: black;'><b>Just shoot us an email!<br> We are always here to help.</b></a><a style='color:#000000;font-size:16px;' ><br>IELTS BUDDY</a></p>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
          </table>
      </body>
      
      </html>
                      
       
                      
      ";
            
    return(($GLOBALS['JAMES']->sendEmail($username,"Registration Successful",$htmlContent))?1:-1);

    }
    
    function checkUserExists($u) 
    {        
        //@query
        $sql = "select username,user_type from Users where username='$u';";
    
        $result = mysqli_query($GLOBALS['JAMES']->connection(),$sql);
    
        if(mysqli_num_rows($result)===1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function register_user($u,$p)
    {   
        
        if(!checkUserExists($u))
        {
            //@query

            $p_enc =  crypt($p,'$2a$10$1qAz2wSx3eDc4rFv5tGb5t');
            $sql = "insert into Users(username,password,user_type) values('$u','$p_enc',1);";
    
            if(mysqli_query($GLOBALS['JAMES']->connection(),$sql))
            {   
                if(sendRegistrationEmail($u,$p)===1)
                {
                    $GLOBALS['JAMES']->delete_user_session();
                    return 1;
                }
                else
                {    
                    return-1;
                }
                  
            }
            else
            {
                return -1;
            }
        }
        else
        {
            return 0;
        }
    }

    function checkApiReqBody()
    {
        if(isset($_POST['_un']))
        {
            if(isset($_POST['_ps']))
            {
                if(isset($_POST['_ct'])&&$_POST['_ct']==$_SESSION['_csrfToken'])
                {
                    return true;
                }
            }
        }
    
        return false;
    }

    if(checkApiReqBody()===true)
    {
            $u = $JAMES->sanitizeInput($_POST['_un']);
            $p = $JAMES->sanitizeInput($_POST['_ps']);
           
            $response = register_user($u,$p);
            echo $response;
    }
    else
    {
        $JAMES->ams_redirect("../login.php"); // when outside request comes redirect to login
    }


?>