<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "jobrecruiter180@gmail.com";
$mail->Password = "thedarkknight";
$mail->setFrom('yamin875@gmail.com', 'First Last');
$mail->addReplyTo('jobrecruiter180@gmail.com', 'First Last');
$mail->addAddress('shahariar430@gmail.com', 'John Doe');
$mail->Subject = 'PHPMailer GMail SMTP test';
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';


$Name = $_POST["Name"];
$MinQuali = $_POST["MinQuali"];
$Field = $_POST["Field"];
$Description = $_POST["Description"];
$Salary = $_POST["Salary"];
$Exam_Minute_Duration = $_POST["Exam_Minute_Duration"];

$dhour = $_POST["dhour"];
$dminute = $_POST["dminute"];
$dmonth = $_POST["dmonth"];
$dday = $_POST["dday"];
$dyear = $_POST["dyear"];

$ehour = $_POST["ehour"];
$eminute = $_POST["eminute"];
$emonth = $_POST["emonth"];
$eday = $_POST["eday"];
$eyear = $_POST["eyear"];
$Question_Number = $_POST["Question_Number"];

$dtime = $dday . "/" . $dmonth . "/" . $dyear . " " . $dhour . ":" . $dminute . ":" . "0";
$dtime = strtotime($dtime);

$etime = $eday . "/" . $emonth . "/" . $eyear . " " . $ehour . ":" . $eminute . ":" . "0";
$etime = strtotime($etime);

$mydtime = date("Y-m-d h:i:s", $dtime);
$myetime = date("Y-m-d h:i:s", $etime);

$conn = mysqli_connect('localhost', 'root', '', 'job_recruitment');
$conn->query("INSERT INTO Job_Posting (Job_Title, Min_Quali, Deadline, Salary, Exam_Date_Time, Field, Description, Exam_Minute_Duration) VALUES('$Name', '$MinQuali', '$mydtime', '$Salary', '$myetime', '$Field', '$Description', '$Exam_Minute_Duration')");
$Job_ID = $conn->insert_id;

for ($i = 0; $i < $Question_Number; ++$i) {
	$Option1 = $_POST["Option1"][$i];
	$Option2 = $_POST["Option2"][$i];
	$Option3 = $_POST["Option3"][$i];
	$Option4 = $_POST["Option4"][$i];
	$Question = $_POST["Question"][$i];
	$Correct = $_POST["Correct"][$i];
	echo $Correct;
	$result = $conn->query("INSERT INTO Questions (Job_ID, Question, Option1, Option2, Option3, Option4, Correct) VALUES('$Job_ID', '$Question', '$Option1', '$Option2', '$Option3', '$Option4', '$Correct')") or die(mysqli_error());
}

$result = $conn->query("SELECT Email FROM Job_Viewer WHERE Field = '$Field' AND Education >= '$MinQuali'");
if ($result->num_rows > 0) {
	while ($row=$result->fetch_assoc()) {
		$Email = $row["Email"];
		echo $Email;
	}
}

?>

<html>
<body>
	<?php echo $dtime; ?>
</body>