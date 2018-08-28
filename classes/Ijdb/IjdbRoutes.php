<?php

namespace Ijdb;

class IjdbRoutes implements \Ninja\Routes {

  // defines routing for website
  public function getRoutes() {

    // create the database connection (pdo)
    include __DIR__ . '/../../includes/DatabaseConnection.php';

    // declare website related tables
    $jokesTable = new \Ninja\DatabaseTable($pdo, 'joke', 'id');
    $authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');

    // declare table controllers
    $jokeController = new \Ijdb\Controllers\Joke($jokesTable, $authorsTable);
    $authorController = new \Ijdb\Controllers\Register($authorsTable);
    
    // an array of possible routes for website
    $routes = [
      'author/register' => [
        'GET' => [
          'controller' => $authorController,
          'action' => 'registrationForm'
        ],
        'POST' => [
          'controller' => $authorController,
          'action' => 'registerUser'
        ]
      ],
      'author/success' => [
        'GET' => [
          'controller' => $authorController,
          'action' => 'success'
        ]
      ],      'joke/edit' => [
        'POST' => [
          'controller' => $jokeController,
          'action' => 'saveEdit'
        ],
        'GET' => [
          'controller' =>$jokeController,
          'action' => 'edit'
        ]
      ],
      'joke/delete' => [
        'POST' => [
          'controller' => $jokeController,
          'action' => 'delete'
        ]
      ],
      'joke/list' => [
        'GET' => [
          'controller' => $jokeController,
          'action' => 'list'
        ]
      ],
      '' => [
        'GET' => [
          'controller' => $jokeController,
          'action' => 'home'
        ]
      ]
    ];
    
    // send routes to EntryPoint.php
    return $routes;
  }
}