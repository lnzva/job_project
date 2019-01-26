<?php
session_start();
if (!isset($_SESSION['ID'])) {
	header("Location: login_prompt.php");
	exit;
}
$conn = mysqli_connect('localhost', 'root', '', 'job_recruitment');
$sql = "SELECT * FROM Job_Posting";
$result = $conn->query($sql);
$Job_Title = Array();
$Job_ID = Array();
$Min_Quali = Array();
$Deadline = Array();
$Salary = Array();
$Exam_Date_Time = Array();
$Job_Recruiter_ID = Array();
$Job_Applied = Array();
$Job_Viewer_ID = $_SESSION["ID"];

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$Job_Title[] = $row["Job_Title"];
		$Job_ID[] = $row["Job_ID"];
		$Min_Quali[] = $row["Min_Quali"];
		$Deadline[] = $row["Deadline"];
		$Salary[] = $row["Salary"];
		$Exam_Date_Time[] = $row["Exam_Date_Time"];
		$Job_Recruiter_ID[] = $row["Job_Recruiter_ID"];
	}
}

for ($i = 0; $i < sizeof($Job_ID); $i++) {
	$tmp = $Job_ID[$i];
	$sql = "SELECT * FROM Applies_For WHERE Job_Viewer_Id = '$Job_Viewer_ID' AND Job_ID = '$tmp'";
	$result = $conn->query($sql);
	if ($result->num_rows == 0)
		$Job_Applied[$i] = false;
	else
		$Job_Applied[$i] = true;
}
//$Job_ID_Bak = $Job_ID;
//$Job_Title = json_encode($Job_Title);
//$Min_Quali = json_encode($Min_Quali);
//$Deadline = json_encode($Deadline);
//$Salary = json_encode($Salary);blackc
//$Exam_Date_Time = json_encode($Exam_Date_Time);
//$Job_Recruiter_ID = json_encode($Job_Recruiter_ID);
?>
<html>
<head>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css?family=Raleway:100,200, 300,400,600');
		@import url('https://fonts.googleapis.com/css?family=Roboto:300');
		body {
			background-color: black;
		}
		#FormFields {
			margin-left: 20px;
			top: 100px;
			height: 500px;
			overflow-y: scroll;
			margin-top: 80px;
			text-align: center;
			font-family: 'Raleway', sans-serif;
			font-weight: 400;
			font-size: 20;
			color: white;
		}
		#topbar {
			top: 0;
			width: 100%;
			font-family: 'Raleway', sans-serif;
			font-weight: 100;
			font-size: 40px;
			color: white;
			position: fixed;
		}
		#Apply {
			margin-left: 277px;
			text-align: center;
		}
		.Navi {
			text-align: left;
			cursor: pointer;
			color: white;
			text-decoration: none;
		}
		a {
			text-decoration: none;
		}
		.Navi:hover {
			font-weight: 200;
		}
		::-webkit-scrollbar {
			width: 0px;
			background: blue;
		}
		input[type="checkbox"] {

		}
	</style>
</head>
<body>
	<div id = "topbar">
		<a href="Job_Viewer_home.php"> <span class = "Navi">Home</span></a> 
		<a href="Job_Viewer_search.php"> <span class = "Navi">Search</span></a> 
		<span id = "Apply">Apply To Job</span>
	</div>
	<div id="FormFields"></div>

	<script type="text/javascript">

		var Job_Title = <?php echo json_encode($Job_Title); ?>;
		var Min_Quali = <?php echo json_encode($Min_Quali); ?>;
		var Deadline = <?php echo json_encode($Deadline); ?>;
		var Salary = <?php echo json_encode($Salary); ?>;
		var Exam_Date_Time = <?php echo json_encode($Exam_Date_Time); ?>;
		var Job_ID = <?php echo json_encode($Job_ID); ?>;
		var Job_Applied = <?php echo json_encode($Job_Applied); ?>;
		var Job_Viewer_ID = <?php echo json_encode($Job_Viewer_ID); ?>;
		(function buildFormFields() {
			var container = document.getElementById('FormFields'), item, field, i;
			container.innerHTML = '';

			var education = ["Primary School", "Secondary School", "High School", "Bachelor's Degree", "Master's Degree", "PhD"];

			var applied = false;

			for (i = 0; i < Job_Title.length; ++i) {
				cur = i;
				item = document.createElement('div');
				//item.id = "Form";

				field = document.createElement('span');
				field.innerHTML = 'Job Title: ' + Job_Title[i] + "<br>";
				item.appendChild(field);

				field = document.createElement('span');
				field.innerHTML = 'Minimum Qualification: ' + education[Min_Quali[i]] + "<br>";
				item.appendChild(field);

				field = document.createElement('span');
				field.innerHTML = 'Deadline: ' + Deadline[i] + "<br>";
				item.appendChild(field);

				field = document.createElement('span');
				field.innerHTML = 'Salary: ' + Salary[i] + "<br>";
				item.appendChild(field);

				field = document.createElement('span');
				field.innerHTML = 'Exam Date Time: ' + Exam_Date_Time[i] + "<br>";
				item.appendChild(field);
				field = document.createElement('input');
				field.type = 'checkbox';
				field.id = i;
				if (Job_Applied[i] == true)
					field.checked = "checked";
				field.onclick = function() {
					alert(this.id);
					var data = new FormData();
					data.append('Job_ID', Job_ID[this.id]);
					Job_Applied[field.id] = 1 ^ Job_Applied[field.id];
					var xhttp = new XMLHttpRequest();
					var querypage = "apply_toggle.php";
					xhttp.onreadystatechange = function() {
						if (xhttp.readyState == 4 && xhttp.status == 200) {
							var resp = xhttp.responseText;
							alert(resp);
						}
					}
					xhttp.open("POST", querypage, true);
					xhttp.send(data);
				}
				item.appendChild(field);
				/*
				if (Job_Applied[i] == true) {
					field = document.createElement('input');
					field.type = 'radio';
					field.name = 'Apply[' + i + ']';
					field.value = "Applied"
					field.id = "Apply";
					field.checked = "checked";
					item.appendChild(field);
					field = document.createElement('input');
					field.type = 'radio';
					field.name = 'Apply[' + i + ']';
					field.value = "Not_Applied";
					field.id = "Do not apply";
					item.appendChild(field);
				}
				else {
					field = document.createElement('input');
					field.type = 'radio';
					field.name = 'Apply[' + i + ']';
					field.value = "Applied";
					field.id = "Apply";
					item.appendChild(field);
					field = document.createElement('input');
					field.type = 'radio';
					field.name = 'Apply[' + i + ']';
					field.value = "Not_Applied";
					field.id = "Do not apply";
					field.checked = "checked";
					item.appendChild(field);
				}
				*/
				container.appendChild(item);
			}
		})();
	</script>


</body>
</html>