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
$sql = "SELECT * FROM Job_Viewer WHERE Job_Viewer_ID = '$user_ID'";
$rslt = $conn->query($sql);
$row = $rslt->fetch_assoc();
?>
<html>
<head>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css?family=Raleway:100,200, 300,400,600');
		@import url('https://fonts.googleapis.com/css?family=Roboto:300');

		body {
			background-color: black;
		}
		#topbar {
			color: white;
			font-family: 'Raleway', sans-serif;
			font-size: 50;
			font-weight: 200;
		}
		#Information {
			margin-top: 50px;
			color: white;
			font-family: 'Raleway', sans-serif;
			font-size: 30;
			font-weight: 200;
		}
	</style>
</head>
<body>
	<script type="text/javascript">
		var Name = <?php echo json_encode($row["Name"]); ?>;
		var Email = <?php echo json_encode($row["Email"]); ?>;
		var Address = <?php echo json_encode($row["Address"]); ?>;
		var Education = <?php echo json_encode($row["Education"]); ?>;
		var education = ["Primary School", "Secondary School", "High School", "Bachelor's Degree", "Master's Degree", "PhD"];
		
		window.onload = function generateInformation() {
			alert(Name);
			document.getElementById("Name").innerHTML = Name;
			document.getElementById("Email").innerHTML = Email;
			document.getElementById("Address").innerHTML = Address;
			document.getElementById("Education").innerHTML = education[Education];
		};
	</script>
	
	<div id = "topbar">
		<a href = Job_Viewer_home.php> <span id = "Home">Home</span> </a>&nbsp;  
		<span id = "Edit">Edit</span>&nbsp;
		<span id = "Search">Search</span>&nbsp;
		<span id = "Applied_Jobs">Applied Jobs</span>  
	</div>

	<div id = "Information">
		Name: <span id = "Name"></span><br>
		Email: <span id= "Email"></span><br>
		Address: <span id = Address></span><br>
		Minimum Education Level: <span id = "Education"></span><br>
	</div>
</body>
</html>