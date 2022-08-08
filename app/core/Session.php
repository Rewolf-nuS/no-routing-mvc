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
   * @return self
   */
  public static function set($key, $value)
  {
    $_SESSION[$key] = $value;

    return self::class;
  }

  /**
   * Get a session variable.
   *
   * @param string $key
   * @param mixed  $default
   *
   * @return mixed
   */
  public static function get($key, $default = null)
  {
    return self::exists($key) ? $_SESSION[$key] : $default;
  }

  /**
   * Merge values recursively.
   *
   * @param string $key
   * @param mixed  $value
   *
   * @return $this
   */
  public function merge($key, $value)
  {
    if (is_array($value) && is_array($old = self::get($key))) {
      $value = array_merge_recursive($old, $value);
    }

    return self::set($key, $value);
  }

  /**
   * Delete session variable.
   *
   * @param string $key
   * @return self
   */
  public static function delete($key)
  {
    if (self::exists($key)) {
      unset($_SESSION[$key]);
    }

    return self::class;
  }

  /**
   * Delete session variable.
   *
   * @param string $key
   * @return self
   */
  public static function clear()
  {
    $_SESSION = [];

    return self::class;
  }

  /**
   * Check if a session variable is set.
   *
   * @param string $key
   *
   * @return bool
   */
  public static function exists($key)
  {
    return array_key_exists($key, $_SESSION);
  }



  /**
   * Get or regenerate current session ID.
   *
   * @param bool $new
   *
   * @return string
   */
  public static function id($new = false)
  {
    if ($new && session_id()) {
      session_regenerate_id(true);
    }

    return session_id() ?: '';
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
