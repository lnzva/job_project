<?php
$dtime = $_POST["Deadline"];
$dmin = $_POST["Exam_Minute_Duration"];
$dtime = strtotime($dtime);
$back = $dtime;
$dtime = $dtime + $dmin * 60;
$ctime = strtotime(date("Y-m-d H:i:s"));
if ($ctime >= $back && $ctime < $dtime) {
	echo "$dtime";
}
else {
	echo "$dtime";
}
?>