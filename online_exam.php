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

?>

<html>
<head>
	
</head>

<body>

	<script type="text/javascript">
		
		var data = <?php echo json_encode($ret) ?>;
		var remain_time;

		function startTimer() {
			setInterval(function() {
				--remain_time;
				document.getElementById("Timer").innerHTML = remain_time;
			}, 1000);
		}

		function validateForm() {
			alert('L');
			if (remain_time < 0) {
				alert("Cannot submit, Time expired");
				return false;
			}
			return true;
		}

		window.onload = function BuildInformation() {
			var fdata = new FormData();
			fdata.append('Job_ID', 44);
			alert(fdata);
			var xhttp = new XMLHttpRequest();
			var querypage = "exam_time_set.php";
			xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
					remain_time = xhttp.responseText;
					alert(remain_time);
					document.getElementById("Timer").innerHTML = remain_time;
				}
			}
			startTimer();
			xhttp.open("POST", querypage, true);
			xhttp.send(fdata);
			var container = document.getElementById("Information");
			var field, item, i;

			for (i = 0; i < data.length; ++i) {
				item = document.createElement("div");

				field = document.createElement("span");
				field.innerHTML = i + 1 + ". " + data[i]["Question"] + "<br>";
				item.appendChild(field);

				field = document.createElement("input");
				field.type = "radio";
				field.id = "Option1[" + i + "]";
				field.name = "Answer[" + i + "]";
				field.value = "1";
				item.appendChild(field);

				field = document.createElement('label');
				field.htmlFor = "Option1[" + i + "]";
				field.innerHTML = data[i]["Option1"];
				item.appendChild(field);

				field = document.createElement('input');
				field.type = 'radio';
				field.id = 'Option2[' + i + ']';
				field.name = 'Answer[' + i + ']';
				field.value = "2";
				item.appendChild(field);

				field = document.createElement('label');
				field.htmlFor = "Option2[" + i + "]";
				field.innerHTML = data[i]["Option2"];
				item.appendChild(field);

				field = document.createElement('input');
				field.type = 'radio';
				field.id = 'Option3[' + i + ']';
				field.name = 'Answer[' + i + ']';
				field.value = "3";
				item.appendChild(field);

				field = document.createElement('label');
				field.htmlFor = "Option3[" + i + "]";
				field.innerHTML = data[i]["Option3"];
				item.appendChild(field);

				field = document.createElement('input');
				field.type = 'radio';
				field.id = 'Option4[' + i + ']';
				field.name = 'Answer[' + i + ']';
				field.value = "4";
				item.appendChild(field);

				field = document.createElement('label');
				field.htmlFor = "Option4[" + i + "]";
				field.innerHTML = data[i]["Option4"];
				item.appendChild(field);

				container.appendChild(item);
			}
		}

	</script>
	
	<div id = "topbar">
	</div>

	<div id = "Timer">
	</div>

	<form method = "post" action="online_exam_check.php" onsubmit="return validateForm()">
		<div id = "Information">
		</div>
		<input type="submit" name="submit">
	</form>

</body>