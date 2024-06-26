<?php
require_once 'backend/pawfect_connect.php';
session_start(); // Start the session
if (isset($_SESSION['error'])) {
    $errorMessage = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" href="img/Favicon 2.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>

     body{
        font-family: "Poppins";
        background-color: #EAEFF6;
        
        background-position: center center;
     }
     .red{
        color: red;
     }
     .custom{
            min-width: 15rem;
     }
     @media screen and (max-width: 1200px) {
        .custom{
            min-width: 13rem;
     }
     
     
     }
     @media screen and (max-width: 990px) {
        .custom{
            min-width: 11rem;
     }
     
     }
     .container{
        background-image: url('img/img-login-register/Registration-bg.png');
        background-size:cover;
        background-position:center;
        background-attachment: scroll;
      
     }
     @media screen and (max-width: 768px) {
        .container{
        background-image: url('img/img-login-register/Registration-bg.png');
        background-size:contain;
        background-repeat:repeat-y;
        background-position:  left center;
     }
}
  
    .pos-fix{
        position:relative;

    }
    .element {
    box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.2);
    /* Other styles for the element */
}

::-ms-reveal {
  display: none !important;
}

.password-input-container {
    position: relative;
  }

  .toggle-password , .toggle-confirm-password {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
  }
  .toggle-new-password , .toggle-new-confirm-password {
    position: absolute;
    top: 70%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
  }
  input.form-control {
            border: 1px solid #EAEFF6; /* Light gray border */
            background-color: #F9FAFD; /* Light blue background */
        }
        .featherer{
            width: 35px;
            height: 35px;
            color: red;
            cursor: pointer;
        }
        .modal-header{
            border-bottom: 1px solid black;
        }
        .error-border {
    border: 1px solid red !important;
}

    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center margin-bottom px-5 pb-5">
    
        <div class="row justify-content-center  ">
           
            <div class="card pos-fix col-md-10 col-lg-9 mt-5 element " style="border-radius: 19px;">
                <div class="row">
                <div class="col-md-4 p-3" style="background-color: #0449A6;">
                 <div class="col-md-12 mt-5 align-items-center justify-content-center d-flex mb-2">
                    <img src="img/img-login-register/Login Logo.png" width="90px" height="78px">
                </div>
                <div class="col-md-12 align-items-center justify-content-center d-flex">
                 <h4 style="color: white; white-space:nowrap;"> <b>Pawfect Track </b></h4>
                </div>
                <div class="col-md-12 align-items-center justify-content-center d-none d-sm-none d-md-block d-lg-block  pb-3">
                    <span class="text-center d-sm-none d-md-block d-lg-block" style="color: white; font-size: 12px;"> Pawfect Track is an Anti-Rabies Vaccination Record System and Inventory Management with Predictive Analytics </span>
                   </div>
                
              <div class="justify-content-center d-none align-items-center d-sm-none d-md-flex d-lg-flex d-xl-flex">
                   <div class="card mt-5 px-2 py-1" style="border-radius: 20px;" >
                   <div class="col-md-12 align-items-center justify-content-center d-flex mb-3" >
                    <img src="img/img-dashboard/ABC-Sign.png" width="150" height="90" style="min-height: 100;min-width:170; ">
                    </div>
                </div>
          
                </div>
                <div class="col-md-12 align-items-center justify-content-center d-flex mt-4">
                    <span class="text-center" style="color: white; font-size: 12px;"> Don't have an account? </span>
                </div>
                <div class="justify-content-center d-flex mb-5">
                    <a class="text-center" style="text-decoration: underline; color: #54A0FF;" href="Admin Registration.php"><b>Register</b></a>
                </div>
            </div>
            
                <div class="col-md-8 px-3 py-3 mt-5">
                    <div class="pl-4 pr-4">
                    <h4 class="text-center pb-4" style="color:#5E6E82;"><b>Account Login</b></h4>
                    <form method="post" action="backend/Login-backend.php" id="loginForm">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="last-name"><b>Username</b><span class="red">*</span></label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Username" oninput="preventSpaces(event)">
                            <div id="username-error" class="text-danger"></div>
                        </div>
                        
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label for="password"><b>Password</b><span class="red">*</span></label>
                      <div class="password-input-container">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" oninput="preventSpaces(event)">
                        <i class="toggle-password fas fa-eye"></i>
                    </div>
                    <div id="password-error" class="text-danger"></div>
                        <div class="d-flex justify-content-end pt-2">
                            <small><a id="forgot-password" href="#" style="color: #0449A6;">Forgot password?</a></small>
                        </div>
                      
                    </div>
                  </div>
                
            <div class="col-md-12">
                <div class="form-group">
                    <label for="password"><b>Confirm Password</b><span class="red">*</span></label>
                    <div class="password-input-container">
                      <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Password" oninput="preventSpaces(event)">
                      <i class="toggle-confirm-password fas fa-eye"></i>
                    </div>
                    <div id="confirmPassword-error" class="text-danger"></div>
                  </div>
                    
            </div>
            <div class="col-md-12 mt-5 mb-0">
                <div class="form-group  justify-content-center d-flex">
                   <button type="submit" class="btn btn-primary btn-lg px-5 py-2 pb-2" style="font-size: small; border-radius: 8px; background-color: #0449A6;"><b>Login</b></button>
                </form>
                </div>
                
        </div>
    </div>  
      
    </div>
    <!-- Username and Password Mismatch Modal -->
