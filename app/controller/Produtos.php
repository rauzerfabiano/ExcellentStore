<?php
class Produtos extends Controller {
    public function index() {
        $produtoModel = $this->model('Produto');
        $produtos = $produtoModel->listarProdutos();

        $this->view('produtos/index', ['produtos' => $produtos]);
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $descricao = $_POST['descricao'];
            $valorVenda = $_POST['valorVenda'];
            $estoque = $_POST['estoque'];
    
            $produtoModel = $this->model('Produto');
    
            if ($produtoModel->cadastrar($descricao, $valorVenda, $estoque)) {
                header('location:/produtos'); // Redirect to the product list
            } else {
                die('Algo deu errado');
            }
        } else {
            $this->view('produtos/cadastrar');
        }
    }
}
?>
