<?php

namespace Bonnibel\Database;

class Database
{
    private string $host;
    private string $dbName;
    private string $user;
    private string $password;
    private int $port;
    private \mysqli $db;


    public function __construct($dbName, $host = 'localhost', $user = 'root', $password = '', $port = 3306)
    {
        $this->host = $host;
        $this->dbName = $dbName;
        $this->user = $user;
        $this->password = $password;
        $this->port = $port;
        $this->db = $this->connectDB();
    }


    //Gets
    public function getHost()
    {
        return $this->host;
    }
    public function getDbname()
    {
        return $this->dbName;
    }
    public function getUser()
    {
        return $this->user;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getPort()
    {
        return $this->port;
    }
    public function getSelectAll($table)
    {
        $result = $this->selectAll($table);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function getSelect($table, $param = '')
    {
        $result = $this->select($table, $param);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    
    //views
    public function viewSelectAll($table)
    {
        $result = $this->selectAll($table);
        if ($result->num_rows > 0) {
            foreach($result->fetch_assoc() as $d=>$p){
                echo $d . '=>' . $p . PHP_EOL;
            }
        } else {
            return null;
        }
    }
    public function viewSelect($table, $param = '')
    {
        $result = $this->select($table, $param);
        if ($result->num_rows > 0) {
            foreach($result->fetch_assoc() as $d=>$p){
                echo $d . '=>' . $p . PHP_EOL;
            }
        } else {
            return null;
        }
    }

    //Conecta ao banco
    public function connectDB()
    {
        $connection = new \mysqli(
                         $this->host,
                         $this->user,
                         $this->password,
                         $this->dbName,
                            $this->port
                        );
        

        if ($connection->connect_error) {
            
            return die("Falha na conexão: " . $connection->connect_error);
        
        } else {
            
            echo "Conexão deu certo";
            return $connection;
        
        }
    }


    //funções SQL
    public function insert($table, $data)
    {
        $columns = implode(", ", array_keys($data));
        $values = implode(", ", array_map([$this->db, 'real_escape_string'], array_values($data)));
        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        return $this->db->query($query);
    }
    public function selectAll($table)
    {
        $command = "SELECT * FROM $table";
        return $this->db->query($command);
    }
    public function select($table, $param = '')
    {
        $command = "SELECT * FROM $table $param";
        return $this->db->query($command);
    }
}