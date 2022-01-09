# PHP_Movies_API
Build a Movies API with PHP and MySQL using XAMPP for the servers

## Overview
This project is the result of completing [Udemy course PHP | Build a Complete API](https://www.udemy.com/course/create-apis-in-php/)

## Project Details - What I learned
  * How to build a complete Movies API using PHP & MySQL and XAMPP to run the servers
  * How to check database credentials to set up the connection
  * Created six possible endpoints to achieve:
    * Get all movies 
    * Get a single movie - by id, by title
    * Update a movie already in the database
    * Delete a movie from the database
    * Create/Insert a new movie to the database
  * Sending accurate Response Codes
  * API documentation

Sets up connection to the API:
```php
<?php 
error_reporting(0);

// database credendials
$db_name = "movies_api";
$mysql_username = "root";
$mysql_password = "";
$server_name = "127.0.0.1";

// connection variable ----> connect to database
$conn = mysqli_connect($server_name,$mysql_username,$mysql_password,$db_name);

// if can't connect return json error msg
if (!$conn) {
  echo '{"message":"Unable to connect to database"}';
  
  // kill the connection
  die();
}
?>
```

Endpoint for updating a movie:
```php
<?php
header('Content-Type: application/json');
require_once 'connection.php';

$response = array();

// IF we have all the parameters move on and update the movie
if ( isset($_POST['id']) && isset($_POST['storyline']) && isset($_POST['stars']) && isset($_POST['box_office']) ) {

  // store the parameters in variables
  $id = $_POST['id'];
  $storyline = $_POST['storyline'];
  $stars = $_POST['stars'];
  $box_office = $_POST['box_office'];

  $stmt = $conn->prepare("UPDATE movies SET storyline='$storyline', stars='$stars', box_office='$box_office' WHERE id='$id' ");

  if ($stmt->execute()) {
    //success let the user know that the movie has been updated
    $response['error'] = false;
    $response['message'] = "Movie has been updated successfully";
    $response['response_code'] = 204;
  } else {
    //failure
    $response['error'] = true;
    $response['message'] = "Failed to update movie";
    $response['response_code'] = 400;
  }

} else {
  // we dont have enough info to update the movie
  $response['error'] = true;
  $response['message'] = "Please provide id, storyline, box_office, and stars";
  $response['response_code'] = 400;
}

echo json_encode($response);

?>
```

HTML that will allow us to test our update movie endpoint:
```html
<form method="POST" action="http://localhost:8000/update_movie.php">
  <input type="text" name="id" value="1"/>
  <input type="text" name="storyline" value="test storyline"/>
  <input type="text" name="box_office" value="5"/>
  <input type="text" name="stars" value="8"/>
  <input type="submit" value="submit" />
</form>
```

## Tech Stack
<table>
  <tr>
    <td>PHP</td>
    <td>MySQL</td>
    <td>XAMPP</td>
    <td>HTML</td>
  </tr>
  <tr>
    <td><img width="55" src="https://raw.githubusercontent.com/gilbarbara/logos/master/logos/php.svg"/></td> 
    <td><img width="55" src="https://raw.githubusercontent.com/gilbarbara/logos/master/logos/mysql.svg"/></td>
    <td><img width="55" src="https://raw.githubusercontent.com/gilbarbara/logos/master/logos/xampp.svg"/></td>  
    <td><img width="55" src="https://raw.githubusercontent.com/gilbarbara/logos/master/logos/html-5.svg"/></td>
  </tr>
</table>

## Contributors
<table>
  <tr>
   <td> Beth Meeker <a href="https://github.com/meekb">GH</td>
  </tr>
  </tr>
    <td><img src="https://avatars.githubusercontent.com/u/76264735?v=4" alt="Beth Meeker avatar"
    width="150" height="auto" /></td>
  </tr>
</table>
