<?php
session_start();
error_reporting(E_ERROR);

if (!isset($_SESSION['username'])){
	header('Location: /login.php');
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
	<title>Find employee</title>
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
    <?php 
          echo "<li><h4>Hello " . htmlentities($_SESSION['username'], ENT_QUOTES) . "</h4></li>"
    ?>
      <li class="active"><a href="/logout.php">Logout</a></li>
    </ul>
  </div>
</nav>
<h3>
<?php
  if($_SESSION['username'] !== 'admin'){
    echo "You're not admin!";
  }
  else{
    echo "Here's is your flag: 🇻🇳";
  }
?>
</h3>
<script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>
</body>
</html>