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

  $API_key = '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';
  $headers = array(
    'Authorization: Bearer' ($API_key),
    'Content-Type: application/json'
  );
 
  $sendgrid = new \SendGrid($API_key);
    try {
      $response = $sendgrid->send($email_id);
      print $response->statusCode() . "\n";
      print_r($response->$headers());
      print $response->body() . "\n";
    } catch (Exception $e) {
      echo 'Caught exception: '. $e->getMessage() ."\n";
    }

}
?>
