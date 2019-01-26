<?php
$Job_ID = $_POST['Job_ID'];
$conn = mysqli_connect('localhost', 'root', '', 'job_recruitment');
$result = $conn->query("SELECT Exam_Date_Time, Exam_Minute_Duration FROM Job_Posting WHERE Job_ID = '$Job_ID'");
$row = $result->fetch_assoc();
$etime = $row["Exam_Date_Time"];
$eetime = $row["Exam_Minute_Duration"];
$etime = strtotime($etime);
$eetime = ($eetime * 60) + $etime;
$ctime = strtotime(date("Y-m-d H:i:s"));
echo $eetime - $ctime;
?>