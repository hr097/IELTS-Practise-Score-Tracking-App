/* START::MODAL */

var modal = document.getElementById("modal");

var span = document.getElementsByClassName("close")[0]; //close modal

span.onclick = function() {  //close modal
  modal.style.display = "none";
}
window.onclick = function(event) {//close modal anywhere click
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

document.getElementById("yes-button").onclick = function() { // yes-> redirect
    window.location.href = "login.php";
}


/* END::MODAL */


/* START::TOGGLE PASSWORD */

const togglePassword = document.querySelector("#togglePassword");
const password_t = document.querySelector("#password");
togglePassword.addEventListener("click", function () {
    const type = password_t.getAttribute("type") === "password" ? "text" : "password";
    password_t.setAttribute("type", type);
    this.classList.toggle("bi-eye");
});

/* END:::TOGGLE PASSWORD */


/* START::REGISTRATION_VALIDATION */

function showError(message)
{     
    $("#error-message").css("display","block"); 
    $("#message").text(message); 
    setTimeout(function(){$("#message").text("");$("#error-message").css("display", "none");},2000); 
}


$(document).ready(function(){
    
//    $("#username").val(decryptCred(getCookie("5f7573726e6d")));
//    $("#password").val(decryptCred(getCookie("5f70737764")));

   //$('#remember-me').prop('checked',true); // by default remember me checked

    $("#register").click(function(){

      const users = [1,2,3];
      let username = $("#username"); 
      let password1 = $("#password1");
      let password2 = $("#password2");
      let csrfToken = $("#csrfToken");
      
    //   let rememberMe = ($('#remember-me').prop('checked') == true)?1:0;

      if(username.val()=="") 
      {
        showError("Please enter your username"); 
      }
      else if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(username.val().trim()))) 
      {
        showError("Invalid username format");
        username.val(""); 
      }
      else if(password1.val()=="")
      {
        showError("Please select your password");
        password1.val("");
      }
      else if(password2.val()=="")
      {
        showError("Please enter your confirmation password");
        password2.val("");
      }
      else if(password1.val()!=password2.val())
      {
        showError("Both passwords aren't identical!");
        password1.val("");
        password2.val("");
      }
      else if(!(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,16}$/.test(password2.val()))) 
      {
        showError("Invalid password format");
        password2.val("");
      }
      else
      {
        $.post("./api/registeruser.php",
        {
          _un: username.val().toLowerCase().trim(),
          _ps: password2.val(),
          _ct: csrfToken.val(),
        },
        function(data,status)
        {  
            if(status == "success")
            {
                response = parseInt(data);
                if(response === 0)
                {
                    showError("User already exists Please try another email.");
                    username.val("");
                    password1.val(""); 
                    password2.val("");
                }
                else if(response=== -1)
                {   
                    $(".msg").text("");
                    $(".msg").text("something went wrong! Please try again later.")
                    $("#modal").css("display","flex");
                }
                else if(response=== 1)
                {
                    $(".msg").text("");
                    $(".msg").text("You are successfully registered.")
                    $("#modal").css("display","flex");
                }
                else
                {
                  showError("Error occurred ! Try after some time");
                  setTimeout( function(){window.location.reload();},2500);
                }
            }
            else
            {
              showError("Something went wrong!");
              setTimeout( function(){window.location.reload();},2500);
            }
        });
       }
    });
  });


/* END::REGISTRATION_VALIDATION */




