<?php
session_start();
if (!isset($_SESSION["ID"])) {
	header("Location: login_prompt.php");
	exit;
}
$Job_Viewer_ID = $_SESSION['ID'];
?>

<html>
<head>
	
</head>

<body>

	<script type="text/javascript">
		function BuildFormField() {
			Job_Viewer_ID = <?php echo json_encode($Job_Viewer_ID); ?>;
			var companyName = document.getElementById("companyName").value;
			var minSalary = document.getElementById("minSalary").value;
			var job_posting;
			if (minSalary == "")
				minSalary = "-1";
			data = new FormData();
			data.append('companyName', companyName);
			data.append('minSalary', minSalary);
			data.append('Job_Viewer_ID', Job_Viewer_ID);
			var xhttp = new XMLHttpRequest();
			var querypage = "search_job_viewer_load.php";
			xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
					job_posting = xhttp.responseText;
					console.log(job_posting);
					job_posting = JSON.parse(job_posting);
					console.log(job_posting);
					document.getElementById("FormField").innerHTML = "";
					var container = document.getElementById("FormField");
					var item, field, i;
					var table = document.createElement("table");
					table.border = 1;

					for (i = 0; i < job_posting.length; ++i) {
						item = document.createElement("tr");
						field = document.createElement("td");
						field.innerHTML = job_posting[i]["Job_Title"];
						item.appendChild(field);

						field = document.createElement("td");
						field.innerHTML = job_posting[i]["Job_Title"];
						item.appendChild(field);

						field = document.createElement("td");
						field.innerHTML = job_posting[i]["Min_Quali"];
						item.appendChild(field);

						field = document.createElement("td");
						field.innerHTML = job_posting[i]["Deadline"];
						item.appendChild(field);

						field = document.createElement("td");
						field.innerHTML = job_posting[i]["Salary"];
						item.appendChild(field);

						field = document.createElement("td");
						field.innerHTML = job_posting[i]["Description"];
						item.appendChild(field);

						field = document.createElement("td");
						field.innerHTML = job_posting[i]["Exam_Minute_Duration"];
						item.appendChild(field);

						field = document.createElement("td");
						field2 = document.createElement("input");
						field2.type = "checkbox";
						field2.id = i;
						if (job_posting[i]["exist"] == true)
							field2.checked = "checked";
						field2.onclick = function() {
							data = new FormData();
							data.append('Job_ID', job_posting[this.id]['Job_ID']);
							job_posting[this.id]["exist"] = 1 ^ job_posting[this.id]["exist"];
							alert(job_posting[this.id]['Job_ID']);
							xhttp = new XMLHttpRequest();
							querypage = "apply_toggle.php";
							xhttp.onreadystatechange = function() {
								if (xhttp.readyState == 4 && xhttp.status == 200) {
									var resp = xhttp.responseText;
									alert(resp);
								}
							}
							xhttp.open("POST", querypage, true);
							xhttp.send(data);
						}
						field.appendChild(field2);
						item.appendChild(field);

						table.appendChild(item);
					}

					container.appendChild(table);
				}
			}
			xhttp.open("POST", querypage, true);
			xhttp.send(data);
		}
		window.onload = BuildFormField;
	</script>
	
	<div id = "topbar">
	</div>

	<div id = "input">
		Search By Company:<br>
		<input type = "text" id = "companyName" onkeyup="BuildFormField()"><br>
		Minimum Salary:<br>
		<input type = "text" id = "minSalary" onkeyup="BuildFormField()">
	</div>

	<div id = "FormField">
	</div>

</body>