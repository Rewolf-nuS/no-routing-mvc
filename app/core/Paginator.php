<?php
namespace app\core;

class Paginator
{
  public int $limit = 10;

  public function __construct(int $limit = 10) {
    $this->limit = $limit;
  }

  /**
   * Generate pagination items
   *
   * @param int $count
   * @param int $limit
   * @param int $per_count
   * @param array $url_params ["key" => "value"]
   * @return array
   */
  public function paginate($count, $per_count = 10, array $url_params = [])
  {
    $current_page = self::getCurrent();

    $page_default = 1;

    $page_count = ceil($count / $this->limit);
    $page_start = $current_page;
    $page_end = $page_start + $per_count - 1;
    if ($page_end > $page_count) {
      $page_end = $page_count;
      $page_start = $page_end - $per_count + 1;
    }
    if ($page_start < 0) $page_start = 1;

    $page_prev = ($current_page <= 1) ? 1 : $current_page - 1;
    $page_next = ($current_page < $page_count) ? $current_page + 1 : $page_count;

    $pages = range($page_start, $page_end);

    if ($url_params !== []) {
      $url_params = http_build_query($url_params);
      $page_default .= "&{$url_params}";
      $page_prev .= "&{$url_params}";
      foreach ($pages as $key => $value) {
        $pages[$key] = $value . "&{$url_params}";
      }
      $page_next .= "&{$url_params}";
      $page_count .= "&{$url_params}";
    }

    $paginate = compact(
      'current_page',
      'page_default',
      'page_count',
      'page_start',
      'page_end',
      'page_prev',
      'page_next',
      'pages',
      'url_params'
    );

    return $paginate;
  }

  public function getCurrent()
  {
    return (isset($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] : 1;
  }

  /**
   * Get props for using database.
   *
   * @param int $limit
   * @return array [$limit, $offset]
   */
  public function getDatabaseProps()
  {
    $current_page = $this->getCurrent();
    return [
      $limit = $this->limit,
      $offset = ($current_page - 1) * $limit
    ];
  }

  /**
   * Get path for pagination list.
   *
   * @return string
   */
  public static function renderPagination() {
    return __DIR__. '/../../app/views/components/paginate.php';
  }
}
