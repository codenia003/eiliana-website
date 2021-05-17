<?php

// echo "Asdas";

// die();


include('PHPMailer/PHPMailerAutoload.php');



  $msg = 'sdadadadad';

  $mail = new PHPMailer;


  $mail->IsSMTP();
  $mail->Host = 'smtp.gmail.com';                       // Specify main and backup server
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'admin@eiliana.com';                   // SMTP username
  $mail->Password = '76DeD&3a';
  $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
  $mail->Port = 587;                                          //Set the SMTP port number - 587 for authenticated TLS
  $mail->setFrom('admin@eiliana.com', 'Eiliana');     //Set who the message is to be sent from
  $mail->addReplyTo('admin@eiliana.com', 'Eiliana');


  $mail->addAddress('abhishek.singh@codenia.in');


  $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;

  //$mail->addAttachment('/usr/labnol/file.doc');         // Add attachments

  //$mail->addAttachment('live_backup/image/data/logo.png'); // Optional name

  $mail->isHTML(true);                                  // Set email format to HTML


  $mail->Subject = 'Registration Form';

  $mail->Body    = $msg;

if(!$mail->send()) {

  echo 'Message was not sent.';

  echo 'Mailer error: ' . $mail->ErrorInfo;

}else{

    echo "mail send";

}

?>
