<?php
session_start();
if (!isset($_SESSION["ID"])) {
	header("Location: login_prompt.php");
	exit;
}

$Job_Viewer_ID = $_SESSION['ID'];
$Job_ID = 44;

$conn = mysqli_connect('localhost', 'root', '', 'job_recruitment');
$result = $conn->query("SELECT * FROM Questions WHERE Job_ID = '$Job_ID'");

$ret = Array();

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$ret[] = $row;
	}
}

$marks = 0;

for ($i = 0; $i < sizeof($ret); ++$i) {
	if (isset($_POST["Answer"][$i]) && $ret[$i]["Correct"] == $_POST["Answer"][$i])
		++$marks;
}

$conn->query("UPDATE Applies_For SET Marks = '$marks' WHERE Job_ID = '$Job_ID' AND Job_Viewer_ID = '$Job_Viewer_ID'");
?>