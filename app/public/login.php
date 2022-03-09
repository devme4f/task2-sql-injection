<?php
session_start();
include('../connect.php');

if(isset($_POST['submit'])){
    if(isset($_POST['user']) && isset($_POST['pass'])) {
        // prepare->get_result(): mysqlnd configuration :(
        $username = $_POST['user'];
        $password = $_POST['pass'];
        
        $success = 1;
        $query = "SELECT username FROM users WHERE username=:username AND password=:password";
        try{
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            
            $stmt->execute();
          } catch (PDOException $e) {
            $success = 0;
            $msg = 'Some error has occurred!';
        }
        $row = $stmt->fetch(); // return false if none row return!
        
        if($row){
            $_SESSION['username'] = $username;
            header('Location: /index.php');
            exit();
        }
        else if($success){
            $success = 0;
            $msg = 'Username or Password is incorrect, please try again!';
        }
    }
    else{
        $success = 0;
        $msg = 'Missing parameter';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style>
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">devme4f</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="/">Home</a></li>
      <li class="active"><a href="/register.php">Register</a></li>
    </ul>
  </div>
</nav>

<?php if(isset($success)){
    if($success){
        echo "
        <div class='alert alert-success'>
          <strong>Success!: </strong> $msg.
        </div>";
        }
    else{
        echo "
            <div class='alert alert-danger'>
                <strong>Login failed: </strong> $msg.
            </div>";
    }
}
?>


<div class="login-form">
    <form method="post">
        <h2 class="text-center">Log in</h2>       
        <div class="form-group">
            <input type="text" name="user" class="form-control" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="password" name="pass" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
        <div class="clearfix">
            <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
            <a href="#" class="pull-right">Forgot Password?</a>
        </div>        
    </form>
    <p class="text-center"><a href="/register.php">Create an Account</a></p>
</div>
</body>
</html>