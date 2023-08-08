<?php
class Pedidos extends Controller {

    public function index() {
        $pedidoModel = $this->model('Pedido');
        $pedidos = $pedidoModel->listarPedidos();
        $this->view('pedidos/index', ['pedidos' => $pedidos]);
    }

    public function criar() {
        $produtoModel = $this->model('Produto');
        $pedidoModel = $this->model('Pedido');
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cliente = $_POST['cliente'];
            $produtos = [];

            foreach ($_POST['produtos'] as $produtoId => $quantidade) {
                $produto = $produtoModel->getProduto($produtoId);
                $produtos[] = [
                    'id' => $produtoId,
                    'quantidade' => $quantidade,
                    'valor' => $produto['ValorVenda']
                ];
            }
            $cliente = $_POST['cliente'];
            $produtos = []; // Extrair produtos e quantidades da requisição POST
    
            if ($pedidoModel->criar($cliente, $produtos)) {
                header('location:/pedidos');
            } else {
                die('Algo deu errado');
            }
        } else {
            $produtos = $produtoModel->listarProdutos();
            $this->view('pedidos/criar', ['produtos' => $produtos]);
        }
    }

    public function excluir($id) {
        $pedidoModel = $this->model('Pedido');
        
        if ($pedidoModel->excluir($id)) {
            header('location:/pedidos'); // Redirect to the orders list
        } else {
            die('Algo deu errado');
        }
    }
    
}
