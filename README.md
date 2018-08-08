# Alertify
References:
w3schools
Udemy tutorials
CodePen
colorlib.com
stackOverflow

Developed a project at Girls in Tech: Hacking for Humanity hackathon 2018. This web app allows users in their local communities such as users current city etc. to create a report that can be a news report, missing child report, sexual assault, and much more to notify other users in the community about the wrong happenings. The report will be added to a newsfeed, which is displayed on the homepage.

New user will be sent a text message and email upon signup.

App also contains a resources menu that includes important phone number such as child abuse line etc and can make a call directly from the web page.

Third main feature allows user to send a text message along with their current location whenever in need to reach group of people such as other users, family, and friends.

This is a web app written in HTML/CSS/JS/Php/MYSQL using Twilio and google maps api.
In order to run the app, please add your personal number in home.php under textCurrentUserLocation() {$to = "phoneNumber"} for sending text message to your friends/family and create your own twilioActSetting.php as follows:
<?php
  function setupTwilioAct()
  {
    $_ENV["Twilio_Acct_SID"]="XXXX";
    $_ENV["Twilio_Acct_Auth"]="XXX";
    $_ENV["Twilio_Phone_Number"]="+XXX";
  }
 ?>
