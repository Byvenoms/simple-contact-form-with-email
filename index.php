<?php
/*
Author: Enes Alperen Hürüm
Project: Contact Form
Date: 07.March.2018 01:16
Licence: Free
*/
// Required Files
require "class.phpmailer.php";

// Mail settings
$mailhost			=	"mail.sitename.com"; //Example
$mailadress 		= 	"support@sitename.com"; //Example
$mailpassword 		= 	"123456"; //Example
$mailport			=	"587"; //Example
$mailsecure			= 	"tls"; //Example
$contactmail		=	"contact@sitename.com"; //Example

//Captcha Settings
$captchaenabled 	= 	"yes"; // yes or no
$sitekey			=	"6LfZK0sUAAAAABeHeK9XfDGImRderbpkgmWUA56U"; //Example
$secretkey			=	"6LfZK0sUAAAAAIvOozQEpfnKHuk_RemR7Bq2-Wpz"; //Example

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
	"captchaerror"		=>		"Please verify the Captcha code!",
);
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

<?php if($captchaenabled == "yes") { ?>
<!-- Captcha API -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- Captcha API -->
<?php } ?>

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
<?php
//Mail Function
if (isset($_POST["send"])) {
	if(!empty($_POST["name"] and $_POST["email"] and $_POST["subject"] and $_POST["message"])) {
		if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
			if($captchaenabled == "yes") {
				if (isset($_POST['g-recaptcha-response'])) {
				$captcha = $_POST['g-recaptcha-response'];
				}
					$control = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretkey."&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
					$check = json_decode($control);
						if($check->success == false) {
							$pagemessage = '<div class="alert alert-danger"><strong>'.$lang['error'].'</strong> '.$lang['captchaerror'].'</div>'; 
							} else {
								include "mail-content.php";
									} 
										} else { include "mail-content.php"; }
	} else { $pagemessage = '<div class="alert alert-danger"><strong>'.$lang['error'].'</strong> '.$lang['wrongemail'].'</div>'; }
	} else { $pagemessage = '<div class="alert alert-danger"><strong>'.$lang['error'].'</strong> '.$lang['emptyarea'].'</div>'; }
}
?>
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

<?php if($captchaenabled == "yes") { ?>
<div class="g-recaptcha" data-sitekey="<?=$sitekey?>"></div>
<?php } ?>
</form>
<!-- Contact Form -->
</div> <!-- /panel -->
</div> <!-- /columb -->
</div> <!-- /row -->
</div> <!-- /container -->
</body>
</html>