<?php

error_reporting(E_ERROR);
require('../connect.php');

if(isset($_GET['id'])){
	$id = $_GET['id'];
	try {
		$query = "SELECT id FROM users WHERE id=$id";
		$row = ($pdo->query($query))->fetch(PDO::FETCH_NUM);
	} catch (PDOException) {
		// pass
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blank Page</title>
</head>
<body>
<p>Just a boring blank page for you to staring at.</p>

<button onclick="showParam()">click</button>
</body>
</html>
<script>
	function showParam(){
		const urlParams = new URLSearchParams(window.location.search);
		urlParams.set('id', 1);
		window.location.search = urlParams;
	}
</script>