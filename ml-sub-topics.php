<?php  
session_start();  
date_default_timezone_set("Asia/Kolkata");
if(!$_SESSION['username'])  
{  
  
    header("Location: index.php");//redirect to the login page to secure the welcome page without login access.  
}  
  
?> 

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Machine Learning with Python</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style_home_1.css">
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
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Machine Learning With Python</h2>
                <div class="team-boxed-tagline">
                    <p class="text-center">"Machine Learning is making the computer learn from studying data and statistics.Machine Learning is a step into the direction of artificial intelligence (AI)."</p>
                </div>
            </div>
            <div class="row people">
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/ml-track-imgs/python-basics.png">
                        <h3 class="name">Python- Basics</h3>
                        <p class="title"></p>
                        <p class="description">Python was designed for readability, and has some similarities to the English language with influence from mathematics.Python has syntax that allows developers to write programs with fewer lines than some other programming languages.Python runs on an interpreter system.</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/ml-track-imgs/python-intermediate.jpg">
                        <h3 class="name">Python- Intermediate</h3>
                        <p class="title"></p>
                        <p class="description">Python - Intermediate includes file handling and error catching. Various pythom libraries like numpy,pandas and matplotlib are also covered. OOPs concept such as data abstraction, encapsulation and inheritance can also be achieved in python.</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/ml-track-imgs/probability.jpg">
                        <h3 class="name">Probability</h3>
                        <p class="title"></p>
                        <p class="description">Probability is the branch of mathematics concerning numerical descriptions of how likely an event is to occur. The probability of an event is a number between 0 and 1, where, roughly speaking, 0 indicates impossibility of the event and 1 indicates certainty</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/ml-track-imgs/linear-algebra.jpg">
                        <h3 class="name">Linear Algebra</h3>
                        <p class="title"></p>
                        <p class="description">Linear algebra is also used in most sciences and fields of engineering, because it allows modeling many natural
                        phenomena, and computing efficiently with such models. For nonlinear systems, which cannot be modeled with linear
                        algebra, it is often used for dealing with first-order approximations.</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/ml-track-imgs/data-manipulation.png">
                        <h3 class="name">Data manipulation and Visualisation</h3>
                        <p class="title"></p>
                        <p class="description">Data manipulation refers to the process of adjusting data to make it organised and easier to read. It adjusts data by inserting, deleting and modifying data in a database such as to cleanse or map the data</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/ml-track-imgs/supervides-learning.png">
                        <h3 class="name">Supervised Learning Introduction</h3>
                        <p class="title"></p>
                        <p class="description">
                            Supervised learning (SL) is the machine learning task of learning a function that maps an input to an output based on
                            example input-output pairs. A supervised learning algorithm analyzes the training data and produces an inferred
                            function.
                        </p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/ml-track-imgs/unsupervised learning1.png">
                        <h3 class="name">Unsupervised Learning Introduction</h3>
                        <p class="title"></p>
                        <p class="description">
                            Unsupervised learning refers to the use of artificial intelligence (AI) algorithms to identify patterns in data sets
                            containing data points that are neither classified nor labeled. In other words, unsupervised learning allows the
                            system to identify patterns within data sets on its own
                        </p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/ml-track-imgs/reinforcment-learning.jpg">
                        <h3 class="name">Reinforcment Learning</h3>
                        <p class="title"></p>
                        <p class="description">Reinforcement learning is a machine learning training method based on rewarding desired behaviors and/or punishing
                        undesired ones. In general, a reinforcement learning agent is able to perceive and interpret its environment, take
                        actions and learn through trial and error</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/ml-track-imgs/knn1algo.png">
                        <h3 class="name">KNN Alogorithm</h3>
                        <p class="title"></p>
                        <p class="description">
                            K-NN algorithm assumes the similarity between the new case/data and available cases and put the new case into the
                            category that is most similar to the available categories.
                            K-NN algorithm stores all the available data and classifies a new data point based on the similarity. This means when
                            new data appears then it can be easily classified into a well suite category by using K- NN algorithm.
                        </p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button">Explore More</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    window.location.href = 'homepage.php';
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
    <script src="assets/js/nav-bar.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>