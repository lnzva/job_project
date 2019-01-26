<?php
$conn = mysqli_connect('localhost', 'root', '', 'job_recruitment');
$field = $_POST['field'];
$min_education_level = $_POST['min_education_level'];
$max_education_level = $_POST['max_education_level'];
$result = $conn->query("SELECT * FROM Job_Viewer WHERE Field = '$field' AND Education <= '$max_education_level' AND Education >= '$min_education_level'");
$ret = Array();
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc())
		$ret[] = $row;
}

echo json_encode($ret);
?>