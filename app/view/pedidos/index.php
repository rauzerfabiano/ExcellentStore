<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <title>Listar Pedidos</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Pedidos</h1>
        <a href="/pedidos/criar" class="btn btn-primary mb-3">Criar pedido</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['pedidos'] as $pedido): ?>
                    <tr>
                        <td><?php echo $pedido['ID']; ?></td>
                        <td><?php echo $pedido['cliente']; ?></td>
                        <td><?php echo $pedido['data']; ?></td>
                        <td><?php echo $pedido['total']; ?></td>
                        <td>
                            <a href="/pedidos/excluir/<?php echo $pedido['ID']; ?>" class="btn btn-danger">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="/public/js/bootstrap.min.js"></script>
</body>
</html>
