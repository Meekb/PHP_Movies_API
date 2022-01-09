<?php
header('Content-Type: application/json');
require_once 'connection.php';

$response = array();

// get movie id
// what can be updated? box_office, stars, storyline

if ( isset($_POST['id']) && isset($_POST['storyline']) && isset($_POST['stars']) && isset($_POST['box_office']) ) {
  // if we have all the things, move on and update the movie
  $id = $_POST['id'];
  $storyline = $_POST['storyline'];
  $stars = $_POST['stars'];
  $box_office = $_POST['box_office'];

  $stmt = $conn->prepare("UPDATE movies SET storyline='$storyline', stars='$stars', box_office='$box_office' WHERE id='$id' ");

  if ($stmt->execute()) {
    //success let the user know that the movie has been updated
    $response['error'] = false;
    $response['message'] = "Movie has been updated successfully";
  } else {
    //failure
    $response['error'] = true;
    $response['message'] = "Failed to update movie";
  }

} else {
  // we dont have enough info to update the movie
  $response['error'] = true;
  $response['message'] = "Please provide id, storyline, box_office, and stars";
}

echo json_encode($response);

?>

/* 
1. endpoint: /update_movie.php
2. request type: $_POST
3. parameters: id, storyline, box-office, stars
*/