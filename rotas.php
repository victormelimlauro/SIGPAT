<?php

try {
    switch($uri_parse)
    {
        case '/':
            echo "sou a tela inicial";
            include 'Views/modulos/Inicio/inicio.php';

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

        case '/inicio';
            echo "rota INICIO" ;
            include 'Views/modulos/Inicio/inicio.php';
        break;

        default:
            echo "rota inválida";
            include 'Views/modulos/Inicio/inicio.php';
        break;
    }

} catch (Exception $e) {
    echo "Deu ruim " . $e ->getMessage();
}