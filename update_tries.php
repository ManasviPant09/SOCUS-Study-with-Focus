<?php
require __DIR__ . '/includes/config.php';
date_default_timezone_set("Asia/Kolkata");
$db = DataBase(); 
$planned_date = date('Y-m-d');
$sql = "UPDATE schedule SET tries=:tries WHERE username=:username AND planned_date=:planned_date";
$query = $db->prepare($sql);
$query->bindParam("tries", $tries, PDO::PARAM_STR);
$query->bindParam("username", $username, PDO::PARAM_STR);
$query->bindParam("planned_date", $planned_date, PDO::PARAM_STR);
$query->execute();
?>