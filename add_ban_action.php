<?php
    include('conn.php');
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d h:i:s', time());
    $emailAdd = isset($_GET['emailAdd'])? $_GET['emailAdd'] : "";
    $reason= isset($_GET['reason'])? $_GET['reason'] : "";
    $idPes = $conn->query("SELECT id FROM TBUsuario WHERE email = '".$emailAdd."';");
    
    if($idPes->num_rows > 0){
        while($row = $idPes->fetch_assoc()){
            $id = $row['id'];
        }
    }
    
    $sqlAdd= "INSERT INTO TBBanimento VALUES('".$reason."','".$id."','1','".$date."', NULL)";
    $action = $conn->query($sqlAdd);

    //Input $emailAdd and $reason into TBbanimento
    if($emailAdd != "" && $reason != ""){
        if($action === TRUE){
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