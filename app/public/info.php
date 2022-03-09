<?php

session_start();
error_reporting(E_ERROR);
if(!isset($_SESSION['username'])){
    header('Location: /login.php');
    exit();
}

require('../connect.php');

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $query = "SELECT fullName, introduce from users WHERE id=$id";

  try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $row = $pdo->query($query)->fetch(PDO::FETCH_NUM);
  } catch (PDOException $e) {
    echo 'Failed: ' . $e->getMessage(); // print out error
    exit;
  }
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<title>Introduce</title>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">devme4f</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="/">Home</a></li>
      <li><a href="/blank.php">Blank Page</a></li>
      <li class="active"><a href="/admin.php">Admin</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><h4>Hello <?php echo htmlentities($_SESSION['username'], ENT_QUOTES); ?></h4></li>
      <li class="active"><a href="/logout.php">Logout</a></li>
    </ul>
  </div>
</nav>

<div class="container">

<?php
  if(isset($row)){
  echo "<h1>" .$row[0]. " </h1>";
  echo "<br>";
  echo "<p>" .$row[1]. "</p>\n";
  }
?>
</div>
</body>
</html>