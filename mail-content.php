<?php
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
?>