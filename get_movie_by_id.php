<?php
header('Content-Type: application/json');
require_once 'connection.php';

// declare response variable as an array
$response = array();

// if user provided the movie title
if (isset($_GET['id'])) {

  // go ahead and GET the movie
  $id = $_GET['id']; // title is set to the value of GET request with title param

  $stmt = $conn->prepare("SELECT id, title, storyline, lang, genre, release_date, box_office, run_time, stars
    FROM movies WHERE id = ?");
  
  $stmt->bind_param("i", $id); // this function allows us to bind the given title to the query

  if ($stmt->execute()) {
    // success - bind the result passing the keys as params
    $stmt->bind_result($id, $title, $storyline, $lang, $genre, $release_date, $box_office, $run_time, $stars);
    // then fetch that data
    $stmt->fetch();
    // create a variable of an array to store the result
    $movie = array(
      'id'=> $id,
      'title'=> $title,
      'storyline'=> $storyline,
      'lang'=> $lang,
      'genre'=> $genre,
      'release_date'=> $release_date,
      'box_office'=> $box_office,
      'run_time'=> $run_time,
      'stars'=> $stars,
    );
    // provide the response and data
    $response['error'] = false;
    $response['movie'] = $movie;
    $response['message'] = "movie has been returned successfully";
    $response['response_code'] = 200; // 200 ok
  } else {
    // failure - response with error and message
    $response['error'] = true;
    $response['message'] = "we could not get the movie";
    $response['response_code'] = 400; // 400 bad request
  }

} else {
  // no movie title was provided, so we can't get the movie - response with error and message
  $response['error'] = true;
  $response['message'] = "Please provide an id";
  $response['response_code'] = 400; // 400 bad request
}

echo json_encode($response);

?>