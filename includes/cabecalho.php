<?php 

if(!isset($_SESSION))
    session_start();
try {

    //echo dirname(__FILE__);

    //$caminho_base = dirname(__FILE__);

    $caminho = dirname(__FILE__) . '/../DAO/MySQL.php';

    var_dump(is_file($caminho));

    include_once  dirname(__FILE__) . '/../DAO/MySQL.php';
    $mysql = new Mysql();
    
    //var_dump($mysql);
    
    //Stament SQL
    $sql="SELECT cod_usuario, nome, username FROM usuarios WHERE cod_usuario=:marcador_cod_usuario";
    $stmt = $mysql->prepare($sql);
    
    $stmt->execute(array('marcador_cod_usuario' =>$_SESSION['usuario_logado']));
    
    $dados_do_usuario = $stmt->fetchObject();
    
    
    } catch(Exception $e) {
    
    echo $e->getMessage();
    
    }
?>
<header>
    <h1>SIGPAT
        <small> Sistema de gestão do patrimonio</small>
    </h1>

    <fieldset>
        <legend> Dados do usuario </legend>
        Bem vindo <strong> <?= $dados_do_usuario->nome ?> </strong> ( <?= $dados_do_usuario->cod_usuario ?> - <?= $dados_do_usuario->username ?>) a area restrita <a href="index.php?sair=true"> Sair </a>
    </fieldset>
    <nav>
        <ul>
            <li> <a href="index.php">Tela inicial</a></li>

            <li> <a href="/modulos/local/cadastrar_local.php">Cadastrar Local</a></li>
            <li> <a href="/modulos/local/listar_locais.php">Listar Locais</a></li>

            <li> <a href="#">Cadastrar tipo</a></li>
            <li> <a href="#">Listar Tipos</a></li>

            <li> <a href="/modulos/itens/cadastrar_item.php">Cadastrar ativo</a></li>
            <li> <a href="/modulos/itens/lista_itens.php">Listar ativos</a></li>
        </ul>
    </nav>
<hr>
</header>