<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Paginator;
use app\models\User;

/**
 * class UserController
 *
 * @package app\controllers
 */

class UserController extends Controller
{
  public function indexView()
  {
    $user = new User();
    $paginator = new Paginator(5);
    $count = $user->count('user_id', 'users', ['user_gender' => 'male']);
    [$limit, $offset] = $paginator->getDatabaseProps();
    $paginate = $paginator->paginate($count, 3, []);
    $users = $user->sortByGender('male', $limit, $offset);
    $this->setTitle('MVC')->render('users/index', ['users' => $users, 'paginate' => $paginate]);
  }
}
