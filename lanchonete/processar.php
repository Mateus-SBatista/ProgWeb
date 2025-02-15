<?php
session_start();

// Inicializa o total a pagar e a lista de produtos se ainda não existirem
if (!isset($_SESSION['totalAPagar'])) {
    $_SESSION['totalAPagar'] = 0;
}
if (!isset($_SESSION['produtos'])) {
    $_SESSION['produtos'] = [];
}

// Recebe o código e a quantidade do formulário
$codigo = isset($_POST['codigo']) ? (int)$_POST['codigo'] : 0;
$quantidade = isset($_POST['quantidade']) ? (int)$_POST['quantidade'] : 0;

$valorUnitario = 0;
$nomeProduto = "";

// Verifica o código do produto e define o valor unitário e o nome do produto
switch ($codigo) {
    case 100:
        $valorUnitario = 2.10;
        $nomeProduto = "Cachorro quente";
        break;
    case 101:
        $valorUnitario = 2.50;
        $nomeProduto = "Bauru";
        break;
    case 102:
        $valorUnitario = 3.50;
        $nomeProduto = "Americano";
        break;
    case 103:
        $valorUnitario = 3.00;
        $nomeProduto = "Cheeseburguer";
        break;
    case 104:
        $valorUnitario = 4.00;
        $nomeProduto = "Cheese Salada";
        break;
    case 105:
        $valorUnitario = 3.00;
        $nomeProduto = "Refrigerante";
        break;
    default:
        echo "Código de produto inválido. <a href='index.php'>Voltar</a>";
        exit;
}

// Calcula o valor do produto e adiciona ao total
$valorProduto = $valorUnitario * $quantidade;
$_SESSION['totalAPagar'] += $valorProduto;

// Armazena os detalhes do produto na sessão
$_SESSION['produtos'][] = [
    'nome' => $nomeProduto,
    'valorUnitario' => $valorUnitario,
    'quantidade' => $quantidade,
    'valorTotal' => $valorProduto
];

echo "Valor a ser pago pelo item: R$ " . number_format($valorProduto, 2) . "<br>";
echo "<a href='index.php'>Adicionar mais produtos</a> ou <a href='finalizar.php'>Finalizar Pedido</a>";
?>
