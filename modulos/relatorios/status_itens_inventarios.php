<?php 

session_start();

if(!isset($_SESSION["usuario_logado"]))
    header("Location: login.php");


try {



    /**
     * Obtendo os inventários
     */
    include "../../DAO/InventarioDAO.php";

    $inventario_dao = new InventarioDAO();

    $lista_inventarios = $inventario_dao->getAllRows();

    $total_inventarios = count($lista_inventarios);

   //var_dump($lista_inventarios);
   //var_dump($_POST['cod_inventario']);

    if (isset($_POST['opcao'])) {
        $opcao = $_POST['opcao'];

        switch ($opcao) {
            case 'itensLocalCorreto':
               // $mensagem = "Você selecionou a Opção 1.";
                include "../../DAO/RelatorioDAO.php";
    
                $Relatorio_dao = new RelatorioDAO();
        
               // $nome_local = $_POST["nome_local"];
        
        
                $dados_relatorio = array (
                'cod_inventario' => $_POST["cod_inventario"],
                );
                
                $lista_relatorio = $Relatorio_dao ->getitensLocalCorreto($dados_relatorio);
                $total_relatorios = count($lista_relatorio);
                // var_dump($lista_relatorio);
                break;
            case 'itensLocalDivergente':
                //$mensagem = "Você selecionou a Opção 2.";
                include "../../DAO/RelatorioDAO.php";
    
                $Relatorio_dao = new RelatorioDAO();
        
               // $nome_local = $_POST["nome_local"];
        
        
                $dados_relatorio = array (
                'cod_inventario' => $_POST["cod_inventario"],
                );
                
                $lista_relatorio = $Relatorio_dao ->itensLocalDivergente($dados_relatorio);
                $total_relatorios = count($lista_relatorio);
                 //var_dump($lista_relatorio);
                break;
            case 'itensNaoLocalizados':
                //$mensagem = "Você selecionou a Opção 3.";
                include "../../DAO/RelatorioDAO.php";
    
                $Relatorio_dao = new RelatorioDAO();
        
               // $nome_local = $_POST["nome_local"];
        
        
                $dados_relatorio = array (
                'cod_inventario' => $_POST["cod_inventario"],
                );
                
                $lista_relatorio = $Relatorio_dao ->itensNaoLocalizados($dados_relatorio);
                $total_relatorios = count($lista_relatorio);
                 //var_dump($lista_relatorio);
                break;
            default:
                $mensagem = "Opção inválida.";
                break;
        }

        // echo '<p>' . $mensagem . '</p>';

    


           
    }


} catch(Exception $e) {

    echo $e->getMessage();

}
?>
<head>
    <title>Cadastro de produtos - TESTE</title>
</head>


<?php include '../../includes/cabecalho.php' ?>

<main class="container">
    <h1 class="mb-4">Relatórios de Inventários</h1>
    <form method="post" action="status_itens_inventarios.php">
    <div class="form-group">
        <label for="cod_inventario">Inventário:</label>
        <select class="form-control" id="cod_inventario" name="cod_inventario">
            <option>Selecione o Inventário</option>
            <?php for($i=0; $i<$total_inventarios; $i++): 
                $selecionado = isset($dados_relatorio['cod_inventario']) && $lista_inventarios[$i]->cod_inventario == $dados_relatorio['cod_inventario'] ? "selected" : "";
            ?>
                <option value="<?= $lista_inventarios[$i]->cod_inventario ?>" <?= $selecionado ?>>
                    <?= $lista_inventarios[$i]->nome_inventario ?> 
                </option>
            <?php endfor ?>
        </select>
    </div>

    <div class="form-group">
        <label for="opcao">Tipo de relatório:</label>
        <select class="form-control" id="opcao" name="opcao">
            <option>Selecione o local</option>
            <?php
                $opcao = isset($_POST['opcao']) ? $_POST['opcao'] : "";
            ?>
            <option value="itensLocalCorreto" <?= $opcao === "itensLocalCorreto" ? "selected" : "" ?>>Itens localizados no local correto</option>
            <option value="itensLocalDivergente" <?= $opcao === "itensLocalDivergente" ? "selected" : "" ?>>Itens localizados em local divergente</option> 
            <option value="itensNaoLocalizados" <?= $opcao === "itensNaoLocalizados" ? "selected" : "" ?>>Itens Não localizados</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Buscar relatório</button>
