<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <title>Criar Pedido</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Criar Pedido</h1>
        <form action="/pedidos/criar" method="post">
            <div class="mb-3">
                <label for="cliente" class="form-label">Cliente</label>
                <input type="text" class="form-control" id="cliente" name="cliente" required>
            </div>
            <?php foreach ($data['produtos'] as $produto): ?>
                <div class="mb-3">
                    <label for="produto_<?php echo $produto['ID']; ?>" class="form-label"><?php echo $produto['Descricao']; ?></label>
                    <input type="number" class="form-control" id="produto_<?php echo $produto['ID']; ?>" name="produtos[<?php echo $produto['ID']; ?>]" min="0">
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary">Criar Pedido</button>
        </form>
    </div>
    <script src="/public/js/bootstrap.min.js"></script>
</body>
</html>
