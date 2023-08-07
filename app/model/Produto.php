<?php
require_once 'config/database.php';

class Produto {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function listarProdutos() {
        $query = "SELECT * FROM produtos";
        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            return $result;
        } else {
            return null;
        }
    }

    public function cadastrar($descricao, $valorVenda, $estoque) {
        $stmt = $this->conn->prepare("INSERT INTO produtos (descricao, valorVenda, estoque) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $descricao, $valorVenda, $estoque);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    
        $stmt->close();
    }
    
}
?>
