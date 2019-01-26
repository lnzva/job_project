<?php
session_start();
if (!isset($_SESSION['ID'])) {
	header("Location: login_prompt.php");
	exit;
}
$Job_Viewer_ID = $_SESSION['ID'];
$conn = mysqli_connect('localhost', 'root', '', 'job_recruitment');
$result = $conn->query("SELECT * FROM Job_Posting");
$i = 0;
$user_ID = $_SESSION['ID'];
while ($row = $result->fetch_assoc()) {
	$Job_ID = $row["Job_ID"];
	echo $Job_ID;
	echo $_POST["Apply"][$i];
	if ($_POST["Apply"][$i] == "Applied") {
		$conn->query("INSERT INTO Applies_For VALUES('$Job_ID','$user_ID')");
	}
	else {
		$conn->query("DELETE FROM Applies_For WHERE Job_ID = '$Job_ID' AND Job_Viewer_ID = '$user_ID'");
	}
	$i = $i + 1;
}
//header("Location: Job_Viewer_home.php");
?>