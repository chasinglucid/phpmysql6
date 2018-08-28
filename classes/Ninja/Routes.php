<?php
namespace Ninja;

// allows for type checking by describing what methods a
// class should contain but doesn't contain any actual
// logic

// allows each website to supply a different set of routes
interface Routes
{
  public function getRoutes();
}