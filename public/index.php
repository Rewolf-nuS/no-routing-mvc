<?php
require_once "./config.php";

use app\controllers\HomeController;

$controller = new HomeController();

$controller->indexView();
