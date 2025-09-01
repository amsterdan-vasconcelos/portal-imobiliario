<?php

namespace App\DAO;

class Connection
{
  private static $connection;

  protected static function getConnection()
  {
    if (self::$connection === null) {
      $dns = "mysql:host=localhost;dbname=casaweb";

      try {
        self::$connection = new \PDO($dns, 'root', '');
        // [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
        self::$connection->setAttribute(
          \PDO::ATTR_ERRMODE,
          \PDO::ERRMODE_EXCEPTION
        );
      } catch (\PDOException $e) {
        die('connection error:' . $e->getMessage());
      }
    }

    return self::$connection;
  }

  protected static function closeConnection()
  {
    self::$connection = null;
  }

  protected function executeQuery(string $sql, $params = [])
  {
    try {
      $stmt = self::getConnection()->prepare($sql);
      $stmt->execute($params);
      return $stmt;
    } catch (\PDOException $e) {
      die('execute query error: ' . $e->getMessage());
    }
  }

  protected function select(string $table, $condition = '', $values = [])
  {
    $params = array_combine(
      array_map(fn($key) => ":$key", array_keys($values)),
      array_values($values)
    );

    $sql = "select * from $table $condition order by id asc;";
    $stmt = $this->executeQuery($sql, $params);
    return $stmt->fetchAll(\PDO::FETCH_OBJ);
  }

  protected function insert(string $table, array $values)
  {
    $columns = implode(', ', array_keys($values));
    $placeholders = ':' . implode(', :', array_keys($values));
    $params = array_combine(
      array_map(fn($key) => ":$key", array_keys($values)),
      array_values($values)
    );

    $sql = "insert into $table ($columns) values ($placeholders);";

    $this->executeQuery($sql, $params);
    return self::getConnection()->lastInsertId();
  }

  protected function update(string $table, array $values, int $id)
  {
    $columns = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($values)));

    $params = array_combine(
      array_map(fn($key) => ":$key", array_keys($values)),
      array_values($values)
    );

    $sql = "update $table set $columns where id = :id";
    $stmt = $this->executeQuery($sql, [...$params, ':id' => $id]);
    return $stmt->rowCount();
  }

  protected function delete(string $table, int $id)
  {
    $sql = "delete $table where id = :id";
    $stmt = $this->executeQuery($sql, [':id' => $id]);
    return $stmt->rowCount();
  }
}
