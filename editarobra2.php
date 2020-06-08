<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha biblioteca</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1 class="textocentralizado">Biblioteca Pessoal</h1>
    <h3>Dados</h3>
    <?php
    session_start();
    if (isset($_SESSION["logado"]) && $_SESSION["logado"] == 'sim') {
        if (isset($_POST['descricao']) && isset($_POST['ano']) 
        && isset($_POST['pessoa'])  && isset($_POST['tipo'])) {
            $id=$_POST['id'];
            $descricao = $_POST['descricao'];
            $ano = $_POST['ano'];
            $pessoa = $_POST['pessoa'];
            $tipo = $_POST['tipo'];

            //montar a instrução SQL
            $sql="update tbobras set 
            descricao = '$descricao',
            ano = $ano,
            idpessoa = $pessoa,
            tipo = '$tipo'
            where id=$id";
            //echo $sql;
            require_once "conexao.php";
            $conn->exec($sql);
            echo "<p>Salvo com sucesso</p>";
            echo "<a href='validarlogin.php'>Voltar</a>";
        } else {
            echo "<p>Erro ao receber dados</p>";
            echo "<a href='validarlogin.php'>Voltar</a>";
        }
    }else {
        echo "<h3>Se gostou das obras, cadastre-se para realizar empréstimos!</h3>";
        echo "<a href='cadpessoa.php'>Cadastre-se</a>";
        echo "  ou  ";
        echo "<a href='login.php'>Faça o login</a><br>";
        echo "<a href='index.html'>Home</a><br>";
    }
    ?>
</body>

</html>