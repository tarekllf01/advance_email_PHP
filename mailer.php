<?php
date_default_timezone_set('Etc/UTC');
require ('phpmailer/PHPMailerAutoload.php');
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
//$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
//$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = $host;
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = $username;  //
//Password to use for SMTP authentication
$mail->Password = $password;   //
//Set an alternative reply-to address
$mail->addReplyTo($reply_to, $reply_to_name);  //
//Set who the message is to be sent from
$mail->setFrom($email_from, $email_from_name); // from 
//Set who the message is to be sent to
$mail->addAddress($email_to, ''); //
//Set the subject line
$mail->Subject = $email_subject;
if(isset($cc) && $cc!="" ){
	$mail->addCC($cc);
}
if(isset($bcc) && $bcc!="" ){
	$mail->addBCC($bcc);
}
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
$mail->msgHTML("".$message.""); //
//Replace the plain text body with one created manually
$mail->AltBody = $message;//

//Attach an image file
if($attachment_size > 0 && $attachment !=""){
$mail->addAttachment($attachment);
}

//send the message, check for errors
/*
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
*/
$count=0;
if($mail->send()){
//$mail->Timeout= 999;
echo "Send";
}else{
echo "Could not sent";
}