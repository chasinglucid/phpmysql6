<?php
try {

  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../includes/DatabaseFunctions.php';
  
  $result = findAll($pdo, 'joke');
  
  $jokes = [];
  foreach ($result as $joke) {
    $author = findById($pdo, 'author', 'id', $joke['authorid']);
  
    $jokes[] = [
      'id' => $joke['id'],
      'joketext' => $joke['joketext'],
      'jokedate' => $joke['jokedate'],
      'name' => $author['name'],
      'email' => $author['email']
    ];
  }
  
  
  $title = 'Joke list';
  
  $totalJokes = total($pdo, 'joke');
 
  // start the buffer
  ob_start();
  
  // include the template. The PHP code will be executed,
  // but the resulting HTML will be stored in the buffer
  // rather than sent to the browser.
  
  include __DIR__ . '/../templates/jokes.html.php';
  
  // Read the contents of the output buffer and store them
  // in the $output variable for use in layout.html.php
  
  $output = ob_get_clean();
  
} catch (PDOException $e) {
  $title = 'An error has occurred';
  $output = 'Database error: ' . $e->getMessage() . ' in ' .$e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';