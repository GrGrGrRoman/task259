<?php

namespace App\config;

use function App\d;

class Db
{

  private $db;

  public function __construct()
  {
    if ($this->db == null)
    {
      $this->db = new \PDO("sqlite:" . PATH_TO_SQLITE_FILE);
      if (!filesize(PATH_TO_SQLITE_FILE))
      throw new \Exception('БД не содержит таблиц!');
  
    }
    return $this->db;
  }

  public function query($sql, $params = [])
  {
		$stmt = $this->db->prepare($sql);
		if (!empty($params))
    {
			foreach ($params as $key => $val)
      {
				if (is_int($val))
        {
					$type = \PDO::PARAM_INT;
				}
        else
        {
					$type = \PDO::PARAM_STR;
				}
				$stmt->bindValue(':'.$key, $val, $type);
			}
		}
		$stmt->execute();
		return $stmt;
	}
  
  public function row($sql, $params = [])
  {
    $result = $this->query($sql, $params);
    return $result->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function column($sql, $params = [])
  {
    $result = $this->query($sql, $params);
    return $result->fetchColumn();
  }

  public function lastInsertId()
  {
    return $this->db->lastInsertId();
  }
}
