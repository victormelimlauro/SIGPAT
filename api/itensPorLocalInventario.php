<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *"); // Permitir acesso de qualquer origem
header("Access-Control-Allow-Methods: GET"); // Permitir apenas requisições GET

include "../DAO/MySQL.php"; // Certifique-se de que este arquivo existe e está configurado corretamente
include "../DAO/OperacaoInventarioDAO.php"; // Inclua o DAO que contém o método de inserção

// Verifica se os parâmetros foram passados
if (isset($_GET['codigoInventario']) && isset($_GET['codigoLocal'])) {
    $codigoInventario = $_GET['codigoInventario'];
    $codigoLocal = $_GET['codigoLocal'];

    // Cria uma instância do DAO
    $dao = new OperacaoInventarioDAO();

    // Prepara os dados para passar para os métodos
    $dados_operacao_inventario = [
        'cod_inventario' => $codigoInventario,
        'cod_local' => $codigoLocal
    ];

    // Obtém os itens localizados e não localizados
    $itensNaoLocalizados = $dao->itensNaoLocalizadosNoSetor($dados_operacao_inventario);
    $itensLocalizados = $dao->itensLocalizadosNoSetor($dados_operacao_inventario);

    // Prepara a resposta
    $response = [
        'itensNaoLocalizados' => $itensNaoLocalizados,
        'itensLocalizados' => $itensLocalizados
    ];

    // Retorna a resposta em formato JSON
    echo json_encode($response);
} else {
    // Retorna um erro se os parâmetros não forem fornecidos
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Parâmetros faltando: codigoInventario e codigoLocal são obrigatórios.']);
}
?>