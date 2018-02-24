<?php
session_start();
$msg="";
if(isset($_SESSION["userloggedin"]) && $_SESSION["userloggedin"]== "userpre" ){
	header("Location:send.php");
}
else if(isset($_POST["login"])){
	$con=mysqli_connect("localhost","root","","mymailer");
	$email=mysqli_real_escape_string($con,$_POST["email"]);
	$type=(int)$_POST["type"];
	$password=md5($_POST["password"]);
	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$msg="INvalid email address! <br>";
}else if($type ==0 or $type=="" or $email=="" or $password="" ){
	$msg= "Enter all field correctly !<br>";
}
else{
	if($type==1)
	$query=mysqli_query($con,"SELECT * FROM user WHERE email='$email' AND password='$password' ");
	if(mysqli_num_rows($query) >0 ){
	$row=mysqli_fetch_assoc($query);
	}
	else{
		$msg= " Wrong Email or Password ! <br>";	
	}
}	
}
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title> Advanced mailing system </title>
	<link rel="favicon" href="" />
	<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css" />
	<style type="text/css" media="screen">
	body{background:black;padding-top:50px;}
    
    /* Small Devices, Tablets */
    @media only screen and (max-width : 768px) {
				body{background:white;padding-top:5px;}
    }

	</style>
</head>
<body style="color:white;">
<div class="col-md-4 col-md-offset-4 col-sm-12" style="background:white; color:black;padding:20px;">
<form action="index.php" method="post">

<center>
<div class="col-md-12 col-sm-12" style="background:blue;color:white;padding:10px;margin-top:10px; margin-bottom:10px;" >
<span  >Web Mailing System </span>
</div>
<span><i class="fa fa-user-circle-o fa-5x"></i></span>
</center>
 <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" name="email"  id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" name="password" id="pwd">
  </div>
  <div class="form-group">
  <select name="type" id="" class="form-control">
  <option value="0"> User Type </option>
  <option value="1">Registered User  </option>
  <option value="2"> Admin </option>
  </select>
  </div>
  <div class="col-md-12 col-sm-12" style="color:red;padding:10px;margin-top:10px; margin-bottom:10px;" >
<span  > <?php echo $msg; ?></span>
</div>
  <button type="submit" class="btn btn-primary" name="login"> Sign In</button>
</form>
</div>
	
</body>
</html>