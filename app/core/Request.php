<?php

namespace app\core;

/**
 * class Request
 *
 * @package app\core
 */

class Request
{
  /**
   * Get method
   *
   * @return void
   */
  public static function method()
  {
    return strtolower($_SERVER['REQUEST_METHOD']);
  }

  /**
   * Judge whether GET method or not
   *
   * @return boolean
   */
  public static function isGet()
  {
    return self::method() === "get";
  }

  /**
   * Judge whether POST method or not
   *
   * @return boolean
   */
  public static function isPost()
  {
    return self::method() === "post";
  }

  /**
   * Get request bodies.
   *
   * @return array
   */
  public static function getBody()
  {
    $body = [];
    if (self::method() === 'get') {
      foreach ($_GET as $key => $value) {
        $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }
    if (self::method() === 'post') {
      foreach ($_POST as $key => $value) {
        $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }

    return $body;
  }
}
