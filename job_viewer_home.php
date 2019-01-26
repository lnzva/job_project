<?php
session_start();
if (!isset($_SESSION["email"])) {
	header("Location: login_prompt.php");
	exit;
}
?>
<!DOCTYPE html>
<html>
<body>
	<?php
	$conn = mysqli_connect('localhost', 'root', '', 'testlogin');
	if ($conn->connect_error)
		die("Connection failed: ". $conn->connect_error);
	$user_email = $_SESSION["email"];
	$sql = "SELECT * FROM Job_Viewer WHERE Email = '$user_email'";
	$rslt = conn->query($sql);
	$row = mysql_fetch_array($rslt);
	?>
</body>
</html>