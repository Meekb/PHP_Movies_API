<?php 

// Error reporting is at the top of the script
error_reporting(0);

// getting database credendials
$db_name = "movies_api";
$mysql_username = "root";
$mysql_password = "";
$server_name = "127.0.0.1";

// connection variable ----> connect to database
$conn = mysqli_connect($server_name,$mysql_username,$mysql_password,$db_name);

// if we can't connect echo a message in json format
if (!$conn) {
  echo '{"message":"Unable to connect to database"}';
  die();
}


/*
GOALS:
1. GET all movies or a single movie
2. POST a movie to the database
3. PUT or update a movie already in the database
4. DELETE a movie from the database
*/

?>