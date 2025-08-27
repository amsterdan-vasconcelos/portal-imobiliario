<?php

class Conexão
{
  private static $connection;

  protected static function getConnection()
  {
    if (self::$connection === null) {
      $dns = "mysql:host=localhost;dbname=casaweb";

      try {
        self::$connection = new PDO($dns, 'root', '');
        // [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
        self::$connection->setAttribute(
          PDO::ATTR_ERRMODE,
          PDO::ERRMODE_EXCEPTION
        );
      } catch (PDOException $e) {
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

      foreach ($params as $key => $value) {
        $stmt->bindValue($key + 1, $value);
      }

      $stmt->execute();
      return $stmt;
    } catch (PDOException $e) {
      die('execute query error: ' . $e->getMessage());
    }
  }

  protected function select(string $table, $condition = '', $params = [])
  {
    $sql = "select * from $table $condition order by id desc;";
    $stmt = $this->executeQuery($sql, $params);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  protected function insert(string $table, array $attributes, array $values)
  {
    $attributes = implode(',', $attributes);
    $params = implode(',', array_fill(0, count($values), '?'));

    $sql = "insert into $table ($attributes) values ($params);";
    $this->executeQuery($sql, $values);
    return self::getConnection()->lastInsertId();
  }

  protected function update(string $table, array $fields, array $values, int $id)
  {
    $fields = implode(',', array_map(fn($field) => "$field = ?", $fields));

    $sql = "update $table set $fields where id = ?";
    $stmt = $this->executeQuery($sql, [...$values, $id]);
    return $stmt->rowCount();
  }

  protected function delete(string $table, int $id)
  {
    $sql = "delete $table where id = ?";
    $stmt = $this->executeQuery($sql, [$id]);
    return $stmt->rowCount();
  }
}
