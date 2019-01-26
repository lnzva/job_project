<?php
$conn = mysqli_connect('localhost', 'root', '', 'job_recruitment');
$Job_Viewer_ID = $_POST['Job_Viewer_ID'];
$minSalary = $_POST['minSalary'];
$companyName = $_POST['companyName'];

$result1 = $conn->query("SELECT Job_Posting.Job_ID as Job_ID, Job_Recruiter.Company_Name as Company_Name, Job_Posting.Job_Title as Job_Title, Job_Posting.Min_Quali as Min_Quali,
Job_Posting.Deadline as Deadline, Job_Posting.Salary as Salary, Job_Posting.Exam_Date_Time as Exam_Date_Time, Job_Posting.Description as Description, Job_Posting.Exam_Minute_Duration as Exam_Minute_Duration
FROM Job_Posting
JOIN
Job_Recruiter
ON
Job_Recruiter.Job_Recruiter_ID = Job_Posting.Job_Recruiter_ID");

$result2 = $conn->query("SELECT Job_ID FROM Applies_For WHERE Job_Viewer_ID = '$Job_Viewer_ID'");

$ret1 = Array();
$ret2 = Array();

if ($result2->num_rows > 0) {
	while ($row = $result2->fetch_assoc()) {
		$ret2[] = $row["Job_ID"];
	}
}

if ($result1->num_rows > 0) {
	while ($row = $result1->fetch_assoc()) {
		if (in_array($row["Job_ID"], $ret2))
			$row["exist"] = true;
		else
			$row["exist"] = false;
		if ($companyName != "" && strpos($row["Company_Name"], $companyName) === false)
			continue;
		if ($row["Salary"] < $minSalary)
			continue;
		$ret1[] = $row;
	}
}

echo json_encode($ret1);