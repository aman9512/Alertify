<?php
  //sending geolocation and text message
  require '../vendor/autoload.php';
  require 'twilioActSetting.php';
  use Twilio\Rest\Client;

  function textCurrentUserLocation(&$userStreetAddress)
  {
    setupTwilioAct();
    $to = '';
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
        'body' => $_POST['userText'] . ' ' . $userStreetAddress . '!'
    )
  );
    }
  }

  function getGeoLocation()
  {
      if(!empty($_POST['userLat']) || !empty($_POST['userLon']))
      {
        $addre = getStreetAddress($_POST['userLat'], $_POST['userLon']);
        textCurrentUserLocation($addre);
      }
  }

  //convert lon and lat to street address
  function getStreetAddress(&$lat, &$lon)
  {
      $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lon).'&sensor=false';
      $json = @file_get_contents($url);
      $data=json_decode($json);
      $status = $data->status;

      return $data->results[0]->formatted_address;
  }
  getGeoLocation();
 ?>
