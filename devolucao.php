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
    <?php
    session_start();
    if(isset($_SESSION["logado"]) && $_SESSION["logado"] == 'sim'){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            //montar a instrução SQL
            $sql="update tbemprestimos 
            set datahoradevolucao=now()
            where id=$id";
            //echo $sql;
            require_once "conexao.php";
            $conn->exec($sql);
            echo "<p>Devolução realizada com sucesso</p>";
            header("location:cademprestimo.php");
        } else {
            echo "<p> Erro aos receber os dados!!! <p>";
            echo "<a href='validarlogin.php'>Voltar</a>";
        }
    } else {
        echo "<h3>Se gostou das obras, cadastre-se para realizar empréstimos!</h3>";
        echo "<a href='cadpessoa.php'>Cadastre-se</a>";
        echo "  ou  ";
        echo "<a href='login.php'>Faça o login</a><br>";
        echo "<a href='index.html'>Home</a><br>";
    }
    ?>
    <br>
    <a href="cademprestimo.php">Voltar</a><br>
    <a href="index.php">Home</a><br>
</body>

</html>