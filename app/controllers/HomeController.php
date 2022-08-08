<?php

namespace app\controllers;

use app\core\Controller;

/**
 * class HomeController
 *
 * @package app\controllers
 */

class HomeController extends Controller
{
  public function indexView()
  {
    // if you want to set unique page title, ex) $this->setTitle('Your title')->render('index');
    $this->render('index');
  }
}
