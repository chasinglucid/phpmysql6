<?php

try {
  include __DIR__ . '/../includes/autoload.php';

  // ltrim removes the leading "/"s to match the requestURI 
  // to our existing routes
  $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
  
  // REQUEST_METHOD contains either the string GET or the string POST
  // depending on how the page was requested by the browser
  // so we pass the URL, the method and an IjdbRoutes object
  $entryPoint = new \Ninja\EntryPoint($route, 
                                      $_SERVER['REQUEST_METHOD'], 
                                      new \Ijdb\IjdbRoutes());
  
  
  $entryPoint->run();

   
}
catch (PDOException $e) {
  $title = 'An error has occurred';
  $output = 'Database error: ' . $e->getMessage() . ' in ' .
    $e->getFile() . ':' . $e->getLine();
  
  include  __DIR__ . '/../templates/layout.html.php'; 

}
