<?php
session_start();
if (isset($_SESSION['ID'])) {
	echo $_SESSION['user_type'];
	if ($_SESSION['user_type'] == 'Job_Viewer')
		header("Location: Job_Viewer_home.php");
	else
		header("Location: Job_Recruiter_home.php");
	exit;
}
?>
<!DOCTYPE html>
<html>
<body>
	<?php
	$conn = mysqli_connect('localhost', 'root', '', 'job_recruitment');
	if ($conn->connect_error)
		die("Connection failed: ". $conn->connect_error);
	$user_email = $_POST["email"];
	$user_password = $_POST['psw'];
	$user_type = $_POST["userType"];
	$sql = "SELECT * FROM $user_type WHERE Email = '$user_email' AND Password = '$user_password'";
	$rslt = $conn->query($sql);
	if (mysqli_num_rows($rslt) == 1) {
		$rslt = mysqli_fetch_array($rslt);
		if ($user_type == "Job_Viewer") {
			$_SESSION['ID'] = $rslt["Job_Viewer_ID"];
			$_SESSION['user_type'] = $user_type;
			header("Location: Job_Viewer_home.php");
		}
		else {
			$_SESSION['ID'] = $rslt["Job_Recruiter_ID"];
			$_SESSION['user_type'] = $user_type;
			header("Location: Job_Recruiter_home.php");
		}
	}
	else {
		echo "Login Unsuccessful\nCheck your email/password";
	}
	?>
</body>
</html>
