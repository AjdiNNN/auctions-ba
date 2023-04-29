<?php

require_once __DIR__.'/../Config.class.php';
abstract class BaseDao
{
    protected $dao;

    private $conn;

    private $tablename;

    /**
    * constructor of dao class
    */
    public function __construct($tablename)
    {
        $this->tablename = $tablename;
        $servername = Config::DB_HOST();
        $username = Config::DB_USERNAME();
        $password = Config::DB_PASSWORD();
        $schema = Config::DB_SCHEME();
        $port = Config::DB_PORT();
        $this->conn = new PDO("mysql:host=$servername;dbname=$schema;port=$port", $username, $password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
    * Method used to read all todo objects from database
    */
    public function get_all()
    {
        $stmt = $this->conn->prepare("SELECT * FROM ".$this->tablename);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_by_id($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM ".$this->tablename." WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return reset($result);
    }

    /**
    * Delete todo record from the database
    */
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM ".$this->tablename." WHERE id=:id");
        $stmt->bindParam(':id', $id); // SQL injection prevention
        $stmt->execute();
    }

    public function add($entity)
    {
        $query = "INSERT INTO ".$this->tablename." (";
        foreach ($entity as $column => $value) {
            $query .= $column.", ";
        }
        $query = substr($query, 0, -2);
        $query .= ") VALUES (";
        foreach ($entity as $column => $value) {
            $query .= ":".$column.", ";
        }
        $query = substr($query, 0, -2);
        $query .= ")";
        $stmt= $this->conn->prepare($query);
        $stmt->execute($entity); // sql injection prevention
        $entity['id'] = $this->conn->lastInsertId();
        return $entity;
    }

    public function update($id, $entity, $id_column = "id")
    {
        $query = "UPDATE ".$this->tablename." SET ";
        foreach ($entity as $name => $value) {
            $query .= $name ."= :". $name. ", ";
        }
        $query = substr($query, 0, -2);
        $query .= " WHERE ${id_column} = :id";

        $stmt= $this->conn->prepare($query);
        $entity['id'] = $id;
        $stmt->execute($entity);
        return $entity;
    }

    protected function query($query, $params)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function queryUnique($query, $params)
    {
        $results = $this->query($query, $params);
        return reset($results);
    }
}
