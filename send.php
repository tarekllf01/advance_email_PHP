<?php
/*
session_start();
if(!isset($_SESSION["userloggedin"] && $_SESSION["userloggedin"] !="userpre")){
	header("Location:index.php");
	die("NOT HAVE PERMISSION ");
}
*/
$con=mysqli_connect("localhost","root","","mymailer");
$host="mail.deshomati.com"; // used as $mail->host
$username="test@deshomati.com"; // used as $mail->Username
$password="tarekhossen4415";  // Used as Password
$reply_to="info@diu.edu.bd"; // used as $mail->addReplyTo();
$reply_to_name="DIU";  // used as $mail->addReplyTo();
$email_from="info@diu.edu.bd";
$email_from_name="DIU";
if(isset($_POST["send"])){
$email_to=mysqli_real_escape_string($con,$_POST["to"]);
$email_subject=mysqli_real_escape_string($con,$_POST["subject"]);;
$message=mysqli_real_escape_string($con,$_POST["message"]);
if($_FILES["attachment"]["name"] !="" && $_FILES["attachment"]["size"] < 500000 ){
	$temp=$_FILES["attachment"]["tmp_name"];
	$attachment_size=$_FILES["attachment"]["size"];
	$attachment=$_FILES["attachment"]["name"];
	$type=explode(".",$attachment);
	$type=end($type);
	$type=strtolower($type);
	if($type =="png" or $type =="jpg" or $type =="jpeg" or $type =="txt" or $type =="pdf" or $type =="doc" or $type =="docx" or $type =="gif" ){
		$attachment="uploads/".$attachment;
	}
else{	
	unlink($temp);
	$attachment_size=0;
	$attachment="";
}
	
}
$cc=mysqli_real_escape_string($con,$_POST["cc"]);
$bcc=mysqli_real_escape_string($con,$_POST["bcc"]);

require("mailer.php");
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title> Manual mailing server </title>
	<link rel="favicon" href="" />
	<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css" />
	<script src="plugins/jquery/jquery.min.js"></script>
	<style type="text/css" media="screen">
  
    @media only screen and (max-width : 768px) {
		#sidebar{display:none;}
		
    }
	 @media only screen and (min-width : 768px) {
		 #toggle{display:none;}
    }
	

	</style>
</head>
<body>
<div  id="toggle" style="width:100%;background:black;">

<a type="button" onclick="show()" class="btn"> <span><i class="fa fa-bars fa-2x"></i></span></a>
</div>
<div class="col-md-12 col-sm-12 " id="head" style="margin-bottom:20px;"><center>
<img src="uploads/banner.jpg"  width="100%" style="max-height:300px;"/></center>
</div>

<div class="col-md-12 col-sm-12">
<div id="sidebar" class="col-md-4 col-sm-12"  style="padding-left:30px;" >  <!-- starting  side bar -->
<div class="col-md-12 col-sm-12" style="background:blue;color:white;padding:10px; margin-bottom:10px;text-align:center;" >
<span > Side Menue </span>
</div>
<a type="button" class="form-control btn btn-success " href="send.php"><i class="fa fa-home"></i> Home </a><br>
<a type="button" class="form-control btn btn-success" href="update.php"><i class="fa fa-edit"></i> Update v2 </a><br>
<a type="button" class="form-control btn btn-success" href="signout.php"><i class="fa fa-power-off"></i> Sign Out  </a> <br>

<span><i class="fa fa-user"></i>  From : ITLandBD </span><br>
<span><i class="fa fa-envelope"> </i>  Mail: custom_mail </span><br>
<span><i class="fa fa-inbox"> </i> receives : receive mail  </span><br>
<span><i class="fa fa-user-o"> </i> receiver: ITLandBD </span><br>

<span><i class="fa fa-info-circle fa-3x"> </i><br><u>Mailer  Information </u></span><br>
<span><i class="fa fa-envelope "> </i> Account : ITLandBD </span><br>
<span><i class="fa fa-server "> </i> Host : mail.tarek.com </span><br>
<span><i class="fa fa-puzzle-piece "> </i>  Version : v2 </span><br>
</div>	 <!-- ending side bar -->
<div class="col-md-8 col-sm-12 ">  <!-- Starting  body  -->
<div class="col-md-12 col-sm-12" style="background:blue;color:white;padding:10px; margin-bottom:10px;text-align:center;" >
<span  > Mailing form </span>
</div>
<form action="send.php" method="post" enctype="multipart/form-data" >
<div class="form-group"><label for="to" >To :</label>
<input class="form-control" type="email" name="to" required="required" />
</div>
<div class="form-group"><label for="subject" >Subject :</label>
<input class="form-control" type="text" name="subject"  required="required" />
</div>
<div class="form-group"><label for="cc" >CC:</label>
<input class="form-control" type="email" name="cc"  />
</div>
<div class="form-group"><label for="bcc" >BCC:</label>
<input class="form-control" type="email" name="bcc"  />
</div>
<div class="form-group"><label for="message" >Message :</label>
<textarea class="form-control" name="message" numrows="5"  required="required" > </textarea>
</div>
<div class="form-group"><label for="attachment" >Attachment:</label>
<input class="form-control" type="file" name="attachment"  />
</div>
<div class="form-group">
<button class=" btn btn-primary form-control" type="submit" name="send"> Send  </button>
</div>

</form>
</div>	<!-- ending Body  -->
</div>
<script type="text/javascript">
function show(){
	
	$("#sidebar").slideToggle();
}
</script>
</body>
</html>
