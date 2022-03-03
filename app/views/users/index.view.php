<?php

use app\core\Paginator;
dd($paginate) ?>

<h1>User</h1>

<ul>
  <?php foreach ($users as $k => $v) : ?>
    <li><?= $v['user_id'] . ' : ' . $v['user_name'] ?></li>
  <?php endforeach; ?>

  <?php include Paginator::renderPagination() ?>
</ul>

<p>users</p>