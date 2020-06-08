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
    if (isset($_SESSION["logado"]) && $_SESSION["logado"] == 'sim') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "Select * from tbobras where id=$id";
            require_once "conexao.php";
            $result = $conn->query($sql);
            $dados = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dados as $linha) { ?>
                <form name="form1" action="editarobra2.php" method="POST">
                    <label>Id: </label><?php echo $linha['id']; ?> <br>
                    <input type="hidden" name="id" value="<?php echo $linha['id']; ?>">
                    <label>Descrição</label><input type="text" name="descricao" value="<?php echo $linha['descricao']; ?>" placeholder="Digite a descrição" required><br><br>
                    <label>Ano</label><input type="number" name="ano" value="<?php echo $linha['ano']; ?>" placeholder="Digite o ano" required><br><br>
                    <label>Pessoa</label>
                    <!-- <input type="text" name="pessoa" value="" placeholder="Digite a Pessoa" required><br><br> -->
                    <select name="pessoa">
                    <?php
                    $sqlpessoas="Select * from tbpessoas order by nome";
                    require_once "conexao.php";
                    $resultpessoas = $conn->query($sqlpessoas);
                    $dadospessoas = $resultpessoas->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($dadospessoas as $linhapessoa) {
                        if($linha["idpessoa"]==$linhapessoa["id"])
                            echo "<option value='".$linhapessoa["id"]."' selected>";
                        else
                            echo "<option value='".$linhapessoa["id"]."'>";
                        echo $linhapessoa["nome"]."</option>";                
                    }
                    ?>
                    </select><br><br>    
                    <label>Tipo</label>
                    <select name="tipo">
                        <option value="Livro">Livros</option>
                        <option value="Revista">Revistas</option>
                        <option value="Jogo">Jogos</option>
                        <option value="Software">Softwares</option>
                        <option value="Equipamento">Equipamentos</option>
                        <option value="Outros">Outros itens</option>
                        <?php
                            echo "<option value='".$linha["tipo"]."' selected>".$linha["tipo"]."</option>";
                        ?>
                    </select>
                    <br><br>
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