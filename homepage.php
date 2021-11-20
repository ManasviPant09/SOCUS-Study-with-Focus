<?php  
session_start();  
date_default_timezone_set("Asia/Kolkata");
if(!$_SESSION['username'])  
{  
  
    header("Location: index.php");//redirect to the login page to secure the welcome page without login access.  
}  
require __DIR__ . '/includes/config.php';
$dbh = DataBase();
$username=$_SESSION["username"];
$planned_date = date('Y-m-d');
$sql1 = "SELECT * FROM schedule WHERE username=:username AND planned_date=:planned_date";
$query1 = $dbh -> prepare($sql1);
$query1->bindParam(':username',$username,PDO::PARAM_STR);
$query1->bindParam(':planned_date',$planned_date,PDO::PARAM_STR);
$query1->execute();

if ($query1->rowCount() > 0){
    $check1 = $query1->fetch(PDO::FETCH_ASSOC);
    $tries = $check1['tries'];
    if($tries<0){
        echo '<script type="text/javascript">
                setTimeout(function() {
                    swal({
                title: "Alert",
                text: "You have exhausted all your attempts for today. Check Back Tomorrow...",
                icon: "error"
                }).then(function() {
                    window.location = "logout.php";
                });
                }, 1000);
                </script>';
    }
} 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/style_home_1.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="assets/js/jquery.fullscreen-min.js"></script>
        
    <!-- //Script to track time spent -->

    <script> startTime = new Date(); </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- //Ends here -->
    <style>
        .align-left {
          text-align: left;
          font-size: 16px;
        }
        .align-right {
          text-align: center;
          font-size: 20px;
        }
    </style>
</head>

<body onbeforeunload="myFunc()">

    <header>
        <nav class="navbar">
            <a href="#" class="navbar__logo">SOCUS</a>
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="toplearners.php">Top Learners</a></li>
                <li><a href="schedules.php">Schedules</a></li>
                <li><a href="">Profile</a></li>
                <li><a href="">
                    <?php
                      $dbh = DataBase();
                      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $curr_date = date('Y-m-d');
                      $username=$_SESSION['username'];
                      /*$sql1 = "SELECT SUM(duration) AS value_sum FROM time_spent WHERE username=:username AND curr_date=:curr_date";
                        $query1 = $dbh -> prepare($sql1);*/
                        $sql1 = "SELECT * FROM schedule WHERE username=:username AND planned_date=:curr_date";
                        $query1 = $dbh -> prepare($sql1);
                        $query1->bindParam(':username',$username,PDO::PARAM_STR);
                        $query1->bindParam(':curr_date',$curr_date,PDO::PARAM_STR);
                        $query1->execute();

                        if ($query1->rowCount() > 0){
                            $check1 = $query1->fetch(PDO::FETCH_ASSOC);
                            $dur = $check1['time_spent'];
                            $dur = $dur/1000/60;
                            $dur = round($dur,0);
                            $firstTime=strtotime($check1['from_time']);
                            $lastTime=strtotime($check1['to_time']);
                            $timeDiff=$lastTime-$firstTime;
                            $timeDiff=$timeDiff/60;
                            echo 'Time Spent Today : ' .$dur.' minutes <br>';
                            if ($dur > $timeDiff) {
                                echo '<script type="text/javascript">
                                    setTimeout(function() {
                                        swal({
                                    title: "Congratulations!",
                                    text: "You have achieved your goal for today. You may now take rest and login tomorrow. Don\'t forget to set your schedule for tomorrow.",
                                    icon: "success"
                                    }).then(function() {
                                        window.location = "homepage.php";
                                    });
                                    }, 1000);
                                    </script>';
                            }
                        }
                      ?>
                </a></li>
                <li class="cta__button"><a href="logout.php">Logout</a></li>
            </ul>
            <button class="navbar__toggler">
                <span></span>
            </button>
        </nav>
    </header>

    <div class="team-boxed">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">SOCUS - STUDY WITH FOCUS</h2>
                <div class="team-boxed-tagline">
                <p class="text-center">"If it important for you, you will find a way and not an excuse."</p>
                </div>
            </div>
            <div class="row people">
                <div class="col-md-8 col-lg-6 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/1.jpg">
                        <h3 class="name">Data Structures & Algorithms</h3>
                        <p class="title"></p>
                        <p class="description">A data structure is a named location that can be used to store and organize data. And, an algorithm is a collection of steps to solve a particular problem. Learning data structures and algorithms allow us to write efficient and optimized computer programs.</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button" onclick="location.href='ds-sub-topics.php';">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-6 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/2.jpg">
                        <h3 class="name">Machine Learning With Python</h3>
                        <p class="title"></p>
                        <p class="description">Machine learning (ML) is a type of artificial intelligence (AI) that allows software applications to become more accurate at predicting outcomes without being explicitly programmed to do so. Machine learning algorithms use historical data as input to predict new output values.</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button" onclick="location.href='ml-sub-topics.php';">Explore More</button></div>
                    </div>
                </div>
                <!-- <div id="buttons">
                    <button onclick="$(document).fullScreen(true)">Enter Fullscreen mode (Document)</button>
                </div> -->
                <!-- <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/3.jpg">
                        <h3 class="name">Carl Kent</h3>
                        <p class="title">Stylist</p>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et interdum justo suscipit id. Etiam dictum feugiat tellus, a semper massa. </p>
                        <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <!-- time tracking script -->
    <script>
      function myFunc(){
        endTime = new Date();
        $.ajax({
          url:'addDur.php',
          method:'POST',
          data:{
            duration:endTime - startTime,
            page_url:window.location.pathname,
          }
        });
      }
      </script>
      <!-- ends here -->

    <script src="assets/js/nav-bar.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>