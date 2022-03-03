<?php

namespace app\core;

/**
 * class Form
 *
 * @package app\core
 */

class Form
{
  /**
   * If there is some errors, get HTML class.
   *
   * @param string|array $error
   * @return string
   */
  public static function isInvalid($error)
  {
    return !empty($error) ? 'is-invalid' : '';
  }

  /**
   * If checked, get HTML class.
   *
   * @param string $value
   * @param string $target
   * @return string
   */
  public static function checked($value, $target)
  {
    return ($value == $target) ? 'checked' : '';
  }

  /**
   * If selected, get HTML class.
   *
   * @param string $value
   * @param string $target
   * @return string
   */
  public static function selected($value, $target)
  {
    return ($value == $target) ? 'selected' : '';
  }
}
