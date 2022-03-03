<?php

use app\core\Paginator;

// dd(bin2hex(random_bytes(100)));
dd($paginate);
?>

<h1>Home</h1>
<ul>
  <?php foreach ($users as $k => $v) : ?>
    <li><?= $v['user_id'] . ' : ' . $v['user_name'] ?></li>
  <?php endforeach; ?>

  <?php include Paginator::renderPagination() ?>
</ul>