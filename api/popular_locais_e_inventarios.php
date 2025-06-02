<?php
session_start();
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

try {
    // Conectar ao banco de dados
    //include "../DAO/MySQL.php";
    include "../DAO/LocalDAO.php";
    include "../DAO/InventarioDAO.php"; // Certifique-se de ter esse arquivo criado
    //$mysql = new Mysql();
    $localDAO = new LocalDAO();
    $inventarioDAO = new InventarioDAO(); // Instância do DAO de inventário

    // Verificar se os dados foram enviados via GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Depuração: Verificar o método da requisição
        error_log("Método da requisição: " . $_SERVER['REQUEST_METHOD']);

        // Popular lista de locais
        $locais = $localDAO->getAllRows();
        
        // Popular lista de inventários
        $inventarios = $inventarioDAO->getAllRows(); // Método getAllRows deve ser implementado no InventarioDAO

        // Retornar sucesso com dados das listas
        echo json_encode([
            'status' => 'success',
            'locais' => $locais,
            'inventarios' => $inventarios
        ]);
    } else {
        // Método não permitido
        echo json_encode([
            'status' => 'error',
            'message' => 'Método não permitido.'
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