<?php
namespace app\models;

use app\core\Model;
use PDO;

/**
 * class User
 *
 * @package app\models
 */

class User extends Model {
  public function fetchAllUsers($limit = null, $offset = null, $sort = 'DESC')
  {
    try {
      $this->pdo->beginTransaction();
      $sql = "SELECT * FROM users";
      $sql .= " ORDER BY user_id $sort";

      if(!is_null($limit) && !is_null($offset)) {
        $sql .= " LIMIT $limit OFFSET $offset";
      }

      $stmt = $this->pdo->prepare($sql);
      $res = $stmt->execute();
      if ($res) {
        $this->pdo->commit();
      }
      return $stmt->fetchAll();
    } catch (\PDOException $e) {
      echo $e->getMessage();
      $this->pdo->rollBack();
    }
  }

  public function sortByGender($gender, $limit = null, $offset = null ,$sort = 'DESC')
  {
    try {
      $this->pdo->beginTransaction();
      $sql = "SELECT * FROM users";
      $sql .= " WHERE user_gender = :gender";
      $sql .= " ORDER BY user_id $sort";

      if(!is_null($limit) && !is_null($offset)) {
        $sql .= " LIMIT $limit OFFSET $offset";
      }


      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
      $res = $stmt->execute();
      if ($res) {
        $this->pdo->commit();
      }
      return $stmt->fetchAll();
    } catch (\PDOException $e) {
      echo $e->getMessage();
      $this->pdo->rollBack();
    }
  }
}