<div class="modal fade" id="usernamePasswordMismatchModal" tabindex="-1" role="dialog" aria-labelledby="usernamePasswordMismatchModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="usernamePasswordMismatchModalLabel">Login Failed</h5>
        <i data-feather="x-circle" class="text-end featherer" data-dismiss="modal">

</i>
      </div>
      <div class="modal-body">


<h2 style="letter-spacing: -1px; color:#5e6e82;"class="text-center m-0"><b>MISMATCH</b></h2>
<div class="text-center">
<small style="letter-spacing: -1px; color:#5e6e82;">The username and password you entered do not match any records.<br></small>
<small style="letter-spacing: -1px; color:#5e6e82;">Please try again or <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgotPasswordModal">reset your password</a>.</small>

</div>
<div class="align-items-center justify-content-center d-flex mb-3 mt-3">
<button type="button" style="background-color: #1DD1A1; border:none;" class="btn btn-success px-5 py-2" data-dismiss="modal"><b>OK</b></button>
</div>
</div>
</div>
</div>
</div>
 
<!-- Password Mismatch Modal -->
<div class="modal fade" id="passwordMismatchModal" tabindex="-1" role="dialog" aria-labelledby="passwordMismatchModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="passwordMismatchModalLabel"></h5>
        <i data-feather="x-circle" class="text-end featherer" data-dismiss="modal">
</i>
      </div>

      <div class="modal-body">

        <h2 style="letter-spacing: -1px; color:#5e6e82;" class="text-center m-0"><b>PASSWORD</b></h2>

        <h2 style="letter-spacing: -1px; color:#5e6e82;"class="text-center m-0"><b>MISMATCH</b></h2>
        <div class="text-center">
    <small style="letter-spacing: -1px; color:#5e6e82;">Passwords you have entered do<br></small>
    <small style="letter-spacing: -1px; color:#5e6e82;">NOT match.</small>
    
</div>
    <div class="align-items-center justify-content-center d-flex mb-3 mt-3">
    <button type="button" style="background-color: #1DD1A1; border:none;" class="btn btn-success px-5 py-2" data-dismiss="modal"><b>OK</b></button>
    </div>
    </div>
    </div>
  </div>
</div>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="forgotPasswordModalLabel" ></h5>
      <i data-feather="x-circle" class="text-end featherer" data-dismiss="modal">

</i>
        
        </button>
      </div>
      <div class="modal-body">
    <h2 style="letter-spacing: -1px; color:#5e6e82;" class="text-center m-0"><b>FORGOT</b></h2>
    <h2 style="letter-spacing: -1px; color:#5e6e82;" class="text-center m-0"><b>PASSWORD</b></h2>
    <div class="text-center">
        <small style="letter-spacing: -1px; color:#5e6e82;">To reset your own password,<br></small>
        <small style="letter-spacing: -1px; color:#5e6e82;">Enter your email address.</small>
    </div>
    <div class="col-md-12 w-100 px-5">
        <form action="backend/forgot_password.php" method="post"> <!-- Change the action to your PHP script -->
            <div class="col-md-12 form-group mt-3 justify-content-center d-flex px-5" style="flex-direction: column;">
                <label for="inputEmail" class="d-block mb-1"><b>Email<span style="color:red;">*</span></b></label>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="@gmail.com">
                <small id="email-error" class="text-danger"></small>
            </div>
            <div class="align-items-center justify-content-center d-flex mb-3">
                <button type="submit" style="background-color: #1DD1A1; border:none;" class="btn btn-success"><b>Submit</b></button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPassword2Modal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="forgotPasswordModalLabel2" ></h5>
      <i data-feather="x-circle" class="text-end featherer" data-dismiss="modal">

