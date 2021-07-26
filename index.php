<?php
session_start();
require('controller/session_message.php');
?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UC Hub</title>
    <link rel="stylesheet" type="text/css" href="view/css/style.css">
    <script src="view/js/jquery-3.1.1.min.js"></script>
  </head>

  <body>
      <div id="loginContainer">
          <div id="logo"></div>
            <div id="loginFormContainer">
              <div id="loginForm">
                  <form id="login" name="login" action="./controller/login_process.php" method="post">
                      <label>Log In</label>
                      <input id="loginEmail" name="email" type="email" placeholder="Email">
                      <input id="loginPass" name="password" type="password" placeholder="Password">
                      <button class="loginButton" type="submit" name="loginSubmit">Sign In</button>
                  </form>
                  <br>
                  <span id="forgotPass"> Forgot your password? </span>
                  <span id="registerRedirect"> Register for an Account </span>
              </div>
          </div>
          <div id="registerFormContainer">
              <div id="registerForm">
                  <form action="controller/register_process.php" id="register" name="register" method="post">
                      <label>Register</label>
                      <input name="email" type="email" placeholder="Email">
                      <input name="firstName" type="text" placeholder="First Name">
                      <input name="lastName" type="text" placeholder="Last Name">
                      <input name="password" type="text" placeholder="Password">
                      <div class="formLabel"> Date of Birth: </div>
                      <input name="dob" type="date" placeholder="Date of Birth">
                      <button class="registerButton" type="submit" name="loginSubmit">Register</button>
                  </form>
                  <br>
                  <span id="loginRedirect"> Already Have an Account? </span>
              </div>
          </div>
      </div>

  </body>

  <script src="view/js/script.js"></script>

</html>
