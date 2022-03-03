<?php

namespace app\core;

use PDO;

/**
 * class Model
 *
 * @package app\core
 */

class Model
{
  public \PDO $pdo;
  public string $value;
  public array $values;

  function __construct()
  {
    $db_connection = DB_CONNECTION;
    $db_name = DB_DATABASE;
    $db_host = DB_HOST;
    $db_port = DB_HOST;
    $db_user = DB_USERNAME;
    $db_password = DB_PASSWORD;

    $dsn = "{$db_connection}:dbname={$db_name};host={$db_host};charset=utf8;port={$db_port}";
    try {
      $this->pdo = new PDO($dsn, $db_user, $db_password);
      $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e) {
      echo "接続失敗: " . $e->getMessage();
      exit;
    }
  }

  /**
   * Convenience method when you want to fetch one column.
   *
   * @param string $table
   * @param array $where
   * @return mixed
   */
  public function findOne($table, $where)
  {
    $attributes = array_keys($where);
    $sql = "SELECT * FROM $table WHERE ";
    $sql .= implode("AND", array_map(fn ($attr) => "$attr = :$attr", $attributes));
    $stmt = $this->pdo->prepare($sql);
    foreach ($where as $key => $item) {
      $stmt->bindValue(":$key", $item);
    }

    $stmt->execute();
    return $stmt->fetch();
  }

  /**
   * Convenience method when you want to get number of records.
   *
   * @param string $row
   * @param string $table
   * @param array $where
   * @return mixed
   */
  public function count($row, $table, $where = [])
  {
    if ($where === []) {
      $sql = "SELECT count($row) AS count FROM $table;";
      $rowCount = $this->pdo->query($sql)->fetch(PDO::FETCH_COLUMN);
    } else {
      $attributes = array_keys($where);
      $sql = "SELECT count($row) AS count FROM $table WHERE ";
      $sql .= implode("AND", array_map(fn ($attr) => "$attr = :$attr", $attributes));
      $stmt = $this->pdo->prepare($sql);
      foreach ($where as $key => $item) {
        $stmt->bindValue(":$key", $item);
      }
      $stmt->execute();
      $rowCount = $stmt->fetch(PDO::FETCH_COLUMN);
    }
    return $rowCount;
  }
}
