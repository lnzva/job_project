<?php
session_start();
if (!isset($_SESSION["ID"])) {
	header("Location: login_prompt.php");
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
	$user_ID = $_SESSION["ID"];
	$sql = "SELECT * FROM Job_Viewer WHERE Job_Viewer_ID = $user_ID";
	$rslt = $conn->query($sql);
	$rslt = mysqli_fetch_array($rslt);
	if ($rslt["Password"] != $_POST["OldPassword"]) {
		$_SESSION["BadOldPassword"] = true;
		$_SESSION["BadEmailFormat"] = true;
		$_SESSION["PrevPage"] = "Job_Viewer_edit.php";
		header("Location: Wrong_Format_Job_Viewer_edit.php");
		unset($_SESSION["BadOldPassword"]);
		unset($_SESSION["BadEmailFormat"]);
		header("Location: Job_Viewer_edit_prompt.php");
		exit;
	}
	$ID = $_SESSION["ID"];
	if ($_POST["Name"] != "") {
		$nname = $_POST["Name"];
		$sql = "UPDATE Job_Viewer SET Name = '$nname' WHERE Job_Viewer_ID = '$ID'";
		$conn->query($sql);
	}
	if ($_POST["Email"] != "") {
		$nemail = $_POST["Email"];
		$sql = "UPDATE Job_Viewer SET Email = '$nemail' WHERE Job_Viewer_ID = '$ID'";
		$conn->query($sql);
	}
	if ($_POST["Address"] != "") {
		$naddress = $_POST["Address"];
		$sql = "UPDATE Job_Viewer SET Address = '$naddress' WHERE Job_Viewer_ID = '$ID'";
		$conn->query($sql);
	}
	if ($_POST["NewPassword"] != "") {
		$npassword = $_POST["NewPassword"];
		$sql = "UPDATE Job_Viewer SET Password = '$npassword' WHERE Job_Viewer_ID = '$ID'";
		$conn->query($sql);
	}
	header("Location: Job_Viewer_home.php");
	?>
</body>
</html>
	