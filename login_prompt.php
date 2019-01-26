<?php
session_start();
if (isset($_SESSION['ID'])) {
	if ($_SESSION['user_type'] == 'Job_Viewer')
		header("Location: Job_Viewer_home.php");
	else
		header("Location: Job_Recruiter_home.php");
	exit;
}
?>
<html>
<head>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,600');
		@import url('https://fonts.googleapis.com/css?family=Roboto:300');
		body {
			background-color: black;
		}
		#inputForm {
			margin-top: 100px;
			text-align: center;
			color: white;
			font-family: 'Raleway', sans-serif;
			font-weight: 100;
			font-size: 20;
		}
		#Title {
			margin-top: 200px;
			margin-left: 0px;
			text-align: center;
			font-family: 'Raleway', sans-serif;
			font-weight: 100;
			font-size: 50;
			color: white;
		}
		#Submit {
			margin-top: 20px;
			position: relative;
			padding: 10px 10px;
			border-radius: 5px;
			background: black;
			color: white;
			font-family: 'Roboto', sans-serif;
		}
		#Submit:hover {
			background: linear-gradient(black, grey);
		}
		input[type="text"] {
			margin-left: 40px;
			font-family: 'Raleway', sans-serif;
			font-weight: 400;
			font-size: 15;
		}
		input[type="password"] {
			margin-left: 5px;
			font-family: 'Raleway', sans-serif;
			font-weight: 400;
			font-size: 15;
		}
		#Job_Viewer {
			text-align: center;
			margin-top: 20px;
		}
	</style>
</head>	
<body>
	<script type="text/javascript">
		function validateEmail(emailField) {
	        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	        if (reg.test(emailField.value) == false) {
	            alert('Invalid Email Address');
	            return false;
	        }
	        return true;
		}
		function validateForm() {
			var email = document.forms["inputform"]["email"].value;
			//if (!validateEmail(email))
				//return false;
			var psw = document.forms["inputform"]["psw"].value;
			var type;
			if (document.getElementById('Job_Viewer').checked)
				type = "Job_Viewer";
			else if (document.getElementById('ob_Viewer_home.phpJob_Recruiter').checked)
				type = "Job_Recruiter";
			else {
				alert("Please check type of user");
				return false;
			}
			var data = new FormData();
			data.append('email', email);
			data.append('psw', psw);
			data.append('userType', type);
			console.log(data);
			var xhttp = new XMLHttpRequest();
			var querypage = "is_user_exist.php";
			var ret = true;
			xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
					var resp = xhttp.responseText;
					alert(resp);
					if (resp == 'no') {
						alert("Check email and/or password.");
						ret = false;
					}
					else {
						window.location.href(resp);
						return false;
					}
				}
			}
			xhttp.open("POST", querypage, true);
			xhttp.send(data);
			return ret;
		}
	</script>
	<div id = "Title">
		Login Page
	</div>
	<div id = "inputForm">
		<form name = "inputform" method = "post" action = "login.php" onsubmit="return validateForm()">
			Email:<input type="text" name = "email"><br>
			Password:<input type="password" name = "psw" id = "lol"><br>
			<input type = "radio" name = "userType" id = "Job_Viewer" value = "Job_Viewer"/>
			<label for = "Job_Viewer">Job Viewer</label>
			<input type = "radio" name = "userType" id = "Job_Recruiter" value = "Job_Recruiter"/>
			<label for = "Job_Recruiter"> Job Recruiter</label> <br>
			<input type="submit" id = "Submit">
		</form>
	</div>
</body>
</html>