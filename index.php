<?php

session_start();

if(!isset($_SESSION["usuario_logado"])) {

 header("Location: login.php");
}

if(isset($_GET["sair"])) {
    var_dump($_GET["sair"]);
    unset($_SESSION["usuario_logado"]);
    header("Location: login.php");
}

/* $uri =$_SERVER['REQUEST_URI'];

echo($uri);

echo '<hr />';  */

$uri_parse = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

echo $uri_parse;
include 'rotas.php';




?>

<html>
    <head>
        <title>Sistemas</title>
    </head>
    <body>
        <?php include 'includes/cabecalho.php' ?>
        <main>
<a>INDEX PAGE</a>
        </main>

        <footer></footer>
    </body>
</html>

<!-- <h1> Bem vindo <strong> <?= $dados_do_usuario->nome ?> </strong> ( <?= $dados_do_usuario->cod_usuario ?> - <?= $dados_do_usuario->username ?>) a area restrita</h1>

<a href="cadastrar_local.php"> Cadastrar local </a>
<a href="listar_locais.php"> Listar locais </a>
<a href="index.php?sair=true"> Sair </a> -->