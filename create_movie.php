<?php
header('Content-Type: application/json');
require_once 'connection.php';
$response = array();
// to create a movie we will need a title, storyline, box_office, stars, lang, genre, release_date, run_time.
// the id is going to be automatically created by the database
// IF we have all the needed parameters
if ( isset($_POST['title']) && isset($_POST['storyline']) && isset($_POST['stars']) && isset($_POST['box_office']) && isset($_POST['genre']) && isset($_POST['lang']) && isset($_POST['release_date']) && isset($_POST['run_time']) ) {
  // store the parameters in variables
  $title = $_POST['title'];
  $storyline = $_POST['storyline'];
  $stars = $_POST['stars'];
  $box_office = $_POST['box_office'];
  $genre = $_POST['genre'];
  $lang = $_POST['lang'];
  $release_date = $_POST['release_date'];
  $run_time = $_POST['run_time'];
  // Prepare the data to insert, the number of ?'s is equal to the num of parameters we want to insert
  $stmt = $conn->prepare("INSERT INTO movies (title, storyline, stars, box_office, genre, lang, release_date, run_time) VALUES (?,?,?,?,?,?,?,?)");
  // Next we want to append/bind the parameters
  $stmt->bind_param('ssddssss', $title, $storyline, $stars, $box_office, $genre, $lang, $release_date, $run_time);

  if ($stmt->execute()) {
    // success - let the user know the movie has been inserted into the database
    $response['error'] = false;
    $response['message'] = "movie has been added";
    $response['response_code'] = 201; // 201 resource created successfully
    $stmt->close();
  } else {
    // failure - error is true and let user know instertion failed
    $response['error'] = true;
    $response['message'] = "failed to add to database";
    $response['response_code'] = 400;
  }
} else {
  // ELSE we cannot insert a movie that doesn't have all the parameters
  $response['error'] = true;
  $response['message'] = "Please provide title, storyline, stars, box_office, genre, lang, release_date, run_time";
  $response['response_code'] = 400;
}
echo json_encode($response); 
?>