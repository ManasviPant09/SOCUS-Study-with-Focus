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
    <title>Data Structures & Algorithms</title>
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
                <h2 class="text-center">Data Sructures & Algorithms</h2>
                <div class="team-boxed-tagline">
                <p class="text-center">"If you've chosen the right data structures and organized things well, the algorithms will almost always be self-evident."</p>
                </div>
            </div>
            <div class="row people">
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/arrays.png">
                        <h3 class="name">Arrays</h3>
                        <p class="title"></p>
                        <p class="description">An array is a data structure that is used collect multiple variables of the same data type together into one variable. Each individual item can be referred to by its position number.</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button" onclick="location.href='topic_details.php?sub_topic_name=Arrays';">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/stacks.jpg">
                        <h3 class="name">Stacks</h3>
                        <p class="title"></p>
                        <p class="description">Stack is a linear data structure which follows a particular order in which the operations are performed. The order may be LIFO(Last In First Out) or FILO(First In Last Out).</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button" onclick="location.href='topic_details.php?sub_topic_name=Stacks';">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/linked_list.png">
                        <h3 class="name">Linked List</h3>
                        <p class="title"></p>
                        <p class="description">A linked list is a linear data structure, in which the elements are not stored at contiguous memory locations. The elements in a linked list are linked using pointers.</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button" onclick="location.href='topic_details.php?sub_topic_name=Linked List';">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/queue.jpg">
                        <h3 class="name">Queues</h3>
                        <p class="title"></p>
                        <p class="description">A Queue is a linear structure which follows a particular order in which the operations are performed. The order is First In First Out (FIFO). A good example of a queue is any queue of consumers for a resource where the consumer that came first is served first.</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button" onclick="location.href='topic_details.php?sub_topic_name=Queues';">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/heaps.png">
                        <h3 class="name">Heaps</h3>
                        <p class="title"></p>
                        <p class="description">A heap is a tree-based data structure in which all the nodes of the tree are in a specific order. The maximum number of children of a node in a heap depends on the type of heap. Binary heap has at most 2 children of a node.</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button" onclick="location.href='topic_details.php?sub_topic_name=Heaps';">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/graphs.png">
                        <h3 class="name">Graphs</h3>
                        <p class="title"></p>
                        <p class="description">A graph can be defined as group of vertices and edges that are used to connect these vertices. A graph can be seen as a cyclic tree, where the vertices (Nodes) maintain any complex relationship among them instead of having parent child relationship.</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button" onclick="location.href='topic_details.php?sub_topic_name=Graphs';">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/vectors.png">
                        <h3 class="name">Vectors</h3>
                        <p class="title"></p>
                        <p class="description">A vector is a one-dimensional data structure and all of its elements are of the same data type. A factor is one-dimensional and every element must be one of a fixed set of values, called the levels of the factor.</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button" onclick="location.href='topic_details.php?sub_topic_name=Vectors';">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/trees.png">
                        <h3 class="name">Trees</h3>
                        <p class="title"></p>
                        <p class="description">A tree data structure is a non-linear data structure because it does not store in a sequential manner. It is a hierarchical structure as elements in a Tree are arranged in multiple levels. In the Tree data structure, the topmost node is known as a root node.</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button" onclick="location.href='topic_details.php?sub_topic_name=Trees';">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/searching.jpg">
                        <h3 class="name">Searching Algorithms</h3>
                        <p class="title"></p>
                        <p class="description">Searching Algorithms are designed to check for an element or retrieve an element from any data structure where it is stored. Based on the type of search operation, these algorithms are generally classified into two categories: Sequential & Interval.</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button" onclick="location.href='topic_details.php?sub_topic_name=Searching Algorithms';">Explore More</button></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="assets/img/sorting.jpg">
                        <h3 class="name">Sorting Algorithms</h3>
                        <p class="title"></p>
                        <p class="description">A Sorting Algorithm is used to rearrange a given array or list elements according to a comparison operator on the elements. The comparison operator is used to decide the new order of element in the respective data structure.</p>
                        <!-- <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div> -->
                        <div><button class="button-3" role="button" onclick="location.href='topic_details.php?sub_topic_name=Sorting Algorithms';">Explore More</button></div>
                    </div>
                </div>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>