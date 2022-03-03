<?php

namespace app\core;

use app\core\exception\NotFoundException;

/**
 * class Controller
 *
 * @package app\core
 */

class Controller
{
  public $viewDir = __DIR__ . '/../../app/views/';
  public $componentsDir = __DIR__ . '/../../app/views/components/';
  public $layoutDir = __DIR__ . '/../../app/views/layouts/';
  public $ext = '.view.php';

  private $site_title = null;

  /**
   * Set the page title.
   *
   * @param string $title
   * @return $this
   */
  public function setTitle($title)
  {
    $this->site_title = $title;
    return $this;
  }

  /**
   * Get the page title.
   *
   * @param string $title
   * @return void
   */
  public function getTitle()
  {
    return $this->site_title;
  }

  /**
   * Render page.
   *
   * @param string $fileName
   * @param array|null $params
   * @param string $layoutName
   * @return void
   */
  public function render(
    string $fileName,
    array $params = null,
    array $config = ['layoutName' => 'app', 'headerName' => 'header', 'footerName' => 'footer']
  ) {
    // convert array to config variables.
    extract($config);
    $header = $this->componentsPath($headerName);
    $footer = $this->componentsPath($footerName);

    $template = $this->templatePath($fileName);

    if (file_exists($template)) {
      if ($params) extract($params);
      $site_title = $this->getTitle();
      $layout = $this->layoutPath($layoutName);
      include $layout;
    } else {
      $this->setTitle("404 Not Found")->errorView(new NotFoundException());
    }
  }

  /**
   * Render error page.
   *
   * @param mixed $exception
   * @param string $layoutName
   * @return void
   */
  public function errorView(\Exception $exception, $config = ['layoutName' => 'app', 'headerName' => 'header', 'footerName' => 'footer'])
  {
    http_response_code($exception->getCode());

    extract($config);
    $header = $this->componentsPath($headerName);
    $footer = $this->componentsPath($footerName);

    $site_title = $this->getTitle();
    $template = $this->templatePath("_error");
    $layout = $this->layoutPath($layoutName);
    include $layout;
    die();
  }

  protected function templatePath($name)
  {
    return $this->viewDir . $name . $this->ext;
  }

  protected function componentsPath($name)
  {
    return $this->componentsDir . $name . '.php';
  }

  protected function layoutPath($name)
  {
    return $this->layoutDir . $name . $this->ext;
  }
}
