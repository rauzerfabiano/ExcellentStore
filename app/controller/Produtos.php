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

    public function imagens($produtoId) {
        $produtoModel = $this->model('Produto');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $targetDir = "public/imagens/";
            $uploadOk = 1;
    
            foreach ($_FILES["imagens"]["tmp_name"] as $key => $value) {
                $targetFile = $targetDir . basename($_FILES["imagens"]["name"][$key]);
                
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    echo "Apenas arquivos JPG, JPEG e PNG são permitidos.";
                    $uploadOk = 0;
                }
                
                if ($uploadOk == 0) {
                    echo "Imagem não carregada.";
                } else {
                    if (move_uploaded_file($_FILES["imagens"]["tmp_name"][$key], $targetFile)) {
                        $produtoModel->adicionarImagem($produtoId, $targetFile);
                    } else {
                        echo "Ocorreu um erro ao carregar sua imagem.";
                    }
                }
            }
    
            header('location:/produtos'); // Redirect to the product list
        } else {
            $this->view('produtos/imagens', ['produtoId' => $produtoId]);
        }
    }
}
?>
