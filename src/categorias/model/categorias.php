<?php
include_once('../../banco/conn.php');

class Categorias {
    private $idcategoria = null;
    private $nome = null;
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

    public function createCategorias() {
        $connection = new Conn();
        $conn = $connection->getConn();

        $sql = "INSERT INTO categorias(nome, ativo, datacriacao, datamodificacao) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssss', $this->nome, $this->ativo, $this->datacriacao, $this->datamodificacao);
            $stmt->execute();
            return true;
        } catch (Exception $erro) {
            $this->erro = $erro->getMessage();
            return false;
        } finally {
            $conn->close();
        }
    }

    public function listCategorias($complemento) {
        $connection = new Conn();
        $conn = $connection->getConn();
        
        $sql = "SELECT * FROM categorias WHERE 1=1";
        
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

    public function viewCategorias() {
        $connection = new Conn();
        $conn = $connection->getConn();

        $sql = "SELECT * FROM categorias WHERE idcategoria = ".$this->idcategoria;

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

    public function updateCategorias() {
        $connection = new Conn();
        $conn = $connection->getConn();

        $sql = "UPDATE categorias SET nome = ?, ativo = ?, datamodificacao = ? WHERE idcategoria = ?";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssi', $this->nome, $this->ativo, $this->datamodificacao, $this->idcategoria);
            $stmt->execute();
            return true;
        } catch (Exception $erro) {
            $this->erro = $erro->getMessage();
            return false;
        } finally {
            $conn->close();
        }
    }

    public function delCategorias() {
        $connection = new Conn();
        $conn = $connection->getConn();

        $sql = "DELETE FROM categorias WHERE idcategoria = ".$this->idcategoria;

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