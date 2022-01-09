<?php
header('Content-Type: application/json');
require_once 'connection.php';

$response = array();

// provide movie id
if ( isset($_POST['id']) ) {
  // move on and delete the movie
  $id = $_POST['id'];
  // very important when using the DELETE query to LIMIT to 1 otherwise you are putting your database or table in danger of having shit deleted you didnt intend on
  $stmt = $conn->prepare("DELETE FROM movies WHERE id=? LIMIT 1");
  $stmt->bind_param('i', $id);
  if ($stmt->execute()) {
    // success
    $response['error'] = false;
    $response['message'] = "movie deleted successfully";
    $response['response_code'] = 204; // 204 no content but successful
  } else {
    // failure
    $response['error'] = true;
    $response['message'] = "failed to remove movie";
    $response['response_code'] = 400;
  }

} else {
  // we cannot delete the movie because we dont know which movie to delete
    $response['error'] = true;
    $response['message'] = "Please provide the movie id";
    $response['response_code'] = 400;
}

echo json_encode($response); 

?>