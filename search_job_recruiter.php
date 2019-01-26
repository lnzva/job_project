<?php
session_start();
if (!isset($_SESSION["ID"])) {
	header("Location: login_prompt.php");
	exit;
}
?>

<html>
<head>
	
</head>

<body>

	<script type="text/javascript">	
		function BuildFormField() {
			var min_education_level = document.getElementById("min_education_level").value;
			var max_education_level = document.getElementById("max_education_level").value;
			var field = document.getElementById("field").value;
			var education = ["Primary School", "Secondary School", "High School", "Bachelor's Degree", "Master's Degree", "PhD"];
			var fieldVal = ["Computer Science", "Electrical Engineering", "Mechanical Engineering", "Civil Engineering", "URP"];
			var job_viewer;
			var data = new FormData();
			data.append('min_education_level', min_education_level);
			data.append('max_education_level', max_education_level);
			data.append('field', field);
			var xhttp = new XMLHttpRequest();
			var querypage = "search_job_recruiter_query.php";
			xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
					job_viewer = xhttp.responseText;
					job_viewer = JSON.parse(job_viewer);
					document.getElementById("FormField").innerHTML = "";
					var container = document.getElementById("FormField");
					var item, field, i;
					var table = document.createElement("table");
					table.border = 1;

					for (i = 0; i < job_viewer.length; ++i) {
						item = document.createElement("tr");
						field = document.createElement("td");
						field.innerHTML = job_viewer[i]["Name"];
						item.appendChild(field);

						field = document.createElement("td");
						field.innerHTML = job_viewer[i]["Email"];
						item.appendChild(field);

						field = document.createElement("td");
						field.innerHTML = job_viewer[i]["Address"];
						item.appendChild(field);

						field = document.createElement("td");
						field.innerHTML = education[job_viewer[i]["Education"]];
						item.appendChild(field);

						field = document.createElement("td");
						field.innerHTML = fieldVal[job_viewer[i]["Field"]];
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
		Field:<br>
		<select id = "field" onchange="BuildFormField()">
			<option value = "1">Computer Science</option>
			<option value = "2">Electrical Engineering</option>
			<option value = "3">Mechanical Engineering</option>
			<option value = "4">Civil Engineering</option>
			<option value = "5">URP</option>
		</select><br>
		Minimum Education Level:<br>
		<select id = "min_education_level" onchange="BuildFormField()">
			<option value = "1">School</option>
			<option value = "2">High School</option>
			<option value = "3">BSc</option>
			<option value = "4">MSc</option>
			<option value = "5">PhD</option>
		</select><br>
		Maximum Education Level:<br>
		<select id = "max_education_level" onchange="BuildFormField()">
			<option value = "1">School</option>
			<option value = "2">High School</option>
			<option value = "3">BSc</option>
			<option value = "4">MSc</option>
			<option value = "5">PhD</option>
		</select>
	</div>

	<div id = "FormField">
	</div>

</body>