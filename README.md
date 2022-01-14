# PHP_Movies_API
Build a Movies API with PHP & MySQL with XAMPP

## Overview
This project is the result of completing [Udemy course PHP | Build a Complete API](https://www.udemy.com/course/create-apis-in-php/)

## What I learned
  * How to build a database with MySQL using XAMPP
<img width="1066" alt="Screen Shot 2022-01-09 at 3 07 10 PM" src="https://user-images.githubusercontent.com/76264735/148702986-82dd6267-3c2b-41a5-9890-bc58af0914ba.png">
  
  * How to check database credentials to set up the connection
```php
// database credendials
$db_name = "movies_api";
$mysql_username = "root";
$mysql_password = "";
$server_name = "127.0.0.1";

// connection variable ----> connect to database
$conn = mysqli_connect($server_name,$mysql_username,$mysql_password,$db_name);
```
  * Creating endpoints to achieve:
    * Get all movies from the database
    ```php
    HTTP Method: GET, Endpoint: get_all_movies.php
    ```
    * Get a single movie from the database:
      * Get a movie by id
      ```php
      HTTP Method: GET, Endpoint: get_movie.php?id={id}
      ```
      * Get a movie by name (title)
      ```php
      HTTP Method: GET, Endpoint: get_movie.php?name={title}
      ```
    * Update a movie already in the database
    ```php
    HTTP Method: POST, Endpoint: update_movie.php?id={id}
    ```
    * Delete a movie from the database
    ```php
    HTTP Method: POST, Endpoint: delete_movie.php?id={id}
    ```
    * Create/Insert a new movie to the database
    ```php
    HTTP Method: POST, Endpoint: create_movie.php
    ```
  * Testing endpoints
    * How to test the Create, Delete, and Update (example below) endpoints using test.html files
```html
<form method="POST" action="http://localhost:8000/update_movie.php">
  <input type="text" name="id" value="1"/>
  <input type="text" name="storyline" value="test storyline"/>
  <input type="text" name="box_office" value="5"/>
  <input type="text" name="stars" value="8"/>
  <input type="submit" value="submit" />
</form>
```
  * Sending accurate Response Codes
```php
$response[$response['response_code'] = 200 // request successful
$response['response_code'] = 201 // resource successfully created
$response['response_code'] = 204; // successful but no content to return (ex: delete movie)
```
  * Documentation
    * Importance of excellent documentation to ensure developers can connect to your API which includes providing 
all endpoints with examples of the request format

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
