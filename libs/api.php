<?php

// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
// PHPMailer End

// Send Email
function SendPHPMailer($parram){
	$data = false;

	$mail = new PHPMailer();
	
	$mail->isSMTP();                                            //Send using SMTP
	$mail->SMTPDebug  = SMTP::DEBUG_OFF; //SMTP::DEBUG_OFF; SMTP::DEBUG_CLIENT; SMTP::DEBUG_SERVER; SMTP::DEBUG_CONNECTION; SMTP::DEBUG_LOWLEVEL;
	$mail->Host       = 'pantau.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'noreply@pantau.com';                     //SMTP username
	$mail->Password   = 'BBn$nT#OmKB2';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
	$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	
	//Recipients
	$mail->setFrom('noreply@pantau.com', 'Pantau Dokumen');
	// $mail->addCC('adminevent@demokrat.or.id');
	$mail->addAddress($parram['kepada']);
	
	//Content
	$mail->isHTML(true);                                  //Set email format to HTML
	$mail->Subject = $parram['judul'];
	$mail->Body    = $parram['pesan'];

	if ($mail->send()) {
		$data = true;
	}
   return $data;
}
function SendMail($parram){
	$data = false;
	
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	
	// More headers
	$headers .= 'From: <noreply@pantau.com>' . "\r\n";
	$headers .= 'Cc: noreply@pantau.com' . "\r\n";
	$send = mail($parram['kepada'],$parram['judul'],$parram['pesan'],$headers);
	if ($send) {
		$data = true;
	}
}
function EmailTemplate($parram){
	$data = "
		<!DOCTYPE html>
		<html lang='en'>
		<head>
			<meta charset='UTF-8'>
			<meta http-equiv='X-UA-Compatible' content='IE=edge'>
			<meta name='viewport' content='width=device-width, initial-scale=1.0'>
			<title>".$parram['judul']."</title>
			<style>
				*{ transition: all 0.6s; }
				html { height: 100%; }
				body{ font-family: 'Lato', sans-serif; color: #888; margin: 0; }
				#main{ display: table; width: 100%; height: 10vh; text-align: center; }
				.fof{ display: table-cell; vertical-align: middle; }
				.fof h1{ font-size: 50px; display: inline-block; padding-right: 12px; animation: type .5s alternate infinite; }
				@keyframes type{ from{box-shadow: inset -3px 0px 0px #888;} to{box-shadow: inset -3px 0px 0px transparent;} }
			</style>
		</head>
		<body>
			<div id='main'>
				<div class='fof'>
					<h1>".$parram['judul']."</h1>
					<h3>".$parram['isi']."</h3>
				</div>
			</div>
		</body>
		</html>
	";
	return $data;
}
// Send Email End