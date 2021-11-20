<?php  
session_start();
date_default_timezone_set("Asia/Kolkata");  
if(!$_SESSION['username'])  
{  
  
    header("Location: index.php");//redirect to the login page to secure the welcome page without login access.  
}  
require __DIR__ . '/includes/config.php';  
?> 
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/style_home_1.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <style>
        * {
          box-sizing: border-box;
        }

        /* Create two unequal columns that floats next to each other */
        .column {
          float: left;
          padding-left: 8px;
          padding-right: 8px;
          padding-top: 10px;
          padding-bottom: 60px;
          width: 100%;
          margin-bottom: 0;
        }

        .left {
          width: 40%;
        }

        .right {
          width: 60%;
        }

        /* Clear floats after the columns */
        .row:after {
          content: "";
          display: table;
          clear: both;
        }

        /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
          .column {
            width: 100%;
          }
        }

        div.leftH2{
          margin: 5px;
          padding: 5px;
          text-align:left;
          font-size: 18px;
          color: black;
          font-family: Georgia, Garamond, serif;
          width: 100%;
        }
        div.rightH2{
          margin: 5px;
          padding: 5px;
          font-size: 22px;
          color: black;
          font-family: Georgia, Garamond, serif;
        }
        div.buttonH2{
          margin-left: 5px;
          padding-left: 5px;
          padding-top: 10px;
          margin-top: 10px;
          font-size: 20px;
          color: black;
          font-family: Georgia, Garamond, serif;
        }
        .img-responsive{
            display: block; max-width: 100%; height: auto; border-radius: 25px; padding: 5px;
        }

    </style>
</head>

<body>
    <!-- Debut du code de la barre de navigation -->
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
            
                <h2 class="text-center">Schedule Your Studies On SOCUS</h2>
                <div class="team-boxed-tagline">
                <p class="text-center">"A goal without a plan is just a wish."</p><br><br><p class="text-center"><i>Note- It is mandatory to schedule your learning hours for each day, one day before.</i></p>
            
            <div class="row" style="margin: auto">
              <div class="column left">
                <div class="box"><img class="img-responsive" src="assets/img/plans.jpg">
                </div>
              </div>
              <div class="column right">
                <form action="" method="post">
                    <div class="rightH2">
                        Select Scheduled Date
                    </div>
                    <div class="leftH2">
                        <input type="date" id="datepicker" min="<?php echo date("Y-m-d", strtotime("+0 day")); ?>" placeholder="Select Date" name="datepicker" width="300" />
                    </div>
                    <div class="rightH2">
                        Select Start Time
                    </div>
                    <div class="leftH2">
                      <input type="time" id="from_time" placeholder="Select Start Time" name="from_time" width="300" />
                    </div>
                    <div class="rightH2">
                        Select End Time
                    </div>
                    <div class="leftH2">
                      <input type="time" id="to_time" placeholder="Select End Time" name="to_time" width="300" />
                    </div>
                    <div class="buttonH2">
                    <div><button class="button-3" role="button" value=" Submit " name="submit">Submit</button></div>
                    </div>
                </form>
              </div>
            </div>
    </div>
    <?php
    if(isset($_POST["submit"])){

    try {
    $dbh = DataBase();

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
    $sql = "INSERT INTO schedule (username, planned_date, from_time, to_time)
    VALUES ('".$_SESSION["username"]."','".$_POST["datepicker"]."','".$_POST["from_time"]."','".$_POST["to_time"]."')";
    if ($dbh->query($sql)) {
    /*echo "<script type= 'text/javascript'>alert('Schedule Updated Successfully!');</script>";*/
    echo '<script type="text/javascript">
                                    setTimeout(function() {
                                        swal({
                                    title: "Congratulations!",
                                    text: "Schedule Updated Successfully!",
                                    icon: "success"
                                    }).then(function() {
                                        window.location = "homepage.php";
                                    });
                                    }, 1000);
                                    </script>';
    }
    else{
    /*echo "<script type= 'text/javascript'>alert('Please Try Again...');</script>";*/
    echo '<script type="text/javascript">
                                    setTimeout(function() {
                                        swal({
                                    title: "Ooppssss",
                                    text: "Something went wrong, please try again!",
                                    icon: "error"
                                    }).then(function() {
                                        window.location = "homepage.php";
                                    });
                                    }, 1000);
                                    </script>';
    }

    $dbh = null;
    }
    catch(PDOException $e)
    {
    echo $e->getMessage();
    }

    }
    ?>

    <script src="assets/js/nav-bar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>