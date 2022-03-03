<?php

namespace app\core;

session_start();
session_regenerate_id(true);

/**
 * class Session
 *
 * @package app\core
 */

class Session
{
  /**
   * Set session value.
   *
   * @param string $key
   * @param mixed $value
   * @return void
   */
  public static function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  /**
   * Get session value.
   *
   * @param string $key
   * @return mixed|false
   */
  public static function get($key)
  {
    return $_SESSION[$key] ?? false;
  }

  /**
   * Destroy session value.
   *
   * @param string $key
   * @return void
   */
  public static function destroy($key)
  {
    unset($_SESSION[$key]);
  }

  /**
   * Set flash message.
   *
   * @param string $key
   * @param string $message
   * @return void
   */
  public static function setFlash($key, $message)
  {
    $_SESSION['flash_messages'][$key] = $message;
  }

  /**
   * Get flash message.
   *
   * @param string $key
   * @param string $class
   * @return string|void
   */
  public static function getFlash($key, $class = "")
  {
    if (!isset($_SESSION['flash_messages'][$key])) {
      return;
    }

    $temp = sprintf(
      '<div class="%s">%s</div>',
      $class,
      $_SESSION['flash_messages'][$key]
    );
    unset($_SESSION['flash_messages'][$key]);
    return $temp;
  }
}
