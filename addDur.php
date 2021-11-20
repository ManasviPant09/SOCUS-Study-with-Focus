<?php
session_start();  
require __DIR__ . '/includes/config.php';
date_default_timezone_set("Asia/Kolkata");

$curr_date = date('Y-m-d');
$duration = $_POST['duration'];
$page_url = $_POST['page_url'];
$username=$_SESSION["username"];

$db = DataBase();
$sql = "UPDATE schedule SET time_spent=time_spent+:duration WHERE username=:username AND planned_date=:curr_date";
$query = $db->prepare($sql);
$query->bindParam("duration", $duration, PDO::PARAM_STR);
$query->bindParam("username", $username, PDO::PARAM_STR);
$query->bindParam("curr_date", $curr_date, PDO::PARAM_STR);
$query->execute();
/*$sql = "INSERT INTO time_spent(username, page_url, duration, curr_date) VALUES (:username,:page_url,:duration,:curr_date)";
$query = $db->prepare($sql);
$query->bindParam("username", $username, PDO::PARAM_STR);
$query->bindParam("page_url", $page_url, PDO::PARAM_STR);
$query->bindParam("duration", $duration, PDO::PARAM_STR);
$query->bindParam("curr_date", $curr_date, PDO::PARAM_STR);
$query->execute();


$db = DataBase();
            $what = $_POST['what'];
            $why = $_POST['why'];
            $username = $_SESSION['username'];
            $sql = "UPDATE goals SET what=:what, why=:why WHERE username=:username";
            $query = $db->prepare($sql);
            $query->bindParam("what", $what, PDO::PARAM_STR);
            $query->bindParam("why", $why, PDO::PARAM_STR);
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $query->execute();
            echo "<script type= 'text/javascript'>alert('Goals Updated Successfully!');</script>";
            echo "<script> location.href='homepage.php'; </script>";

            $db = null;*/

?>