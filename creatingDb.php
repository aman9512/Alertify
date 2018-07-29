<?php
  //create a db, table, and connection
  function getDbConnection()
  {
    $DB_USERNAME = 'root';
    $DB_HOST     = 'localhost';
    $DB_PASSWORD = 'root';
    $DB_DATABASE = 'alertifySchema';

    $mysqli = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD);
    if ($mysqli->connect_error) die("Connection failed: " . $mysqli->connect_error);

    if(!$mysqli->query("CREATE DATABASE IF NOT EXISTS " . $DB_DATABASE))  echo $mysqli->error;
    if(!$mysqli->query("use " .$DB_DATABASE)) echo $mysqli->error;

    createTable($mysqli);
    return $mysqli;
  }

  function createTable(&$mysqli)
  {
     $create_query = <<<_CREATE_TABLE_
     CREATE TABLE IF NOT EXISTS users
      (
        id INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        email VARCHAR(100) NOT NULL,
        username VARCHAR(20) NOT NULL,
        password VARCHAR(40) NOT NULL,
        firstName VARCHAR(30) NOT NULL,
        lastName VARCHAR(30) NOT NULL,
        license VARCHAR(30) NOT NULL,
        dob VARCHAR(20) NOT NULL,
        phoneNumber INT(12) NOT NULL
      )
_CREATE_TABLE_;

    if(!$mysqli->query($create_query)) echo 'Error in creating a table: ' . $mysqli->error;

  }

 ?>
