<?php
require '../vendor/autoload.php';

if(isset($_POST['sendemail']))
{
  $name= filter_var($_POST['name'], FILTER_SANITIZE_STRING);
  $email_id= filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL);
  $subject= filter_var($_POST['subject'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
  $message= filter_var($_POST['message'], FILTER_SANITIZE_STRING);

  $email = new \SendGrid\Mail\Mail(); 
  $email->setFrom("camilledrake95@gmail.com", "Portfolio");
  $email->setSubject("$subject");
  $email->addTo($email_id, $name);
  $email->addContent("text/plain", $message);
 
  $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
    try {
      $response = $sendgrid->send($email);
      print $response->statusCode() . "\n";
      print_r($response->headers());
      print $response->body() . "\n";
    } catch (Exception $e) {
      echo 'Caught exception: '. $e->getMessage() ."\n";
    }

}
?>
