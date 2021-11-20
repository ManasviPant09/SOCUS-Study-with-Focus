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
    <title>Topic Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/style_home_1.css">
    <script src="https://www.riddle.com/embed/files/js/embed.js"></script>
    <link href="https://www.riddle.com/embed/files/css/embed.css" rel="stylesheet">

    <!-- //Script to track time spent -->

    <script> startTime = new Date(); </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- //Ends here -->
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

        .theory{
          padding-left: 10px;
          padding-right: 10px;
          padding-top: 20px;
          padding-bottom: 20px;
          width: 100%;
          margin-bottom: 0;
          text-align: justify;
          font-size: 20px;
          margin: 10px;
        }

        .left {
          width: 50%;
          margin: 10px;
          padding: 10px;
          text-align: justify;
        }

        .right {
          width: 50%;
          margin: 10px;
          padding: 10px;
          text-align: justify;
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
          margin-left: 5px;
          padding-left: 5px;
          text-align:justify;
          word-wrap: break-word;
        }
        div.rightH2{
          margin-left: 5px;
          padding-left: 5px;
          font-size: 22px;
          color: black;
          font-family: Georgia, Garamond, serif;
        }
        .img-responsive{
            display: block; max-width: 100%; height: auto; border-radius: 25px; padding: 5px;
        }
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

        <?php 
                    $dbh = DataBase();
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
                    $sub_topic_name=$_GET['sub_topic_name'];
                    $sql = "SELECT * FROM sub_topics where sub_topic_name=:sub_topic_name";
                    $query = $dbh -> prepare($sql);
                    $query->bindParam(':sub_topic_name',$sub_topic_name,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                        foreach($results as $result)
                        { ?>
            
                <h2 class="text-center"><?php echo htmlentities($result->sub_topic_name);?></h2>
                <div class="team-boxed-tagline">
                <p class="text-center"><?php echo htmlentities($result->parent_topic_name);?></p>
                </div>
            <div class="theory" style="margin: auto">
                <?php echo htmlentities(str_replace('. ', ".\r\n", $result->theory));?>
            </div>
            <div class="row" style="margin: auto">
                <div class="column left">
                    <div><button class="button-3" role="button" onclick="location.href='quizes.php?sub_topic_name=<?php echo htmlentities($result->sub_topic_name);?>';">Take Quiz</button></div>
                </div>
                <div class="column right">
                    <div><button class="button-3" role="button" onclick="location.href='coding-questions.php?sub_topic_name=<?php echo htmlentities($result->sub_topic_name);?>';">Solve Coding Questions</button></div>
                </div>
            </div>
        <?php }} ?>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script id="shoutscript" type="text/javascript" src="https://freeonlinesurveys.com/ShoutEmbed/embed.min.js"></script>
</body>

</html>