<?php
require_once "../config.php";

use app\controllers\UserController;

$controller = new UserController();

$controller->indexView();
