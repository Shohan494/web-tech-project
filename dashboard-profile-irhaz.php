<?php

// check for user role/type and then show available options


// code from irhaz

session_start();

if($_SESSION["page"] === "RPLO"){
if ($_SERVER['REQUEST_METHOD'] === "POST")
{
if (empty($_POST['fname']))
 {
	$_SESSION['msg'] = "fill out first name";
	header("Location: RPLO.php");
 }
if (empty($_POST['Email'])) 
 {
	$_SESSION['msg7'] = "fill out email";
	header("Location: RPLO.php");
 }
if (empty($_POST['Username']))
 {
 	$_SESSION['msg11'] = "fill out Username";
	header("Location: RPLO.php");
 }
if (empty($_POST['Password']))
 {
 	$_SESSION['msg12'] = "fill out Password";
	header("Location: RPLO.php");
 }
}
}elseif($_SESSION["page"] === "login"){
if ($_SERVER['REQUEST_METHOD'] === "POST"){
if (empty($_POST['Username']))
 {
 	$_SESSION['msg11'] = "fill out Username";
	header("Location: Login1.php");
 }
if (empty($_POST['Password']))
 {
 	$_SESSION['msg12'] = "fill out Password";
	header("Location: Login1.php");
 }
}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>page title</title>
</head>
<body>
	<form action="Profile.php" method = "POST" novalidate>
		
			<h1>Profile Page</h1>
		<table>	
			<td>
		<fieldset style="width:200px">
			<legend>
			General Information:
		</legend>
		<br><br>
		<b>Email :</b> <label><?php if (isset($_POST['Email'])) {echo $_POST['Email'];} ?></label>
		<br><br>
		<b>First Name :</b> <label><?php if (isset($_POST['fname'])) {echo $_POST['fname'];} ?></label>
		<br><br>
		<b>Username :</b> <label><?php if (isset($_POST['Username'])) {echo $_POST['Username'];} ?></label>
		<br><br>
		<b>Password :</b> <label><?php if (isset($_POST['Password'])) {echo $_POST['Password'];} ?></label>
		<br><br>

		</fieldset>
	</td>
	<br>
	<td>
		
	</td>
	</table>
	
	<a href="Logout.php"><button name="logout" value = "logout">Logout</button></a>
	
</form>