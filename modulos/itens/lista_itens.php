<?php 

session_start();

if(!isset($_SESSION["usuario_logado"]))
    header("Location: login.php");


try {

    include "../../DAO/ItemDAO.php";

    $item_dao = new ItemDAO();

    $lista_itens = $item_dao->getAllRows();

    $total_itens = count($lista_itens);

    //var_dump($lista_itens);
} catch(Exception $e) {

    echo $e->getMessage();

}
?>
<html>
    <head>
        <title> Listar produtos </title>
    </head>

    <body>
        <?php include '../../includes/cabecalho.php' ?>

        <main>
        <table>
                <thead>
                    <tr>
                        <th>Codigo Item</th>
                        <th>Nome:</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<$total_itens; $i++): ?>
                    <tr>
                        <td> <?= $lista_itens[$i]->cod_item ?> </td>
                        <td> <?= $lista_itens[$i]->nome_item ?> </td>
                        <td> 
                            <a href="cadastrar_item.php?cod_item=<?= $lista_itens[$i]->cod_item ?>">
                                Editar</a> 
                        </td>
                        <td> 
                            <a href="cadastrar_item.php?excluir=true&cod_item=<?= $lista_itens[$i]->cod_item ?>">
                                Excluir</a> 
                        </td>
                    </tr>
                    <?php endfor ?>
                </tbody>
            </table>



        </main>

        <?php include '../../includes/rodape.php' ?>
    </body>
</html>