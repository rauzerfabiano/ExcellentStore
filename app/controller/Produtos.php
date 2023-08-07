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

    public function editar($id = null) {
        $produtoModel = $this->model('Produto');
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $descricao = $_POST['descricao'];
            $valorVenda = $_POST['valorVenda'];
            $estoque = $_POST['estoque'];
    
            if ($produtoModel->atualizar($id, $descricao, $valorVenda, $estoque)) {
                header('location:/produtos'); // Redirect to the product list
            } else {
                die('Algo deu errado');
            }
        } else {
            $produto = $produtoModel->getProduto($id);
            $this->view('produtos/editar', ['produto' => $produto]);
        }
    }

    public function excluir($id) {
        $produtoModel = $this->model('Produto');
        
        if ($produtoModel->excluir($id)) {
            header('location:/produtos'); // Redirect to the product list
        } else {
            die('Algo deu errado');
        }
    }
}
?>
