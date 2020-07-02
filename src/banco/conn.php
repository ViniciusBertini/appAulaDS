<?php
require_once('config.php');

class Conn {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $db = 'dbaulads';

    private function connection() {
        $conn = new mysqli($this->host, $this->user, $this->password, $this->db);

        if ($conn->connect_error) {
            die('Erro ao tentar conectar ao banco de dados: '.$conn->connect_error);
        }
        
        return $conn;
    } 

    public function getConn() {
        return $this->connection();
    }
}