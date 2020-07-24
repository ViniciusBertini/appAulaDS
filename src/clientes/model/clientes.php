<?php
include_once('../../banco/conn.php');

class Clientes {
    private $idcliente = null;
    private $nome = null;
    private $email = null;
    private $telefone = null;
    private $ativo = null;
    private $datacriacao = null;
    private $datamodificacao = null;
    private $erro = null;

    public function __get($var) {
        return $this->$var;
    }
    public function __set($var, $value) {
        $this->$var = $value;
    }

    public function createClientes() {
        $connection = new Conn();
        $conn = $connection->getConn();

        $sql = "INSERT INTO clientes(nome, email, telefone, ativo, datacriacao, datamodificacao) VALUES (?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssss', $this->nome, $this->email, $this->telefone, $this->ativo, $this->datacriacao, $this->datamodificacao);
            $stmt->execute();
            return true;
        } catch (Exception $erro) {
            $this->erro = $erro->getMessage();
            return false;
        } finally {
            $conn->close();
        }
    }

    public function listClientes($complemento) {
        $connection = new Conn();
        $conn = $connection->getConn();
        
        $sql = "SELECT * FROM clientes WHERE 1=1";
        
        if (isset($complemento)) {
            $sql .= $complemento;
        }

        try {
            $stmt = $conn->query($sql);
            while ($dado = $stmt->fetch_assoc()) {
                $result[] = array_map('utf8_encode', $dado);
            }
            if (!isset($result)) {
                unset($result);
                return false;
            } else {
                return $result;
            }
        } catch (Exception $erro) {
            $this->erro = $erro->getMessage();
            return false;
        } finally {
            $conn->close();
        }
    }

    public function viewClientes() {
        $connection = new Conn();
        $conn = $connection->getConn();

        $sql = "SELECT * FROM clientes WHERE idcliente = ".$this->idcliente;

        try {
            $stmt = $conn->query($sql);
            $dado = $stmt->fetch_assoc();
            $result = array_map('utf8_encode', $dado);
            return $result;
        } catch (Exception $erro) {
            $this->erro = $erro->getMessage();
            return false;
        } finally {
            $conn->close();
        }
    }

    public function updateClientes() {
        $connection = new Conn();
        $conn = $connection->getConn();

        $sql = "UPDATE clientes SET nome = ?, email = ?, telefone = ?, ativo = ?, datamodificacao = ? WHERE idcliente = ?";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssssi', $this->nome, $this->email, $this->telefone, $this->ativo, $this->datamodificacao, $this->idcliente);
            $stmt->execute();
            return true;
        } catch (Exception $erro) {
            $this->erro = $erro->getMessage();
            return false;
        } finally {
            $conn->close();
        }
    }

    public function delClientes() {
        $connection = new Conn();
        $conn = $connection->getConn();

        $sql = "DELETE FROM clientes WHERE idcliente = ".$this->idcliente;

        try {
            $stmt = $conn->query($sql);
            return true;
        } catch (Exception $erro) {
            $this->erro = $erro->getMessage();
            return false;
        } finally {
            $conn->close();
        }
    }
}