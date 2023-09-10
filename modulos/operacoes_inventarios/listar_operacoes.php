<?php 

try {

    include "../../DAO/OperacaoInventarioDAO.php";

    $OperacaoInventario_dao = new OperacaoInventarioDAO();

    $lista_OperacaoInventario = $OperacaoInventario_dao->getAllRows();

    $total_itens = count($lista_OperacaoInventario);

    var_dump($lista_OperacaoInventario);
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
                        <th>Codigo operação</th>
                        <th>Cod. Local:</th>
                        <th>Nome local:</th>
                        <th>Num. Pat. Item</th>
                        <th>Nome Item</th>
                        <th>Cod. Inventario</th>
                        <th>Nome Item</th>
                        <th>Cod. Usuário</th>
                        <th>Nome Usuário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<$total_itens; $i++): ?>
                    <tr>
                        <td> <?= $lista_OperacaoInventario[$i]->cod_operacoes_inventarios ?> </td>
                        <td> <?= $lista_OperacaoInventario[$i]->cod_local ?> </td>
                        <td> <?= $lista_OperacaoInventario[$i]->nome_local ?> </td>
                        <td> <?= $lista_OperacaoInventario[$i]->numpat_item ?> </td>
                        <td> <?= $lista_OperacaoInventario[$i]->nome_item ?> </td>
                        <td> <?= $lista_OperacaoInventario[$i]->cod_inventario ?> </td>
                        <td> <?= $lista_OperacaoInventario[$i]->nome_inventario ?> </td>
                        <td> <?= $lista_OperacaoInventario[$i]->cod_usuario ?> </td>
                        <td> <?= $lista_OperacaoInventario[$i]->nome ?> </td>
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
