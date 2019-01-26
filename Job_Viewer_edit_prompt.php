<?php
session_start();
if (!isset($_SESSION["ID"])) {
	header("Location: login_prompt.php");
	exit;
}
?>
<html>
<body>
	<form action = "Job_Viewer_edit.php" method = "post">
		New Name: <input type="text" name = "Name"><br>
		New Email: <input type="text" name = "Email"><br>
		New Address: <input type="text" name = "Address"><br>
		Old Password: <input type="password" name = "OldPassword"><br>
		New Password: <input type="password" name = "NewPassword"><br>
		<input type = "submit">
	</form>
</body>
</html>