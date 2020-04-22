<?php
class MAILERHELPER
{
  public function send_mail($email,$message,$subject)
    {
      require_once('../../mailer/class.phpmailer.php');
      $mail = new PHPMailer();
      $mail->IsSMTP();
      $mail->SMTPDebug  = 0;
      $mail->SMTPAuth   = true;
      $mail->SMTPSecure = "ssl";
      $mail->Host       = "mail.privateemail.com";
      $mail->Port       = 465;
      $mail->AddAddress($email);
      $mail->Username="admin@btpps.org";
      $mail->Password="adminpasswd#20";
      $mail->SetFrom('admin@btpps.org','Bonne Terre Preparatory School');
      $mail->AddReplyTo("admin@ptpps.org",'Bonne Terre Preparatory School');
      $mail->Subject    = $subject;
      $mail->MsgHTML($message);
      $mail->Send();
    }

}
