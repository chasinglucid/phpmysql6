<?php
namespace Ijdb\Entity;
class Joke
{
  public $id;
  public $authorId;
  public $jokedate;
  public $joketext;
  private $authorsTable;
  
  // constructor asks for an instance of a DatabaseTable class
  // that contains related data
  // in this case the author database table
  public function __construct(\Ninja\DatabaseTable
                              $authorsTable)
  {
    $this->authorsTable = $authorsTable;
  }
  
  public function getAuthor()
  {
    return $this->authorsTable->findById($this->authorId);
  }
}