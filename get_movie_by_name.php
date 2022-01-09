<?php
header('Content-Type: application/json');
require_once 'connection.php';

// declare response variable as an array
$response = array();

// if user provided the movie title
if (isset($_GET['title'])) {

  // go ahead and GET the movie
  $title = $_GET['title']; // title is set to the value of GET request with title param

  $stmt = $conn->prepare("SELECT id, title, storyline, lang, genre, release_date, box_office, run_time, stars
    FROM movies WHERE title = ?");
  
  $stmt->bind_param("s", $title); // this function allows us to bind the given title to the query where first param is data type (s for string) and second param is what we're binding 

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
    $response['response_code'] = 200;
  } else {
    // failure - response with error and message
    $response['error'] = true;
    $response['message'] = "we could not get the movie";
    $response['response_code'] = 400;
  }

} else {
  // no movie title was provided, so we can't get the movie - response with error and message
  $response['error'] = true;
  $response['message'] = "Please provide a movie title";
  $response['response_code'] = 400;
}

echo json_encode($response);

?>