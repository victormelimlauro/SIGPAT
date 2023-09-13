<!DOCTYPE html>
<html>
<head>
    <title>Exemplo de Tabelas em HTML</title>
</head>
<body>
    <h1>Selecione uma tabela:</h1>
    <form method="post" action="">
        <select name="tabela">
            <option value="tabela1">Tabela 1</option>
            <option value="tabela2">Tabela 2</option>
            <option value="tabela3">Tabela 3</option>
        </select>
        <input type="submit" name="submit" value="Exibir Tabela">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $tabela = $_POST['tabela'];

        switch ($tabela) {
            case 'tabela1':
                echo '<h2>Tabela 1</h2>';
                echo '<table border="1">
                        <tr>
                            <th>Coluna 1</th>
                            <th>Coluna 2</th>
                        </tr>
                        <tr>
                            <td>Dado 1.1</td>
                            <td>Dado 1.2</td>
                        </tr>
                        <tr>
                            <td>Dado 1.3</td>
                            <td>Dado 1.4</td>
                        </tr>
                    </table>';
                break;
            case 'tabela2':
                echo '<h2>Tabela 2</h2>';
                echo '<table border="1">
                        <tr>
                            <th>Coluna A</th>
                            <th>Coluna B</th>
                        </tr>
                        <tr>
                            <td>Dado A.1</td>
                            <td>Dado A.2</td>
                        </tr>
                        <tr>
                            <td>Dado A.3</td>
                            <td>Dado A.4</td>
                        </tr>
                    </table>';
                break;
            case 'tabela3':
                echo '<h2>Tabela 3</h2>';
                echo '<table border="1">
                        <tr>
                            <th>Nome</th>
                            <th>Idade</th>
                        </tr>
                        <tr>
                            <td>João</td>
                            <td>30</td>
                        </tr>
                        <tr>
                            <td>Maria</td>
                            <td>25</td>
                        </tr>
                    </table>';
                break;
            default:
                echo '<p>Selecione uma tabela válida.</p>';
                break;
        }
    }
    ?>
</body>
</html>
