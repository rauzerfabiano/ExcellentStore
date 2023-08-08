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

    public function getProduto($id) {
        $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function atualizar($id, $descricao, $valorVenda, $estoque) {
        $stmt = $this->conn->prepare("UPDATE produtos SET descricao = ?, valorVenda = ?, estoque = ? WHERE id = ?");
        $stmt->bind_param("sdii", $descricao, $valorVenda, $estoque, $id);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    
        $stmt->close();
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM produtos WHERE ID = ?");
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    
        $stmt->close();
    }

    public function adicionarImagem($produtoId, $caminho) {
        $stmt = $this->conn->prepare("INSERT INTO imagens_produto (produto_id, caminho) VALUES (?, ?)");
        $stmt->bind_param("is", $produtoId, $caminho);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    
        $stmt->close();
    }
    
    
}
?>
