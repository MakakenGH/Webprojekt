<?php
 $new_email = $_POST["new_email"];
 $user_email = $_POST["user_email"];

 if(isset($user_mail)) {
     $recipient = $user_email;
 }
 else {
     $recipient = $new_email;
 }
 echo $recipient;

$subject = "Dein Kauf bei Dampf!";
$from = "From: nf025 <nf025@hdm-stuttgart.de>";
$text = "Vielen Dank für deinen Kauf.";

mail($recipient, $subject, $text, $from);
?>