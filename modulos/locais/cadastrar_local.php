<?php 

session_start();

if(!isset($_SESSION["usuario_logado"]))
    header("Location: login.php");
    
try {

    if(isset($_GET['salvar']))
    //Verifica se o SALVAR vindo da URL está setado para lançar alterações no BD
    {

        include "../../DAO/LocalDAO.php";

        $local_dao = new LocalDAO();

       // $nome_local = $_POST["nome_local"];


        $dados_local = array (
        'nome_local' => $_POST["nome_local"]
        );

       if(!empty($_POST['cod_local']))  {
        // Verifica se está setado via POST vindo do formulário o valor COD_LOCAL para realizar UPDADE ou INSERT 

            $dados_local['cod_local'] = $_POST["cod_local"];

            $local_dao ->update($dados_local);

            echo"Atualizado";
            var_dump($_POST);
            header("Location: listar_locais.php");
       } else {
        
        $local_dao->insert($dados_local);
        var_dump($dados_local);
           echo"Inserido";
           header("Location: listar_locais.php");
       }


    }

    if(isset($_GET['excluir']))
    {
        include "../../DAO/LocalDAO.php";

        $local_dao = new LocalDAO();

        $local_dao->delete($_GET["cod_local"]);
        // var_dump($_GET["cod_local"]);
        header("Location: listar_locais.php");
    }

    /**
     * A função abaixo retorna dados do BD com base no parametro ID passado via método GET na URL
     */

    if(isset($_GET['cod_local']))
    {
    echo"GET BY ID";
        include "../../DAO/LocalDAO.php";

        $local_dao = new LocalDAO();

        $dados_local = $local_dao->getById($_GET["cod_local"]);
       // var_dump($dados_local);
        
    }

} catch(Exception $e) {

    echo $e->getMessage();

}
?>



<?php include '../../includes/cabecalho.php' ?>

    <div class="container">
        <main>
            <h1 class="mt-4 mb-4">Cadastro de Local</h1>
            <form method="post" action="cadastrar_local.php?salvar=true">
                <div class="form-group">
                    <label for="cod_local">Código do Local:</label>
                    <input name="cod_local" value="<?= isset($dados_local) ? $dados_local->cod_local : NULL ?>" type="text" class="form-control" readonly/>
                </div>
                <div class="form-group">
                    <label for="nome_local">Nome do Local:</label>
                    <input name="nome_local" value="<?= isset($dados_local) ? $dados_local->nome_local : "" ?>" type="text" class="form-control" />
                </div>
                <div class="form-group">
                    <a href="cadastrar_local.php?excluir=true&cod_local=<?= $dados_local->cod_local ?>" class="btn btn-danger">Excluir</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </main>
    </div>
    <?php include '../../includes/rodape.php' ?>

    <!-- Adicione o Bootstrap JS e jQuery se necessário -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>
