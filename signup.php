<?php
  require 'creatingDb.php';
  require '../vendor/autoload.php';
  require 'twilioActSetting.php';
  use Twilio\Rest\Client;

  $email = "";
  $username = "";
  $password = "";
  $firstName = "";
  $lastName = "";
  $license = "";
  $dob = 0;
  $phoneNumber = 0;

  $mysqli = getDbConnection();
  $insertQuery = $mysqli->prepare("INSERT INTO users (email, username, password, firstName, lastName, license, dob, phoneNumber) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $insertQuery->bind_param("sssssssi", $email, $username, $password, $firstName, $lastName, $license, $dob, $phoneNumber);

  if(!isset($_POST["email"]) || !isset($_POST["username"]) || !isset($_POST["password"]) || !isset($_POST["phoneNumber"])
    || !isset($_POST["firstName"]) || !isset($_POST["license"]))
  {
    echo "Required info is missing";
  }
  else
  {
      $email = $_POST["email"];
      $username = $_POST["username"];
      $password = $_POST["password"];
      $firstName = $_POST["firstName"];
      $lastName = "robert";
      $license = $_POST["license"];
      $dob = "10/10/1010";
      $phoneNumber = $_POST["phoneNumber"];
      $insertQuery->execute();

      sendEmailToNewUser($email);
      sendTextToNewUser($phoneNumber);
  }

  function sendEmailToNewUser(&$to)
  {
    $subject = "Alertify Signup";
    $txt = "Thank you for signing up for humanity!";
    $headers = "From: Alertify Team";
    mail($to, $subject, $txt, $headers);
  }

  function sendTextToNewUser(&$to)
  {
    setupTwilioAct();
    if(!empty($to))
    {
      $sid = $_ENV["Twilio_Acct_SID"];
      $token = $_ENV["Twilio_Acct_Auth"];
      $client = new Client($sid, $token);

    $client->messages->create(
      $to,
      array(
        // A Twilio phone number you purchased at twilio.com/console
        'from' => $_ENV["Twilio_Phone_Number"],
        // the body of the text message you'd like to send
        'body' => 'Hey, thank you for signing up with Alertify!'
    )
  );

    }
  }
  header('Location: login.html');
  exit;
 ?>
