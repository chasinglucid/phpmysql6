<?php
namespace Ijdb\Entity;

class Author {
	public $id;
	public $name;
	public $email;
	public $password;
	private $jokesTable;

    
  // constructor asks for an instance of a DatabaseTable class
  // that contains related data
  // in this case the joke database table
	public function __construct(\Ninja\DatabaseTable $jokeTable) {
		$this->jokesTable = $jokeTable;
	}

	public function getJokes() {
		return $this->jokesTable->find('authorId', $this->id);
	}

	public function addJoke($joke) {

		$joke['authorId'] = $this->id;

		$this->jokesTable->save($joke);
	}
}