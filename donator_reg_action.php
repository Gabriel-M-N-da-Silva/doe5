<?php
    include('conn.php');
    session_start();

    $nome = isset($_GET['nome'])? $_GET['nome'] : "";

    //Email do usuário cadastrado
    $emailAdd = isset($_GET['emailAdd'])? $_GET['emailAdd'] : "";
    
    //Senha do usuário cadastrado
    $senhaAdd = isset($_GET['senhaAdd'])? $_GET['senhaAdd'] : "";
    $senhaConfirm = isset($_GET['confirmaSenha'])? $_GET['confirmaSenha'] : "";
    
    //Telefone do usuário cadastrado
    $phone = isset($_GET['fone'])? $_GET['fone'] : "";

    //Data de nascimento
    $dataNasc = isset($_GET['dataNasc'])? $_GET['dataNasc'] : "";
    

    $ultimoId = $conn->query("SELECT id FROM TBUsuario order by id desc limit 1;");

    //Guarda o ID coletado em idPes na variavel $id
    if($ultimoId->num_rows > 0){
        while($row = $ultimoId->fetch_assoc()){
            $id = $row['id']+1;
        }
    }
    
    //Script da inserção do usuário na tabela de banidos
    $sqlAdd= "INSERT INTO TBUsuario VALUES('".$id."','".$emailAdd."','".$senhaAdd."','".$nome."','".$phone."','".$dataNasc."')";

    //Inserção do usuário na tabela de banidos se email e motivo não forem vazios
    if($nome != "" && $emailAdd != "" && $senhaAdd != "" && $dataNasc != "" && ($senhaAdd == $senhaConfirm)){
        if($conn->query($sqlAdd) === TRUE){
            echo "<h1><span id='success'>Sucesso!</span><br>Usuário cadastrado</h1>";
        } else{
            echo "<h1><span id='unsuccess'>Erro!</span><br>Não foi possível cadastrar usuário " . $conn->error . "</h1>";
        }
    } else{
        echo "<script>alert('Favor inserir dados corretamente);</script>";
    }
?>

<html>
    <head>
        <title>Doe em 5</title>
        <link rel="stylesheet" href="./assets/styles/reg_donator_result.css">
    </head>
    <body>
        <br>
        <a id="return-login" href="index.php">Retornar para login</a>
    </body>
</html>