</i>
        
        </button>
      </div>
      <div class="modal-body">
    <h2 style="letter-spacing: -1px; color:#5e6e82;" class="text-center m-0"><b>RESET CODE</b></h2>
    <h2 style="letter-spacing: -1px; color:#5e6e82;" class="text-center m-0"><b>DELIVERED</b></h2>
    <div class="text-center">
        <small style="letter-spacing: -1px; color:#5e6e82;">To reset your own password<br></small>
        <small style="letter-spacing: -1px; color:#5e6e82;">Enter reset code</small>
    </div>
    <div class="col-md-12 w-100 px-5">
    <form action="backend/verify_reset_code.php" method="post">
            <div class="col-md-12 form-group mt-3 justify-content-center d-flex px-5" style="flex-direction: column;">
                <label for="resetCode" class="d-block mb-1"><b>Reset Code:<span style="color:red;">*</span></b></label>
                <input type="text" name="resetCode" id="resetCode" class="form-control" placeholder="Reset Code">
            </div>
            <div class="align-items-center justify-content-center d-flex mb-3">
                <button type="submit" style="background-color: #1DD1A1; border:none;" class="btn btn-success"><b>Submit</b></button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="forgotPassword3Modal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="forgotPasswordModalLabel3" ></h5>
      <i data-feather="x-circle" class="text-end featherer" data-dismiss="modal">

</i>
        
        </button>
      </div>
      <div class="modal-body">
    <h2 style="letter-spacing: -1px; color:#5e6e82;" class="text-center m-0"><b>NEW</b></h2>
    <h2 style="letter-spacing: -1px; color:#5e6e82;" class="text-center m-0"><b>PASSWORD</b></h2>
    <div class="text-center">
        <small style="letter-spacing: -1px; color:#5e6e82;">Create a new password that you<br></small>
        <small style="letter-spacing: -1px; color:#5e6e82;">don't use on any other site. </small>
    </div>
    <div class="col-md-12 w-100 px-5">
    <form action="backend/update_password.php" method="post">
            <div class="col-md-12 form-group mt-3 justify-content-center d-flex px-5" style="flex-direction: column;">
            <div class="password-input-container">
                <label for="newPassword" class="d-block mb-1"><b>New Password:<span style="color:red;">*</span></b></label>
                <input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="New Password">
                <i class="toggle-new-password fas fa-eye"></i>
                    </div>
                    <small id="new-password-error" class="text-danger"></small>
            </div>
            <div class="col-md-12 form-group mt-3 justify-content-center d-flex px-5" style="flex-direction: column;">
            <div class="password-input-container">
                <label for="confirmNewPassword" class="d-block mb-1"><b>Confirm New Password:<span style="color:red;">*</span></b></label>
                <input type="password" name="confirmNewPassword" id="confirmNewPassword" class="form-control" placeholder="New Password">
                <i class="toggle-new-confirm-password fas fa-eye"></i>
                    </div>
                    <small id="confirm-new-password-error" class="text-danger"></small>
            </div>
            <div class="align-items-center justify-content-center d-flex mb-3">
                <button type="submit" id="newPasswordSubmission" style="background-color: #1DD1A1; border:none;" class="btn btn-success"><b>Submit</b></button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="forgotPasswordSuccessModal" tabindex="-1" role="dialog" aria-labelledby="usernamePasswordMismatchModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="usernamePasswordMismatchModalLabel"></h5>
        <i data-feather="x-circle" class="text-end featherer" data-dismiss="modal">

</i>
      </div>
      <div class="modal-body">

