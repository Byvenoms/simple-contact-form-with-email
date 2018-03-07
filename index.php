<?php
/*
Author: Enes Alperen Hürüm
Project: Contact Form
Date: 07.March.2018 01:16
Licence: Free
*/
// Required Files
require "class.phpmailer.php";

// Mail info
$mailhost			=	"mail.sitename.com"; //Example
$mailadress 		= 	"support@sitename.com"; //Example
$mailpassword 		= 	"123456"; //Example
$mailport			=	"587"; //Example
$mailsecure			= 	"tls"; //Example
$contactmail		=	"contact@sitename.com"; //Example

// Language
$lang = array(
	"title"				=>		"Contact Form | Enesbey.com",
	"sitename"			=>		"Enesbey.com",
	"contactform" 		=>		"Contact Form",
	"name"				=>		"Name",
	"pleaseenter" 		=>		"Please Enter",
	"email"				=>		"E-mail",
	"subject"			=>		"Subject",
	"message"			=>		"Message",
	"send"				=>		"Send",
	"error"				=>		"Error!",
	"emptyarea"			=>		"Please fill in all fields!",
	"wrongemail"		=>		"Please enter a valid email address!",
	"success"			=>		"Successful!",
	"sendsuccess"		=>		"Your message has been sent!",
	"err"				=>		"Something went wrong!",
);

//Mail Function
if (isset($_POST["send"])) {
	if(!empty($_POST["name"] and $_POST["email"] and $_POST["subject"] and $_POST["message"])) {
		if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
   $mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = $mailhost;
							$mail->Port = $mailport;
							$mail->SMTPSecure = $mailsecure;
							$mail->SMTPAuth = true;
							$mail->Username = $mailadress;
							$mail->Password = $mailpassword;
$mail->SetFrom($mail->Username, $lang['sitename']);
$mail->AddAddress($contactmail, $_POST['name']);
$mail->CharSet = 'UTF-8';
$mail->Subject = ''.$lang['sitename'].' - '.$_POST['subject'].'';
$content = '<table width="100%" border="1" align="center" cellpadding="1" cellspacing="1">
    <tbody>
        <tr>
            <td>Name</td>
            <td>'.$_POST['name'].'</td>
        </tr>
        <tr>
            <td>E-mail</td>
            <td>'.$_POST['email'].'</td>
        </tr>
        <tr>
            <td>Subject</td>
            <td>'.$_POST['subject'].'</td>
        </tr>
        <tr>
            <td>Date</td>
            <td>'.date("F j, Y, g:i a").'</td>
        </tr>
        <tr>
            <td>IP Adress</td>
            <td>'.$_SERVER['REMOTE_ADDR'].'</td>
        </tr>
        <tr>
            <td>Message</td>
            <td>'.htmlspecialchars($_POST['message']).'</td>
        </tr>
    </tbody>
</table>';
$mail->MsgHTML($content);
if($mail->Send()) {
    $pagemessage = '<div class="alert alert-success"><strong>'.$lang['success'].'</strong> '.$lang['sendsuccess'].'</div>';
} else {
    $pagemessage = '<div class="alert alert-danger">'.$lang['err'].'</div>';
}
	} else { $pagemessage = '<div class="alert alert-danger"><strong>'.$lang['error'].'</strong> '.$lang['wrongemail'].'</div>'; }
	} else { $pagemessage = '<div class="alert alert-danger"><strong>'.$lang['error'].'</strong> '.$lang['emptyarea'].'</div>'; }
}
?>
<html>
<head>
<title><?=$lang['title'];?></title>

<!-- Meta tags -->
<meta charset="utf8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- Meta tags -->

<!-- Bootstrap CDN -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--Bootstrap CDN -->

<!-- Custom CSS -->
<style type="text/css">
/* Background image */
body {
	background-color:#e5ddd5; 
	}


body::after {
  background: url(https://i.hizliresim.com/vJy0XA.png);
  content: "";
  opacity: 0.07;
  position: fixed;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  z-index: -1;
/* Background image */
}
</style>
<!-- Custom CSS -->
</head>
<body>
<div class="container"> <!-- container -->
<div class="row"> <!-- row -->
<div class="col-md-6 col-md-offset-3"> <!-- columb -->
<div class="panel panel-default panel-body" style="margin-top: 20px;"> <!-- panel -->

<h3><center><?=$lang['contactform']?></center></h3>

<?php if(isset($_POST['send'])) { echo $pagemessage;  } ?>
<!-- Contact Form -->
<form action="" method="post">
<div class="form-group">
<label><?=$lang['name']?></label>
<input type="text" name="name" class="form-control" placeholder="<?=$lang['pleaseenter']?> <?=$lang['name']?>..." />
</div>

<div class="form-group">
<label><?=$lang['email']?></label>
<input type="text" name="email" class="form-control" placeholder="<?=$lang['pleaseenter']?> <?=$lang['email']?>..." />
</div>

<div class="form-group">
<label><?=$lang['subject']?></label>
<input type="text" name="subject" class="form-control" placeholder="<?=$lang['pleaseenter']?> <?=$lang['subject']?>..." />
</div>

<div class="form-group">
<label><?=$lang['message']?></label>
<textarea class="form-control" name="message" rows="8" placeholder="<?=$lang['pleaseenter']?> <?=$lang['message']?>..."></textarea>
</div>

<div class="form-group" style="float: right;">
<button type="submit" name="send" class="btn btn-default" style="min-width: 150px;"><?=$lang['send'];?></button>
</div>
</form>
<!-- Contact Form -->
</div> <!-- /panel -->
</div> <!-- /columb -->
</div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>