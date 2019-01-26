<?php
session_start();
if (isset($_SESSION["BadOldPassword"])) {
	echo "Please enter the correct old password.<br>";
}
if (isset($_SESSION["BadEmailFormat"])) {
	echo "Wrong email format.<br>";
}
$prev_page = $_SESSION['PrevPage'];
echo '<form action = "$prev_page" method = "post">
		<input type = "submit">
	</form>';
?>
<html>
<body>
	<form action = 'Job_Viewer_edit.php' method = "post">
		<input type = "submit">
	</form>
</body>
</html>