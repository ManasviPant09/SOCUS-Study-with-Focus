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
    <title>SOCUS - Code Playground</title>
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
        * {
          box-sizing: border-box;
        }

        /* Create two unequal columns that floats next to each other */
        .column {
          float: left;
          padding: 10px;
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
          margin-left: 5px;
          padding-left: 5px;
          text-align:justify;
          word-wrap: break-word;
        }
        div.rightH2{
          margin-left: 5px;
          padding-left: 5px;
          text-align:justify;
          word-wrap: break-word;
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

<body onbeforeunload="myFunc()">
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
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $qid=$_GET['qid'];
                    //$difficulty_level=$_GET['difficulty_level'];
                    $sql = "SELECT * FROM coding_questions where id=:qid";
                    $query = $dbh -> prepare($sql);
                    $query->bindParam(':qid',$qid,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                        foreach($results as $result)
                        { ?>


        <div class="row" style="margin: auto">
          <div class="column left">
            <div class="leftH2">
                <h2><?php echo htmlentities($result->question_title);?></h2>
            </div>
            <div class="rightH2">
            <?php echo htmlentities(str_replace('. ', ".\r\n", $result->question));?>
            <br><br><br>
            <?php echo htmlentities($result->notes);?>
            </div>
            <?php }} ?>
          </div>
          <div class="column right">
            <div id="compiler-area">
                <div id="language-choice-div">
                <label for="language-choice"><strong>Choose a Language</strong></label>
                <select name="language-choice" id="language-choice">
                    <option value="python">Python</option>
                    <option value="cpp">CPP</option>
                    <option value="java">Java</option>
                    <option value="c">C</option>
                </select>
                </div>
                <!-- Python -->
                <div id="python-compiler" class="show-me">
                    <iframe src="https://widgets.judge0.com?widgetId=ANrRvntQ-EzWWqT0Nj3W-oxOYzPg&theme=dark&language=en"
                        style="width: 100%; height: 30em; border: none;"></iframe>
                </div>
                <div id="c-compiler" class="show-me">
                    <!-- C -->
                    <iframe src="https://widgets.judge0.com?widgetId=AIfZVKlXWU9FN1jvqXH26w1x-euC&theme=dark&language=en"
                                    style="width: 100%; height: 30em; border: none;"></iframe>
                </div>
                <div id="cpp-compiler" class="show-me">
                    <!-- C++ -->
                    <iframe src="https://widgets.judge0.com?widgetId=AHV7pfe3-HnbURptgv-pB0I6aqrq&theme=dark&language=en"
                                        style="width: 100%; height: 30em; border: none;"></iframe>
                </div>
                <div id="java-compiler" class="show-me">
                <!-- Java -->
                <iframe src="https://widgets.judge0.com?widgetId=APTjjdGIOZoOaN8a_Tv2v0OLk_Qg&theme=dark&language=en"
                                    style="width: 100%; height: 30em; border: none;"></iframe>
                </div>
               
            </div>
          </div>
        </div>
    </div>

    
    <!-- Script to Switch Programming Language -->
    <script>
        const elem= document.getElementById("language-choice")
        
        elem.onchange= ()=>{
            const pythonCompiler = document.getElementById("python-compiler")
            const list=['python','c','cpp','java']
            list.forEach((item)=>{
                const compiler= document.getElementById(`${item}-compiler`)
                if(elem.value.toLowerCase()===item){
                    compiler.style.display='block'
                }
                else{
                    compiler.style.display='none'
                }
                
            })
        }
    </script>

    <!-- tab switching script -->

    <?php 
        $dbh = DataBase();
        $what = "Your Goals";
        $why = "Why You Want To Achieve Them";
        $tries = 0;
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
        $username=$_SESSION["username"];
        $sql = "SELECT * FROM goals where username=:username";
        $query = $dbh -> prepare($sql);
        $query->bindParam(':username',$username,PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0){
            $check = $query->fetch(PDO::FETCH_ASSOC);
            $what = $check['what'];
            $why = $check['why'];
            // do something
        }
        $planned_date = date('Y-m-d');
        $sql1 = "SELECT * FROM schedule WHERE username=:username AND planned_date=:planned_date";
        $query1 = $dbh -> prepare($sql1);
        $query1->bindParam(':username',$username,PDO::PARAM_STR);
        $query1->bindParam(':planned_date',$planned_date,PDO::PARAM_STR);
        $query1->execute();

        if ($query1->rowCount() > 0){
            $check1 = $query1->fetch(PDO::FETCH_ASSOC);
            $tries = $check1['tries'];
        }
    ?> 

    <script type="text/javascript">
        var tries = '<?php echo $tries ;?>';
        $(window).blur(function() {
           if(tries==0){
            /*Swal.fire({
              title: 'Opppssss',
              text: "Looks like you have not set your goals for today!",
              icon: 'warning',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Okay'
            }).then((result) => {
              if (result.isConfirmed) {
                location.href='homepage.php';    
              }
            })*/
            location.href='logout.php';
           }
           else if(tries<0){
            Swal.fire({
              title: 'Alert',
              text: "You have exhausted all your attempts for today!",
              icon: 'error',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Okay'
            }).then((result) => {
              if (result.isConfirmed) {
                location.href='logout.php';    
              }
            })
           }
           else{
            answhat = '<?php echo $what ;?>';
            answhy = '<?php echo $why ;?>';
               Swal.fire({
                  title: '<div class="align-right"><b>SOCUS - Study With Foucs<br><br>You\'re trying to leave the website. Remember why you started!</b></div>',
                  html: '<div class="align-left"><b>What are the goals you hope to achieve after this course?</b><br>' + answhat + '<br><br><b>Why do you want to achieve this goal?</b><br>' + answhy + '<br><br><br><b><i>You\'ll be logged out after ' + tries + ' more attempts.</b></i></div>',
                  icon: 'warning',
                  width: 600,
                  padding: '2em',
                  background: '#fff',
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  backdrop: `
                    rgba(0,0,123,0.4)
                    left top
                    no-repeat
                  `,
                  confirmButtonText: 'Okay'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.top.location = window.top.location;
                  }
                })
                <?php
                //require __DIR__ . '/includes/config.php';
                $db = DataBase();
                $sql = "UPDATE schedule SET tries=tries-1 WHERE username=:username AND planned_date=:planned_date";
                $query = $db->prepare($sql);
                $query->bindParam("username", $username, PDO::PARAM_STR);
                $query->bindParam("planned_date", $planned_date, PDO::PARAM_STR);
                $query->execute();
                ?>
            }
        });
    </script>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>