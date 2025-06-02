<?php
session_start();
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

try {
    // Conectar ao banco de dados
    include "../DAO/MySQL.php"; // Certifique-se de que este arquivo existe e está configurado corretamente
    include "../DAO/OperacaoInventarioDAO.php"; // Inclua o DAO que contém o método de inserção

    $operacaoInventarioDAO = new OperacaoInventarioDAO(); // Instância do DAO de operações de inventário

    // Verificar se os dados foram enviados via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obter os dados da requisição
        $dados_operacao_inventario = json_decode(file_get_contents('php://input'), true);

        // Validar os dados recebidos
        if (isset($dados_operacao_inventario['numpat_item'], $dados_operacao_inventario['cod_inventario'], $dados_operacao_inventario['cod_local'], $dados_operacao_inventario['cod_usuario'])) {
            // Inserir os dados no banco de dados
            $operacaoInventarioDAO->insert($dados_operacao_inventario);

            // Retornar sucesso
            echo json_encode([
                'status' => 'success',
                'message' => 'Operação de inventário inserida com sucesso.'
            ]);
        } else {
            // Retornar erro se os dados não forem válidos
            echo json_encode([
                'status' => 'error',
                'message' => 'Dados inválidos. Certifique-se de que todos os campos necessários estão presentes.'
            ]);
        }
    } else {
        // Método não permitido
        echo json_encode([
            'status' => 'error',
            'message' => 'Método não permitido. Utilize POST para inserir dados.'
        ]);
    }
} catch (Exception $e) {
    // Retornar erro em caso de exceção
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>