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
    $id=0;
    if (isset($_SESSION["logado"]) && $_SESSION["logado"] == 'sim') {
        $id=$_SESSION["idusuario"];
        if(isset($_GET['id']))
            $id=$_GET['id']; 
        if($id<>0){
            $sql="Select * from tbpessoas where id=$id";
            require_once "conexao.php";
            $result = $conn->query($sql);
            $dados = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dados as $linha) { ?>
                <form name="form1" action="editarpessoa2.php" method="POST">
                <label>Id: </label><?php echo $linha['id']; ?> <br>
                <input type="hidden" name="id" value="<?php echo $linha['id']; ?>">
                <label>Nome</label><input type="text" name="nome" 
                    value="<?php echo $linha['nome']; ?>" placeholder="Digite o nome" required><br><br>
                <label>E-mail</label><input type="email" name="email" 
                    value="<?php echo $linha['email']; ?>" placeholder="Digite o e-mail" required><br><br>
                <label>Telefone</label><input type="text" name="telefone" 
                    value="<?php echo $linha['telefone']; ?>" placeholder="Digite o telefone" required><br><br>
                <label>Senha</label><input type="password" name="senha" 
                    value="<?php echo $linha['senha']; ?>" placeholder="Digite a senha" required><br><br>
                <label>Onde você estuda(ou)</label><input type="text" name="estudo" 
                    value="<?php echo $linha['estudos']; ?>" 
                    placeholder="Digite onde você estuda(ou)" required><br><br>
                <input type="submit" value="Enviar">
                <input type="reset" value="Cancelar">
                </form>
            <?php 
            }
        echo "<br><a href='validarlogin.php'>Voltar</a>";
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