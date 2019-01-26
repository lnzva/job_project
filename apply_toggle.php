<?php
session_start();
if (!isset($_SESSION['ID'])) {
	header("Location: login_prompt.php");
	exit;
}
$Job_Viewer_ID = $_SESSION['ID'];
$Job_ID = $_POST['Job_ID'];
$conn = mysqli_connect('localhost', 'root', '', 'job_recruitment');
$result = $conn->query("SELECT * FROM Applies_For WHERE Job_ID = '$Job_ID' AND Job_Viewer_ID = '$Job_Viewer_ID'");
if (mysqli_num_rows($result) == 0) {
	$conn->query("INSERT INTO Applies_For (Job_ID, Job_Viewer_ID) VALUES('$Job_ID', '$Job_Viewer_ID')");
}
else {
	$conn->query("DELETE FROM Applies_For WHERE Job_ID = '$Job_ID' AND Job_Viewer_ID = '$Job_Viewer_ID'");
}
echo "Success";
?>