<h2 style="letter-spacing: -1px; color:#5e6e82;"class="text-center m-0"><b>PASSWORD SUCCESSFULLY</b></h2>
<h2 style="letter-spacing: -1px; color:#5e6e82;"class="text-center m-0"><b>CHANGED</b></h2>
<div class="text-center">
<small style="letter-spacing: -1px; color:#5e6e82;">You may now log-in with<br></small>
<small style="letter-spacing: -1px; color:#5e6e82;">your new password.<br></small>
</div>
<div class="align-items-center justify-content-center d-flex mb-3 mt-3">
<button type="button" style="background-color: #1DD1A1; border:none;" class="btn btn-success px-5 py-2" data-dismiss="modal"><b>OK</b></button>
</div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="EmailNotExistModal" tabindex="-1" role="dialog" aria-labelledby="usernamePasswordMismatchModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="usernamePasswordMismatchModalLabel"></h5>
        <i data-feather="x-circle" class="text-end featherer" data-dismiss="modal">

</i>
      </div>
      <div class="modal-body">

<h2 style="letter-spacing: -1px; color:#5e6e82;"class="text-center m-0"><b>EMAIL DOES NOT</b></h2>
<h2 style="letter-spacing: -1px; color:#5e6e82;"class="text-center m-0"><b>EXIST</b></h2>
<div class="text-center">
<small style="letter-spacing: -1px; color:#5e6e82;">The email you inserted does not<br></small>
<small style="letter-spacing: -1px; color:#5e6e82;">exist in our records.<br></small>
</div>
<div class="align-items-center justify-content-center d-flex mb-3 mt-3">
<button type="button" style="background-color: #1DD1A1; border:none;" class="btn btn-success px-5 py-2" data-dismiss="modal"><b>OK</b></button>
</div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="CodeNotExistModal" tabindex="-1" role="dialog" aria-labelledby="usernamePasswordMismatchModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="usernamePasswordMismatchModalLabel"></h5>
        <i data-feather="x-circle" class="text-end featherer" data-dismiss="modal">

</i>
      </div>
      <div class="modal-body">

<h2 style="letter-spacing: -1px; color:#5e6e82;"class="text-center m-0"><b>INCORRECT RESET</b></h2>
<h2 style="letter-spacing: -1px; color:#5e6e82;"class="text-center m-0"><b>CODE</b></h2>
<div class="text-center">
<small style="letter-spacing: -1px; color:#5e6e82;">The reset code you inserted is<br></small>
<small style="letter-spacing: -1px; color:#5e6e82;">incorrect.<br></small>
</div>
<div class="align-items-center justify-content-center d-flex mb-3 mt-3">
<button type="button" style="background-color: #1DD1A1; border:none;" class="btn btn-success px-5 py-2" data-dismiss="modal"><b>OK</b></button>
</div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="PasswordNotExistModal" tabindex="-1" role="dialog" aria-labelledby="usernamePasswordMismatchModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="usernamePasswordMismatchModalLabel"></h5>
        <i data-feather="x-circle" class="text-end featherer" data-dismiss="modal">

</i>
      </div>
      <div class="modal-body">

<h2 style="letter-spacing: -1px; color:#5e6e82;"class="text-center m-0"><b>NEW PASSWORD MISMATCH</b></h2>
<div class="text-center">
<small style="letter-spacing: -1px; color:#5e6e82;">The password you inserted does<br></small>
<small style="letter-spacing: -1px; color:#5e6e82;">not match.<br></small>
</div>
<div class="align-items-center justify-content-center d-flex mb-3 mt-3">
<button type="button" style="background-color: #1DD1A1; border:none;" class="btn btn-success px-5 py-2" data-dismiss="modal"><b>OK</b></button>
</div>
</div>
</div>
</div>
</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      feather.replace();
    </script>
    <script>
          $(document).ready(function() {
    <?php if(isset($_SESSION['error_no_match'])) { ?>
      $('#PasswordNotExistModal').modal('show');
      <?php unset($_SESSION['error_no_match']); ?> // Unset the session variable
    <?php } ?>
  });
            $(document).ready(function() {
    <?php if(isset($_SESSION['error_message_code'])) { ?>
      $('#CodeNotExistModal').modal('show');
      <?php unset($_SESSION['error_message_code']); ?> // Unset the session variable
    <?php } ?>
  });
         $(document).ready(function() {
    <?php if(isset($_SESSION['error_message'])) { ?>
      $('#EmailNotExistModal').modal('show');
      <?php unset($_SESSION['error_message']); ?> // Unset the session variable
    <?php } ?>
  });
            $(document).ready(function() {
    <?php if(isset($_SESSION['success_message_password'])) { ?>
      $('#forgotPasswordSuccessModal').modal('show');
      <?php unset($_SESSION['success_message_password']); ?> // Unset the session variable
    <?php } ?>
  });
          $(document).ready(function() {
    <?php if(isset($_SESSION['code_verified']) && $_SESSION['code_verified'] === true) { ?>
      $('#forgotPassword3Modal').modal('show');
      <?php unset($_SESSION['code_verified']); ?> // Unset the session variable
    <?php } ?>
  });
          $(document).ready(function() {
    <?php if(isset($_SESSION['success_message'])) { ?>
      $('#forgotPassword2Modal').modal('show');
      <?php unset($_SESSION['success_message']); ?> // Unset the session variable
    <?php } ?>
  });
