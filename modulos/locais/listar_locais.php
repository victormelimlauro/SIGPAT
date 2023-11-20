<?php 

session_start();

if(!isset($_SESSION["usuario_logado"]))
    header("Location: login.php");

try {

    include "../../DAO/LocalDAO.php";

    $local_dao = new LocalDAO();

    $lista_locais = $local_dao->getAllRows();

    $total_locais = count($lista_locais);

} catch(Exception $e) {

    echo $e->getMessage();

}
?>



<?php include '../../includes/cabecalho.php' ?>

<main class="container">
    <h1 class="mb-4">Listar Locais</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Código Local</th>
                <th scope="col">Nome</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php for($i=0; $i<$total_locais; $i++): ?>
            <tr>
                <td><?= $lista_locais[$i]->cod_local ?></td>
                <td><?= $lista_locais[$i]->nome_local ?></td>
                <td>
                    <a href="cadastrar_local.php?cod_local=<?= $lista_locais[$i]->cod_local ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="cadastrar_local.php?excluir=true&cod_local=<?= $lista_locais[$i]->cod_local ?>" class="btn btn-danger btn-sm">Excluir</a>
                </td>
            </tr>
            <?php endfor ?>
        </tbody>
    </table>
</main>

<?php include '../../includes/rodape.php' ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