</form>

            <?php
    // Adicione o código abaixo para exibir as tabelas com base na opção selecionada

    if (isset($opcao)) {
        //var_dump($opcao);        
            // Exiba os dados do relatório aqui
            // Por exemplo, você pode criar uma tabela para cada opção selecionada.
            // Certifique-se de personalizar o conteúdo da tabela de acordo com seus dados.
            switch ($opcao) {
                case 'itensLocalCorreto':
                    // Exiba a tabela correspondente para 'itensLocalCorreto'
                   ?> 
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Código Operação</th>
                                <th scope="col">Código Local</th>
                                <th scope="col">Nome Local</th>
                                <th scope="col">Num. Plaqueta</th>
                                <th scope="col">Nome Item</th>
                                <th scope="col">Cód. Inventario</th>
                                <th scope="col">Nome Inventario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < $total_relatorios; $i++): ?>
                                <tr>
                                    <td><?= $lista_relatorio[$i]->cod_operacoes_inventarios ?></td>
                                    <td><?= $lista_relatorio[$i]->cod_local ?></td>
                                    <td><?= $lista_relatorio[$i]->nome_local ?></td>
                                    <td><?= $lista_relatorio[$i]->numpat_item ?></td>
                                    <td><?= $lista_relatorio[$i]->nome_item ?></td>
                                    <td><?= $lista_relatorio[$i]->cod_inventario ?></td>
                                    <td><?= $lista_relatorio[$i]->nome_inventario ?></td>
                                </tr>
                            <?php endfor ?>
                        </tbody>
                    </table>
    </div>
                
                <?php           
                    break;
                case 'itensLocalDivergente':
                    // Exiba a tabela correspondente para 'itensLocalDivergente'
                    ?>
                    <!-- Conteúdo da tabela para itensLocalDivergente -->
                        
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Codigo Operação</th>
                                <th>Codigo local encontrado</th>
                                <th>Nome Local encontrado</th>
                                <th>Codigo local cadastrado</th>
                                <th>Nome Local cadastrado</th>
                                <th>Num. Plaqueta</th>
                                <th>Nome item</th>
                                <th>Cod. Inventario</th>
                                <th>Nome Inventario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i=0; $i<$total_relatorios; $i++): ?>
                            <tr>
                                <td><?= $lista_relatorio[$i]->cod_operacoes_inventarios ?></td>
                                <td><?= $lista_relatorio[$i]->cod_local_encontrado ?></td>
                                <td><?= $lista_relatorio[$i]->nome_local_encontrado ?></td>
                                <td><?= $lista_relatorio[$i]->cod_local_cadastrado ?></td>
                                <td><?= $lista_relatorio[$i]->nome_local_cadastrado ?></td>
                                <td><?= $lista_relatorio[$i]->numpat_item ?></td>
                                <td><?= $lista_relatorio[$i]->nome_item ?></td>
                                <td><?= $lista_relatorio[$i]->cod_inventario ?></td>
                                <td><?= $lista_relatorio[$i]->nome_inventario ?></td>
                            </tr>
                            <?php endfor ?>
                        </tbody>
                    </table>
                </div>
                    <?php
                    break;
                case 'itensNaoLocalizados':
                    
                    // Exiba a tabela correspondente para 'itensNaoLocalizados'
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Codigo local</th>
                                    <th>Nome Local</th>
                                    <th>Num. Plaqueta</th>
                                    <th>Nome item</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($i=0; $i<$total_relatorios; $i++): ?>
                                <tr>
                                    <td><?= $lista_relatorio[$i]->cod_local ?></td>
                                    <td><?= $lista_relatorio[$i]->nome_local ?></td>
                                    <td><?= $lista_relatorio[$i]->numpat_item ?></td>
                                    <td><?= $lista_relatorio[$i]->nome_item ?></td>
                                </tr>
                                <?php endfor ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                          break;
                default:
                    // Opção inválida
                    echo '<p>Opção inválida.</p>';
                    break;
            }
        
    }
    ?>




           
        </main>

        <?php include '../../includes/rodape.php' ?>
