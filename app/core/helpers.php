<?php
if (!function_exists('t')) {
  /**
   * Triming first character and last character.
   *
   * @param string|array $str
   * @return string|array
   */
  function t($str)
  {
    if (is_string($str)) {
      // go under return
    } elseif (is_array($str)) {
      $arr = [];
      foreach ($str as $k => $curr) {
        $arr[$k] = preg_replace('/\A[\x00\s]++|[\x00\s]++\z/u', '', $curr);
      }
      return $arr;
    }

    return preg_replace('/\A[\x00\s]++|[\x00\s]++\z/u', '', $str);
  };
};


if (!function_exists('h')) {
  /**
   * Convenience method for htmlspecialchars.
   *
   * @param string|array $str
   * @return string|array
   */
  function h($str)
  {
    if (is_string($str)) {
      // go under return
    } elseif (is_array($str)) {
      $arr = [];
      foreach ($str as $k => $curr) {
        $arr[$k] = htmlspecialchars($curr, ENT_QUOTES, 'UTF-8');
      }
      return $arr;
    } elseif ($str === null || is_scalar($str)) {
      return $str;
    }

    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
  };


  if (!function_exists('route')) {
    /**
     * Return page path.
     *
     * @param string $path
     * @return string
     */
    function route($path)
    {
      $url = BASE_URL . 'public/' . $path;
      return $url;
    }
  }


  if (!function_exists('assets')) {
    /**
     * Return asset path.
     *
     * @param string $path
     * @return string
     */
    function assets($path)
    {
      return BASE_URL . 'assets/' . $path;
    }
  }


  if (!function_exists('redirect')) {
    /**
     * Convenience method for redirect.
     *
     * @param [type] $path
     * @return void
     */
    function redirect($path)
    {
      header("Location: {$path}");
    }
  }
};
