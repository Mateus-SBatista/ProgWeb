<?php
    //
    /*
    Texto completo
    */

    $nome = 'Mateus';
    echo ''.$nome;
    $numero1 = 3;
    $numero2 = 6;

    $resultado = $numero1 + $numero2;
    echo '<br>';
    echo ''.$resultado;
    echo '<br>';
    
/*
    2<1; //false
    1<=1; //vedadeiro
    1<=2; //verdadeiro

    1 == '1' //verdadeiro
    1 === '1' //falso
*/
$idade = 20;
if($idade == 20){
    echo 'verdade';
}else{
    echo 'falso';
}

echo '<br>';


switch($idade){
    case 20:
        echo 'verdade';
        break;
    case 21:
        echo 'falso';
        break;
        default:
        echo 'voce digitou o valor errado';
}
echo '<br>';

/*-------------------------------------------------------------------*/
// Recebendo o número do usuário
$numero = 20;

// Verificando se o número é positivo
if ($numero > 0) {
    echo "O número é positivo.\n";
} else {
    echo "O número não é positivo.\n";
}
echo '<br>';

/*-------------------------------------------------------------------*/

// Recebendo o valor do usuário
$valor = 1;

// Verificando se o valor está na faixa de 1 a 9
if ($valor >= 1 && $valor <= 9) {
    echo "O valor está na faixa permitida.\n";
} else {
    echo "O valor está fora da faixa permitida.\n";
}
echo '<br>';

/*-------------------------------------------------------------------*/

// Recebendo o código do produto do usuário
$codigo = 1;

// Verificando a classificação do produto com base no código
switch ($codigo) {
    case 1:
        echo "Produtos de limpeza.\n";
        break;
    case 2:
    case 3:
        echo "Alimento não perecível.\n";
        break;
    case 4:
    case 5:
    case 6:
        echo "Vestuário.\n";
        break;
    default:
        echo "Código de produto inválido.\n";
        break;
}
echo '<br>';

/*-------------------------------------------------------------------*/
echo '<br>';
$totalAPagar = 0;

do {
    // Exibindo o cardápio
    echo "Código do Produto - Produto - Valor Unitário\n";
    echo '<br>';
    echo "100 - Cachorro quente - 2,10\n";
    echo '<br>';
    echo "101 - Bauru - 2,50\n";
    echo '<br>';
    echo "102 - Americano - 3,50\n";
    echo '<br>';
    echo "103 - Cheeseburguer - 3,00\n";
    echo '<br>';
    echo "104 - Cheese Salada - 4,00\n";
    echo '<br>';
    echo "105 - Refrigerante - 3,00\n";
    echo '<br>';

    // Lendo o código do item e a quantidade
    $codigo = 100;
    $quantidade = 1;

    // Calculando o valor a ser pago para o item
    switch ($codigo) {
        case 100:
            $valorUnitario = 2.10;
            break;
        case 101:
            $valorUnitario = 2.50;
            break;
        case 102:
            $valorUnitario = 3.50;
            break;
        case 103:
            $valorUnitario = 3.00;
            break;
        case 104:
            $valorUnitario = 4.00;
            break;
        case 105:
            $valorUnitario = 3.00;
            break;
        default:
            echo "Código de produto inválido. Tente novamente.\n";
            continue; // Volta para o início do loop em caso de código inválido
    }
    echo '<br>';

    $valorProduto = $valorUnitario * $quantidade;
    $totalAPagar += $valorProduto;

    echo "Valor a ser pago pelo item: R$ " . number_format($valorProduto, 2) . "\n";
    $outroProduto = 'n';
} while (strtolower($outroProduto) == 's');
echo '<br>';

echo "Total a pagar por todos os itens: R$ " . number_format($totalAPagar, 2) . "\n";
echo '<br>';
?>