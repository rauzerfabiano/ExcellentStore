# ExcellentStore

O ExcellentStore é um sistema simples de gerenciamento de produtos e pedidos, desenvolvido como um teste técnico para a empresa Excellent Sistemas. Ele oferece funcionalidades básicas como adicionar, editar, excluir produtos, além de gerenciar pedidos associados a esses produtos.

## Características

- **Gestão de Produtos**: Adicione, edite ou exclua produtos do catálogo.
- **Upload de Imagens**: Associe imagens a um produto para melhor visualização.
- **Gestão de Pedidos**: Crie e visualize pedidos, associando-os a produtos do catálogo.
- **Design Responsivo**: O projeto utiliza Bootstrap para assegurar uma boa visualização em dispositivos de diferentes tamanhos.

## Tecnologias Utilizadas

- PHP (Sem frameworks)
- MySQL
- Bootstrap

## Banco de dados (tabelas e colunas)

```
CREATE TABLE produtos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descricao VARCHAR(255) NOT NULL,
    valorVenda DECIMAL(10, 2) NOT NULL,
    estoque INT NOT NULL,
    imagens TEXT
);

CREATE TABLE pedidos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    cliente VARCHAR(255) NOT NULL,
    total DECIMAL(10, 2) NOT NULL
);

CREATE TABLE itens_pedido (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pedido_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

CREATE TABLE imagens_produto (
    id INT PRIMARY KEY AUTO_INCREMENT,
    produto_id INT NOT NULL,
    caminho VARCHAR(255) NOT NULL,
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);
```

## Contribuições

Pull requests são bem-vindos!
