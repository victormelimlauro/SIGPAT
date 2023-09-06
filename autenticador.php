<?php

session_start();

try {

    include "DAO/MySQL.php";
    $mysql = new Mysql();

    //var_dump($mysql);

    //Stament SQL
    $sql="SELECT cod_usuario, nome FROM usuarios WHERE username=? AND senha=?";
    $stmt = $mysql->prepare($sql);
    $stmt ->bindValue(1, $_POST["user"]);
    $stmt ->bindValue(2, sha1($_POST["pass"]) );

    $stmt->execute();

    $dados_do_usuario = $stmt->fetchObject();

    if($dados_do_usuario) {

        $_SESSION["usuario_logado"] = $dados_do_usuario->cod_usuario;
        header("Location: index.php");
    } else {
        header("Location: login.php?falhou=true");
    }


} catch(Exception $e) {

    echo $e->getMessage();

}