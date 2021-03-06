<?php 
date_default_timezone_set("Asia/Kolkata");
  require_once 'includes/library.php';
  $app = new AppLib();
  if (isset($_POST['register'])) {
    $fullname = htmlspecialchars($_POST['fullname']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirmpass = htmlspecialchars($_POST['confirm_password']);
    if ($password == $confirmpass) {
          $app->Register($fullname,$username,$email,$password);
    }else{
      echo "<script>alert('your passwords does not match')</script>";
    }    
  }elseif (isset($_POST['login'])) {
   $username = htmlspecialchars($_POST['username']);
   $password = htmlspecialchars($_POST['password']);
   $app->Login($username,$password);
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <title>SOCUS - Study With Focus</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form method="post" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input name="username" type="text" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input name="password" type="password" placeholder="Password" />
            </div>
            <input type="submit" name="login" value="Login" class="btn solid" />
          </form>
          <form method="post" class="sign-up-form">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input required name="fullname" type="text" placeholder="Full Name" />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input required name="username" type="text" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input name="email" required type="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input name="password" required type="password" placeholder="Password" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input name="confirm_password" required type="password" placeholder="Confirm Password" />
            </div>
            <input type="submit" name="register" class="btn" value="Sign up" />
            <!-- <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div> -->
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Welcome To SOCUS</h3>
            <p>
              New User? Get started by creating an account...
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Welcome Back!</h3>
            <p>
              Existing User? Sign In to continue studying...
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>
    <!-- <div>
      <iframe src="https://widgets.judge0.com?widgetId=ANrRvntQ-EzWWqT0Nj3W-oxOYzPg&theme=dark&language=en" style="width: 100%; height: 30em; border: none;"></iframe>

      <iframe src="https://widgets.judge0.com?widgetId=AIfZVKlXWU9FN1jvqXH26w1x-euC&theme=dark&language=en" style="width: 100%; height: 30em; border: none;"></iframe>

      <iframe src="https://widgets.judge0.com?widgetId=APTjjdGIOZoOaN8a_Tv2v0OLk_Qg&theme=dark&language=en" style="width: 100%; height: 30em; border: none;"></iframe>

      <iframe src="https://widgets.judge0.com?widgetId=AHV7pfe3-HnbURptgv-pB0I6aqrq&theme=dark&language=en" style="width: 100%; height: 30em; border: none;"></iframe>
    </div> -->

    
    <script src="app.js"></script>

    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js">
    </script>
    <script type="text/javascript">
       (function(){
          emailjs.init("user_pN8eUy20ULpoCdg3NHFAp");
       })();
    </script>
  </body>
</html>
