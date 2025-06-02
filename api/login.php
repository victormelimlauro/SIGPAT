<?php
session_start();
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

try {
    // Conectar ao banco de dados
    include "../DAO/MySQL.php";
    $mysql = new Mysql();

    // Verificar se os dados foram enviados via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Depuração: Verificar o método da requisição
        error_log("Método da requisição: " . $_SERVER['REQUEST_METHOD']);

        // Capturar e depurar os dados recebidos
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Depuração: Exibir os dados recebidos
        error_log("Dados recebidos: ");
        error_log("Username: " . $username);
        error_log("Password: " . $password);

        // Preparar a consulta SQL
        $sql = "SELECT cod_usuario, nome FROM usuarios WHERE username = ? AND senha = ?";
        $stmt = $mysql->prepare($sql);
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, sha1($password)); // Usar SHA1 para a senha
        $stmt->execute();

        // Verificar se o usuário foi encontrado
        $user = $stmt->fetchObject();

        // Depuração: Verificar se o usuário foi encontrado
        if ($user) {
            // Armazenar informações do usuário na sessão
            $_SESSION["usuario_logado"] = $user->cod_usuario;

            // Retornar sucesso e dados do usuário
            echo json_encode([
                'status' => 'success',
                'user' => [
                    'id' => $user->cod_usuario,
                    'name' => $user->nome
                ]
            ]);
        } else {
            // Retornar erro de autenticação
            echo json_encode([
                'status' => 'error',
                'message' => 'Usuário ou senha inválidos.'
            ]);
        }
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