<?php

include_once '../config/database.php';
class Pedido {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    public function listarPedidos() {
        $result = $this->conn->query("SELECT * FROM pedidos");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function criar($cliente, $produtos) {
        $this->conn->begin_transaction();
        
        try {
            // Inserir o pedido
            $stmt = $this->conn->prepare("INSERT INTO pedidos (cliente, total) VALUES (?, 0)");
            $stmt->bind_param("s", $cliente);
            $stmt->execute();
            $pedidoId = $stmt->insert_id;
    
            // Inserir os itens do pedido
            $total = 0;
            foreach ($produtos as $produto) {
                $stmt = $this->conn->prepare("INSERT INTO itens_pedido (pedido_id, produto_id, quantidade, valor) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iiid", $pedidoId, $produto['id'], $produto['quantidade'], $produto['valor']);
                $stmt->execute();
                $total += $produto['quantidade'] * $produto['valor'];
            }
    
            // Atualizar o total do pedido
            $stmt = $this->conn->prepare("UPDATE pedidos SET total = ? WHERE ID = ?");
            $stmt->bind_param("di", $total, $pedidoId);
            $stmt->execute();
    
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollback();
            return false;
        }
    }
}

?>