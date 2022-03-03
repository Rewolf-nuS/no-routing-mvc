<nav>
  <ul class="c-pagination">
    <li class="c-pagination__item"><a class="c-pagination__link" href="?page=<?= $paginate["page_default"] ?>">&laquo;</a></li>
    <li class="c-pagination__item"><a class="c-pagination__link" href="?page=<?= $paginate["page_prev"] ?>">Prev</a></li>
    <?php foreach ($paginate["pages"] as $page) : ?>
      <?php $page_title = explode('&', $page)[0] ?>
      <?php if ($paginate["current_page"] == $page) : ?>
        <li class="c-pagination__item active"><a class="c-pagination__link" href="?page=<?= $page ?>"><?= $page_title ?></a></li>
      <?php else : ?>
        <li class="c-pagination__item"><a class="c-pagination__link" href="?page=<?= $page ?>"><?= $page_title ?></a></li>
      <?php endif ?>
    <?php endforeach ?>
    <li class="c-pagination__item"><a class="c-pagination__link" href="?page=<?= $paginate["page_next"] ?>">Next</a></li>
    <li class="c-pagination__item"><a class="c-pagination__link" href="?page=<?= $paginate["page_count"] ?>">&raquo;</a></li>
  </ul>
</nav>