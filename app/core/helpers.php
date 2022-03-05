<?php

use app\core\Session;

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
}


if (!function_exists('dd')) {
  /**
   * Convenience method for debug.
   *
   * @param mixed $var
   * @param array $vars
   * @return void
   */
  function dd($var, ...$vars)
  {
    $pre_styles = [
      'width' => 'min(95%,700px)',
      'font-size' => '14px',
      'line-height' => '1.5',
      'color' => '#FFFFFF',
      'background-color' => '#2F3437',
      'border-left' => 'solid 10px #77B063',
      'border-top-right-radius' => '20px',
      'margin-left' => '10px',
      'padding' => '20px 20px 20px 10px',
    ];
    $code_styles = [
      'display' => 'block',
      'max-height' => '300px',
      'overflow-y' => 'scroll',
      'padding-bottom' => '5px',
    ];

    echo '<pre style="' . __inlineStyleGenerate($pre_styles) . '">';
    echo '<code style="' . __inlineStyleGenerate($code_styles) . '">';
    var_dump($var, ...$vars);
    echo '</code>';
    echo '</pre>';

    return [$var, ...$vars];
  }
}


if (!function_exists('__inlineStyleGenerate')) {
  function __inlineStyleGenerate($styles)
  {
    $res = [];
    foreach ($styles as $k => $v) {
      $inline_style = "$k:$v;";
      $res[] = $inline_style;
    }

    return implode('', $res);
  }
}


if (!function_exists('route')) {
  /**
   * Return page path.
   *
   * @param string $path
   * @return string
   */
  function route($path)
  {
    return BASE_URL . 'public/' . $path;
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


if (!function_exists('create_csrf_token')) {
  /**
   * Create a CSRF token and save to session.
   *
   * @param int $length
   * @return bool
   */
  function create_csrf_token($length = 16)
  {
    $token = bin2hex(random_bytes($length));
    Session::set('csrf_token', $token);

    return Session::exists('csrf_token');
  }
}
