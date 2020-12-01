<?php
/* Author: Joshua Riley
 * Author URL: http://joshriley.tk
 * Purpose: Simple PHP Contact Form
 * How To Use: name="name" for each field needed. Rename attributes and variables as needed.
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set("SMTP", "aspmx.l.google.com");
ini_set("sendmail_from", "jrizzle8888@gmail.com");

/* Check for empty fields */
if(empty($_POST['name']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) )
{
    echo "No arguments Provided!";
    return false;
}

$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];

/* Create the email and send the message */
$to = 'jdaleriley@gmail.com'; /* Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to. */
$email_subject = "JDR Portfolio Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nMessage:\n$message";
$headers = "From: jdaleriley@gmail.com\r\n"; /* This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com. */
$headers .= "Reply-To: $email_address\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

//var_dump($headers);
$mail = mail($to, $email_subject, $email_body, $headers);
if(!$mail) {
  print_r(error_get_last());
  $_POST['mail-status'] = 0;
  header('Location: http://joshriley.ml/');
} else {
  echo "Thank you! We will be contacting you soon. We look forward to doing business with you.";
  sleep(2);
  $_POST['mail-status'] = 1;
  header('Location: http://joshriley.ml/');
}
