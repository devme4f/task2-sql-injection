<?php

session_start();
// When you are sure your script is perfectly working, you can get rid of warning and notices like this
error_reporting(E_ERROR);
require('../connect.php');

if(!isset($_SESSION['username'])){
    header('Location: /login.php');
    exit();
}

if(isset($_GET['name'])){
    $name = $_GET['name'];

    $query = "SELECT id, fullName, role from users where fullName like '%$name%'";
    try {
        $row = $pdo->query($query)->fetchAll(PDO::FETCH_NUM); // mode positional key -> value
    } catch (PDOException){
        //
    }
    if(!$row){
        $msg = "Not found!";
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

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>Find employee</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Search by Name</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4" style="width:50%">
            <form method="GET">
            <input type="search" id="search" value="" name="name" class="form-control" placeholder="Ex: sam">
            </form>
            <?php if(isset($msg)) echo "<p style='color:red'>$msg</p>"; ?>
        </div>
        <br><br><br>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>role</th>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php 
                        if(isset($row)){
                            $results = '<tr>';
                            for($i = 0; $i<sizeof($row); $i++) {
                                foreach ($row[$i] as $key => $value) {
                                    if($key == 1){
                                    	$id = $row[$i][0];
                                        $results .= "<td><a href='/info.php?id=$id'>$value</a></td>";
                                    }
                                    else{
                                        $results .= "<td>$value</td>";
                                    }
                                }
                                echo $results . '</tr>';
                                $results = '<tr>';
                            }
                        }
                        ?>  
                </tbody>
            </table>
            <hr>
        </div>
    </div>
</div>
<script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>
</body>
</html>