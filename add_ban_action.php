<?php
    include('conn.php');
    session_start();

    //Data-hora atual
    date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d h:i:s', time());


    //Email do usuário que foi banido
    $emailAdd = isset($_GET['emailAdd'])? $_GET['emailAdd'] : "";

    //Motivo pelo qual o usuário foi banido
    $reason= isset($_GET['reason'])? $_GET['reason'] : "";

    //ID da pessoa que está sendo banida
    $idPes = $conn->query("SELECT id FROM TBUsuario WHERE email = '".$emailAdd."';");
    
    //Guarda o ID coletado em idPes na variavel $id
    if($idPes->num_rows > 0){
        while($row = $idPes->fetch_assoc()){
            $id = $row['id'];
        }
    }
    
    //Script da inserção do usuário na tabela de banidos
    $sqlAdd= "INSERT INTO TBBanimento VALUES('".$reason."','".$id."','1','".$date."', NULL)";


    //Inserção do usuário na tabela de banidos se email e motivo não forem vazios
    if($emailAdd != "" && $reason != ""){
        if($conn->query($sqlAdd) === TRUE){
            echo "Usuário banido com sucesso!";
        } else{
            echo "Erro ao banir usuário. ERRO: " . $conn->error;
        }
    } else{
        echo "<script>alert('Favor inserir email e motivo');</script>";
    }
?>

<html>
    <head><title>Doe em 5</title></head>
    <body>
        <br>
        <a href="ban_screen.php">Voltar</a>    
    </body>
</html>