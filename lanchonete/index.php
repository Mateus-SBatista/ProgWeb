<!DOCTYPE html>
<html>
<head>
    <title>Cardápio da Lanchonete</title>
</head>
<body>
    <h1>Cardápio da Lanchonete</h1>
    <form method="post" action="processar.php">
        <p>Código do Produto - Produto - Valor Unitário</p>
        <ul>
            <li>100 - Cachorro quente - 2,10</li>
            <li>101 - Bauru - 2,50</li>
            <li>102 - Americano - 3,50</li>
            <li>103 - Cheeseburguer - 3,00</li>
            <li>104 - Cheese Salada - 4,00</li>
            <li>105 - Refrigerante - 3,00</li>
        </ul>

        <label for="codigo">Código do item:</label>
        <input type="number" name="codigo" id="codigo" required><br><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" id="quantidade" required><br><br>

        <input type="submit" value="Adicionar ao Pedido">
    </form>

    <form method="post" action="finalizar.php">
        <input type="submit" value="Finalizar Pedido">
    </form>
</body>
</html>
