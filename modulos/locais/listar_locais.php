<?php 

try {

    include "../../DAO/LocalDAO.php";

    $local_dao = new LocalDAO();

    $lista_locais = $local_dao->getAllRows();

    $total_locais = count($lista_locais);

} catch(Exception $e) {

    echo $e->getMessage();

}
?>
<html>
    <head>
        <title>Sistemas</title>
    </head>
    <body>
        <?php include '../../includes/cabecalho.php' ?>
        <main>
            <table>
                <thead>
                    <tr>
                        <th>Codigo local</th>
                        <th>Nome:</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<$total_locais; $i++): ?>
                    <tr>
                        <td> <?= $lista_locais[$i]->cod_local ?> </td>
                        <td> <?= $lista_locais[$i]->nome_local ?> </td>
                        <td> 
                            <a href="cadastrar_local.php?cod_local=<?= $lista_locais[$i]->cod_local ?>">
                                Editar</a> 
                        </td>
                        <td> 
                            <a href="cadastrar_local.php?excluir=true&cod_local=<?= $lista_locais[$i]->cod_local ?>">
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
