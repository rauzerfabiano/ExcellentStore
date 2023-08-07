<?php
class Produtos extends Controller {
    public function index() {
        $produtoModel = $this->model('Produto');
        $produtos = $produtoModel->listarProdutos();

        $this->view('produtos/index', ['produtos' => $produtos]);
    }
}
?>
