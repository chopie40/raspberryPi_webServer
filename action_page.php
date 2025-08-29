<!DOCTYPE html>
<html>
<head>
	<style>
		.error {
			color: red;
	}
	</style>
</head>

<body>

<?php

// define variables and set to empty values
$fname = $lname = $email = $tel = $comment = "";
$fnameErr = $lnameErr = $emailErr = $telErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["fname"])) {
		$fnameErr = "Prénom requit";
	}
	else {
		$fname = test_input($_POST["fname"]);
		/* check if fname only contains letters ans whitespaces */
		if (!preg_match("/^[A-Za-z-' ]*$/", $fname)) {
			$fnameErr ="Caractères incompatibles entrés";
		}
	}
	if (empty($_POST["lname"])) {
		$lnameErr ="Nom requis.";
	}
	else {
		$lname = test_input($_POST["lname"]);
		if (!preg_match("/^[A-Za-z-' ]*$/", $lname)) {
			$lnameErr ="Caractères incompatibles entrés";
		}
	}
	if (empty($_POST["email"])) {
		$emailErr = "Le courriel est requis";
	}
	else {
		$email = test_input($_POST["email"]);
		/* Check the email format */
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Format invalide!";
		}
	}
	if (empty($_POST["tel"])) {
		$tel = "";
	}
	else {
		$tel = test_input($_POST["tel"]);
		if (!preg_match("/[0-9]{3}-[0-9]{3}-[0-9]{4}/", $tel)) {
			$telErr = "Format invalide!";
		}
	}
	if (empty($_POST["comment"])) {
		$comment = "";
	}
	else {
		$comment = test_input($_POST["comment"]);
	}
}

/* Parser */
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>

<?php
echo "<h2>Your Input:</h2>";
echo $fname;
echo "<br>";
echo $lname;
echo "<br>";
echo $email;
echo "<br>";
echo $tel;
echo "<br>";
echo $comment;
?>

</body>

</html>