$(document).ready(function(){
    console.log("Document ready!"); // Debugging statement
    <?php if(isset($errorMessage)): ?>
        console.log("Error exists in session!"); // Debugging statement
        $('#usernamePasswordMismatchModal').modal('show');
        <?php unset($errorMessage); ?> // Clear the error message after showing the modal
    <?php endif; ?>
}); 
</script>
    <script>

document.getElementById('forgot-password').addEventListener('click', function() {
    $('#forgotPasswordModal').modal('show');
});
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const togglePassword = document.querySelector('.toggle-password');
        
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
        </script>
         <script>
            document.addEventListener('DOMContentLoaded', function() {
                const passwordInput = document.getElementById('confirmPassword');
                const togglePassword = document.querySelector('.toggle-confirm-password');
            
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            });
            </script>
                     <script>
            document.addEventListener('DOMContentLoaded', function() {
                const passwordInput = document.getElementById('confirmNewPassword');
                const togglePassword = document.querySelector('.toggle-new-confirm-password');
            
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            });
            </script>
             <script>
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const usernameError = document.getElementById('username-error');
    const passwordError = document.getElementById('password-error');
    const confirmPasswordError = document.getElementById('confirmPassword-error');

    // Password toggle functionality
    const passwordInput = document.getElementById('newPassword');
    const togglePassword = document.querySelector('.toggle-new-password');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Reset previous error messages and error borders
        usernameError.textContent = '';
        passwordError.textContent = '';
        confirmPasswordError.textContent = '';
        removeErrorBorder(username);
        removeErrorBorder(password);
        removeErrorBorder(confirmPassword);

        // Validate username
        if (username.value.trim() === '') {
            usernameError.textContent = 'Please enter your username.';
            addErrorBorder(username);
            return;
        }

        // Validate password
        if (password.value.trim() === '') {
            passwordError.textContent = 'Please enter your password.';
            addErrorBorder(password);
            return;
        }

        // Validate confirm password
        if (confirmPassword.value.trim() === '') {
            confirmPasswordError.textContent = 'Please confirm your password.';
            addErrorBorder(confirmPassword);
            return;
        }

        // Validate if password and confirm password match
        if (password.value.trim() !== confirmPassword.value.trim()) {
            $('#passwordMismatchModal').modal('show'); // Show the password mismatch modal
            addErrorBorder(password);
            addErrorBorder(confirmPassword);
            return;
        }

        // If validation passes, submit the form
        this.submit();
    });

    // Add input event listeners for real-time validation
    username.addEventListener('input', function() {
        usernameError.textContent = ''; // Clear previous error message
        removeErrorBorder(username);
        if (username.value.trim() === '') {
            usernameError.textContent = 'Please enter your username.';
            addErrorBorder(username);
        }
    });

    password.addEventListener('input', function() {
        passwordError.textContent = ''; // Clear previous error message
        removeErrorBorder(password);
        if (password.value.trim() === '') {
            passwordError.textContent = 'Please enter your password.';
            addErrorBorder(password);
        }
    });

    confirmPassword.addEventListener('input', function() {
        confirmPasswordError.textContent = ''; // Clear previous error message
        removeErrorBorder(confirmPassword);
        if (confirmPassword.value.trim() === '') {
            confirmPasswordError.textContent = 'Please confirm your password.';
            addErrorBorder(confirmPassword);
        }
    });

    function addErrorBorder(element) {
        element.classList.add('error-border');
    }

    function removeErrorBorder(element) {
        element.classList.remove('error-border');
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('inputEmail');
    const emailError = document.getElementById('email-error');

    const emailRegex = /^[a-zA-Z0-9._+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    emailInput.addEventListener('input', function() {
        // Clear previous error message
        emailError.textContent = '';

        const email = emailInput.value.trim().toLowerCase();
        const allowedDomains = ['@gmail.com', '@outlook.com', '@yahoo.com'];

        // Check if the email matches the valid email format
        if (!emailRegex.test(email)) {
            emailError.textContent = 'Please enter a valid email address.';
            return;
        }

        // Check if the email ends with one of the allowed domains
        const isValidDomain = allowedDomains.some(domain => email.endsWith(domain));
        if (!isValidDomain) {
            emailError.textContent = 'Please enter a valid email from Gmail, Outlook, or Yahoo.';
            return;
        }
    });

    emailInput.addEventListener('keydown', function(event) {
        // Prevent space character from being entered
        if (event.key === ' ') {
            event.preventDefault();
        }
    });
});



