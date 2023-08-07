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
}
?>
