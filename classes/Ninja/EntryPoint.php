<?php

namespace Ninja;

class EntryPoint {

  // variables
  private $route;
  private $method;
  private $routes;

  // constructor
  public function __construct(string $route, string $method, \Ninja\Routes $routes)
  {
    $this->route = $route;
    $this->method = $method;
    $this->routes = $routes;
    $this->checkUrl();
  }

  // user-friendly url conversion on creation of obj
  private function checkUrl() {
    if($this->route !== strtolower($this->route)) {
      http_response_code(301);
      header('location: ' . strtolower($this->route));
    }
  }

  // loads template file and returns variables
  private function loadTemplate($templateFileName, $variables = []) {
    extract($variables);
    ob_start();
    include  __DIR__ . '/../../templates/' . $templateFileName;
    return ob_get_clean();
  }

  // called from index.php
  public function run() {

    // get array of routes from IjdbRoutes.php
    $routes = $this->routes->getRoutes();
    
    // get the associated controller from the routes array 
    // (link/methond[GET|POST]/controller)
    $controller = $routes[$this->route][$this->method]['controller'];
    
    // get the assiciated action from the routes array
    // (link/method[GET|POST]/Controller)
    $action = $routes[$this->route][$this->method]['action'];

    // set page based on the determined controller and the
    // determined action (ie. JokeController->delete())
    $page = $controller->$action();

    // set page title
    $title = $page['title'];

    // if the page has variables, output them using loadTemplate
    if (isset($page['variables'])) {
      $output = $this->loadTemplate($page['template'], $page['variables']);
    }
    else { // otherwise just load the template
      $output = $this->loadTemplate($page['template']);
    }

    // output to common template
    include  __DIR__ . '/../../templates/layout.html.php'; 
  }
}