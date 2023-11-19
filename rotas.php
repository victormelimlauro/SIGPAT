<?php

try {
    switch($uri_parse)
    {
        case '/':
            echo "sou a tela inicial";

        break;
        case '/itens':
            include 'Views/modulos/produtos/listar_produtos.php';
            echo "listar produtos";

        break;

        case "produto/salvar":
            echo "vair salvar um produto";
        break;

        case 'produto/remover';
            echo "vai remover um produto";
        break;

        default:
            echo "rota inválida";
        break;
    }

} catch (Exception $e) {
    echo "Deu ruim " . $e ->getMessage();
}