<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	require_once 'phpmailer/Exception.php';
	require_once 'phpmailer/PHPMailer.php';
	require_once 'phpmailer/SMTP.php';
	if (isset($_POST['mail_text'])) {	
		$mail = new PHPMailer(true); 
        $mail->isSMTP(); 
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;  
        $mail->Username = 'baba@gmail.com';
        $mail->Password = 'dhrhdisjfvrkdifj';
        $mail->SMTPSecure = 'ssl'; 
        $mail->Port = 465; 
    
        $mail->addAddress('baba@gmail.com');
        $mail->setFrom('baba@gmail.com');
        $mail->isHTML(true); 
        $mail->Subject = "Request from web-site"; 
        $mail->Body = $_POST['mail_text']; 
        $mail->send();  
	}
	header("Location: persons.php");
