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
        $stmt->bindParam($key, $value);
      }

      $stmt->execute();
      return $stmt;
    } catch (PDOException $e) {
      die('execute query error: ' . $e->getMessage());
    }
  }
}
