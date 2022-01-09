<?php
header('Content-Type: application/json');
require_once 'connection.php';

$response = array();

$stmt = $conn->prepare("SELECT * FROM movies"); // mysql <statement>
// $stmt->execute();
if ($stmt->execute()) {
  // if statement was executed successfully, get the results
  // create movies variable as an array to store all the results
  $movies = array();
  // get all results from the database
  $result = $stmt->get_result();
  // loop over the results which will be an array of objects
  // MYSQLI_ASSOC returns an array with key value pairs
  // in a nutshell: loop and get each single row
  while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    // with each loop a row (movie object data) is added to the array
    $movies[] = $row;
  }
  // In the case of success
  $response['error'] = false; // there is no error
  $response['movies'] = $movies; // an array of objects
  $response['message'] = "movies returned successfully";
  $response['response_code'] = 200; // 200 ok
  $stmt->close();


} else {
  // we have an error
  $response['error'] = true; // statement couldnt execute, error is true
  $response['message'] = "could not execute query";
  $response['response_code'] = 400; // 400 bad request
}

// display (echo) the results using json_encode method
// json_encode takes $response as a parameter and converts our response array into json
echo json_encode($response); 

?>