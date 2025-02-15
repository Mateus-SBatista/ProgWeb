<?php
session_start();

// Verifica se o total a pagar e a lista de produtos foram definidos
if (!isset($_SESSION['totalAPagar'])) {
    $_SESSION['totalAPagar'] = 0;
}
if (!isset($_SESSION['produtos'])) {
    $_SESSION['produtos'] = [];
}

$totalAPagar = $_SESSION['totalAPagar'];
$produtos = $_SESSION['produtos'];

// Exibe os detalhes de cada produto
echo "<h1>Resumo do Pedido</h1>";
echo "<table border='1'>";
echo "<tr><th>Produto</th><th>Valor Unitário</th><th>Quantidade</th><th>Valor Total</th></tr>";
foreach ($produtos as $produto) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($produto['nome']) . "</td>";
    echo "<td>R$ " . number_format($produto['valorUnitario'], 2) . "</td>";
    echo "<td>" . $produto['quantidade'] . "</td>";
    echo "<td>R$ " . number_format($produto['valorTotal'], 2) . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<h2>Total a pagar: R$ " . number_format($totalAPagar, 2) . "</h2>";

// Limpa a sessão
session_destroy();

echo "<a href='index.php'>Voltar ao início</a>";
?>
