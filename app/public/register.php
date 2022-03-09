<?php

require('../connect.php');


if(isset($_POST['submit'])){
	if(isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['confirmPass']) && $_POST['firstName'] && $_POST['lastName']){

		// TODO: 
		// include functions.php -> sanitize user input
		// hash password before store in database
		$fullName = $_POST['firstName'] . ' ' . $_POST['lastName'];;
		$username = $_POST['user'];
		$password = $_POST['pass'];
		$confirmPass = $_POST['confirmPass'];
		$role = 'unset';
		$introduce = 'new user';
		$status = 1;

		$success = 1;

		if($password !== $confirmPass){
			$success = 0;
			$msg = 'Confirm password does not match!';
		}

		# safe query with prepare;
		if($success){
			$row = $pdo->query("SELECT username FROM users")->fetchAll(PDO::FETCH_NUM);
			if(in_array($username, $row[0])){
				$success = 0;
				$msg = 'Username already exist!!';
			}
		}

		if($success){
			$query = "INSERT INTO users (fullName, username, password, role, introduce, status) VALUES (:fullName, :username, :password, :role, :introduce, :status)";
			try {
				$stmt = $pdo->prepare($query);

				$stmt->bindParam(":fullName", $fullName);
				$stmt->bindParam(":username", $username);
				$stmt->bindParam(":password", $password);
				$stmt->bindParam(":role", $role);
				$stmt->bindParam(":introduce", $introduce);
				$stmt->bindParam(":status", $status);
				$success = $stmt->execute();
			} catch (PDOException){
				$success = 0;
				$msg = 'Some error has occurred!';
			}

			if($success){
				$msg = 'Successfully created account!';
				header('Location: /login.php');
			}
			else {
				$msg = 'Some error has occurred';
			}
		}
	}
	else {
		$success = 0;
		$msg = 'Missing parameter!';
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<title>Bootstrap Simple Registration Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style>
	body {
		color: #fff;
		/*background: #63738a;*/
		font-family: 'Roboto', sans-serif;
	}
    .form-control{
		height: 40px;
		box-shadow: none;
		color: #969fa4;
	}
	.form-control:focus{
		border-color: #5cb85c;
	}
    .form-control, .btn{        
        border-radius: 3px;
    }
	.signup-form{
		width: 400px;
		margin: 0 auto;
		padding: 30px 0;
	}
	.signup-form h2{
		color: #636363;
        margin: 0 0 15px;
		position: relative;
		text-align: center;
    }
	.signup-form h2:before, .signup-form h2:after{
		content: "";
		height: 2px;
		width: 30%;
		background: #d4d4d4;
		position: absolute;
		top: 50%;
		z-index: 2;
	}	
	.signup-form h2:before{
		left: 0;
	}
	.signup-form h2:after{
		right: 0;
	}
    .signup-form .hint-text{
		color: #999;
		margin-bottom: 30px;
		text-align: center;
	}
    .signup-form form{
		color: #999;
		border-radius: 3px;
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
	.signup-form .form-group{
		margin-bottom: 20px;
	}
	.signup-form input[type="checkbox"]{
		margin-top: 3px;
	}
	.signup-form .btn{        
        font-size: 16px;
        font-weight: bold;		
		min-width: 140px;
        outline: none !important;
    }
	.signup-form .row div:first-child{
		padding-right: 10px;
	}
	.signup-form .row div:last-child{
		padding-left: 10px;
	}    	
    .signup-form a{
		color: #fff;
		text-decoration: underline;
	}
    .signup-form a:hover{
		text-decoration: none;
	}
	.signup-form form a{
		color: #5cb85c;
		text-decoration: none;
	}	
	.signup-form form a:hover{
		text-decoration: underline;
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
      <li class="active"><a href="/login.php">Login</a></li>
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
    		<strong>Failed: </strong> $msg.
		</div>";
	}
}
?>

<div class="signup-form">
    <form method="post">
		<h2>Register</h2>
        <div class="form-group">
			<div class="row">
				<div class="col-xs-6"><input type="text" class="form-control" name="firstName" placeholder="First Name" required="required"></div>
				<div class="col-xs-6"><input type="text" class="form-control" name="lastName" placeholder="Last Name" required="required"></div>
			</div>        	
        </div>
        <div class="form-group">
        	<input type="text" class="form-control" name="user" placeholder="Username" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="pass" placeholder="Password" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="confirmPass" placeholder="Confirm Password" required="required">
        </div>        
        <div class="form-group">
			<label class="checkbox-inline"><input type="checkbox"> I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a></label>
		</div>
		<div class="form-group">
            <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>
    </form>
</div>
	<p class="text-center"><a href="/login.php">Already have an account, Login</a></p>
</body>
</html>