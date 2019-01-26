<?php
session_start();
if (!isset($_SESSION["ID"])) {
	header("Location: login_prompt.php");
	exit;
}
$conn = mysqli_connect('localhost', 'root', '', 'job_recruitment');
if ($conn->connect_error)
	die("Connection failed: ". $conn->connect_error);
$user_ID = $_SESSION["ID"];
$result = $conn->query("SELECT Job_ID, Job_Title, Exam_Date_Time, Exam_Minute_Duration FROM (SELECT Job_Posting.Job_ID as Job_ID, Job_Posting.Job_Title as Job_Title, Job_Posting.Deadline as Deadline, Job_Posting.Exam_Date_Time as Exam_Date_Time, Applies_For.Job_Viewer_ID as Job_Viewer_ID, Job_Posting.Exam_Minute_Duration as Exam_Minute_Duration FROM Job_Posting INNER JOIN Applies_For ON Job_Posting.Job_ID = Applies_For.Job_ID) a WHERE Job_Viewer_ID = '$user_ID'");
$ret = Array();
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$ret[] = $row;
	}
}
?>

<html>
<body>
	<script type="text/javascript">
		var data = <?php echo json_encode($ret); ?>;
		window.onload = function BuildInformation() {
			alert(data[0]["Exam_Date_Time"]);
			var container = document.getElementById("Information");
			var item, field, i;
			var table = document.createElement('table');

			item = document.createElement("tr");
			field = document.createElement("th");
			field.innerHTML = "Job Title";
			item.appendChild(field);
			field = document.createElement("th");
			field.innerHTML = "Exam Date & Time";
			item.appendChild(field);

			container.appendChild(item);

			for (i = 0; i < data.length; ++i) {
				item = document.createElement("tr");

				field = document.createElement("td");
				field.innerHTML = data[i]["Job_Title"];
				item.appendChild(field);

				field = document.createElement("td");
				field.innerHTML = data[i]["Exam_Date_Time"];
				item.appendChild(field);

				field = document.createElement("td");
				var field2 = document.createElement("input");
				field2.type = "submit";
				field2.id = i;

				field2.onclick = function() {
					var fdata = new FormData();
					alert(data[this.id]);
					fdata.append('Deadline', data[this.id]["Exam_Date_Time"]);
					fdata.append('Exam_Minute_Duration', data[this.id]["Exam_Minute_Duration"]);
					var xhttp = new XMLHttpRequest();
					var querypage = "check_deadline.php";
					xhttp.onreadystatechange = function() {
						if (xhttp.readyState == 4 && xhttp.status == 200) {
							var resp = xhttp.responseText;
							alert(resp);
							if (resp == "yes") {
								window.location.replace("online_exam.php");
							}
							else {
								alert("Not available");
							}
						}
					}
					xhttp.open("POST", querypage, true);
					xhttp.send(fdata);
				}
				field.appendChild(field2);
				item.appendChild(field);

				container.appendChild(item);
			}
		}	
	</script>

	<?php print_r($ret) ?>

	<div id = "topbar">
		<a href = Job_Viewer_home.php> <span id = "Home">Home</span> </a>&nbsp;  
		<span id = "Edit">Edit</span>&nbsp;
		<span id = "Search">Search</span>&nbsp;
		<span id = "Applied_Jobs">Applied Jobs</span>  
	</div>

	<div id = "Information">
	</div>

</body>