</script>
<script>
function preventLeadingSpace(event) {
    const input = event.target;
    if (input.value.startsWith(' ')) {
        input.value = input.value.trim(); // Remove leading space
    }
    // Replace multiple consecutive spaces with a single space
    input.value = input.value.replace(/\s{2,}/g, ' ');
}

function preventSpaces(event) {
        const input = event.target;
        if (input.value.includes(' ')) {
            input.value = input.value.replace(/\s/g, ''); // Remove all spaces
        }
    }




</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const newPasswordInput = document.getElementById('newPassword');
        const confirmNewPasswordInput = document.getElementById('confirmNewPassword');
        const newPasswordError = document.getElementById('new-password-error');
        const confirmNewPasswordError = document.getElementById('confirm-new-password-error');
        const submitPasswordButton = document.getElementById('newPasswordSubmission');
        const updatePasswordForm = document.getElementById('updatePasswordForm');

        const passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,16}$/;

        function validatePassword(password) {
            return passwordRegex.test(password);
        }

        function showPasswordError(errorElement, message) {
            errorElement.textContent = message;
            submitPasswordButton.disabled = true; // Disable submit button
        }

        function clearPasswordError(errorElement) {
            errorElement.textContent = '';
            submitPasswordButton.disabled = false; // Enable submit button
        }

        function checkPasswordsMatch() {
            const newPassword = newPasswordInput.value;
            const confirmNewPassword = confirmNewPasswordInput.value;

            if (newPassword !== confirmNewPassword) {
                showPasswordError(confirmNewPasswordError, 'Passwords do not match.');
            } else {
                clearPasswordError(confirmNewPasswordError);
            }
        }

        newPasswordInput.addEventListener('input', function() {
            const newPassword = newPasswordInput.value;

            if (!validatePassword(newPassword)) {
                showPasswordError(newPasswordError, 'Password must be 8-16 characters and include letters, numbers, and symbols.');
            } else {
                clearPasswordError(newPasswordError);
            }

            // Check if passwords match whenever a new password is entered
            checkPasswordsMatch();
        });

        confirmNewPasswordInput.addEventListener('input', function() {
            // Check if passwords match whenever the confirm password is entered
            checkPasswordsMatch();
        });

        // Prevent space character from being entered in password fields
        newPasswordInput.addEventListener('keydown', function(event) {
            if (event.key === ' ') {
                event.preventDefault();
            }
        });

        confirmNewPasswordInput.addEventListener('keydown', function(event) {
            if (event.key === ' ') {
                event.preventDefault();
            }
        });

        // Prevent form submission if there are errors
        updatePasswordForm.addEventListener('submit', function(event) {
            const newPassword = newPasswordInput.value;
            const confirmNewPassword = confirmNewPasswordInput.value;

            if (!validatePassword(newPassword)) {
                showPasswordError(newPasswordError, 'Password must be 8-16 characters and include letters, numbers, and symbols.');
                event.preventDefault(); // Prevent default form submission
                return;
            }

            if (newPassword !== confirmNewPassword) {
                showPasswordError(confirmNewPasswordError, 'Passwords do not match.');
                event.preventDefault(); // Prevent default form submission
                return;
            }
        });
    });
</script>

</body>
</html>
