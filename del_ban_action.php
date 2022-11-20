<?php
    include('conn.php');
    session_start();

    //Dados do usuário que vai ter o registro de banimento deletado
    $date = isset($_GET['date'])? $_GET['date'] : "0000-01-01";
    $emailAdd = isset($_GET['emailAdd'])? $_GET['emailAdd'] : "";
    $admin = isset($_GET['idAdmin'])? $_GET['idAdmin'] : 1;
    $search = $conn->query("SELECT U.id, U.email, B.dataHoraBanimento, B.dataHoraUnban, B.idAdmin FROM TBUsuario U INNER JOIN TBBanimento B ON U.id = B.idUsuario WHERE email = '".$emailAdd."';");
    
    if(isset($_GET['deleteId'])){
        $deleteId = $_GET['deleteId'];
        $deleteDataHoraBan = $_GET['deleteDataHoraBan'];
        $sqlDelete = "DELETE FROM tbbanimento WHERE dataHoraBanimento = '".$deleteDataHoraBan."' AND idUsuario = ".$deleteId;
        $action = $conn->query($sqlDelete);

        if($action){
            echo "Registro deletado com sucesso!";
        } else {
            echo "Houve um erro ao deletar o registro!";
        }

    }
?>

<html>
    <head><title>Doe em 5</title></head>
    <body>
        <br>
        <a href="ban_screen.php">Voltar</a>    
    </body>
</html>