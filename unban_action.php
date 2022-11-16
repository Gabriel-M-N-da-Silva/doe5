<?php
    include('conn.php');
    session_start();

    date_default_timezone_set('America/Sao_Paulo');
    $dateToday = date('Y-m-d h:i:s', time());
    $date = isset($_GET['dateBan'])? $_GET['dateBan'] : "0000-01-01";
    $emailUnban = isset($_GET['emailUnban'])? $_GET['emailUnban'] : "";
    $admin = isset($_GET['idAdminban'])? $_GET['idAdminban'] : 1;
    $search = $conn->query("SELECT U.id, U.email, B.dataHoraBanimento, B.dataHoraUnban, B.idAdmin FROM TBUsuario U INNER JOIN TBBanimento B ON U.id = B.idUsuario WHERE email = '".$emailUnban."';");
    
    if($search->num_rows > 0){
        while($row = $search->fetch_assoc()){

            $semUnban = is_null($row['dataHoraUnban']);
            $dataHoraBanimentoEncontrada = str_contains($row['dataHoraBanimento'],$date);

            if($semUnban AND $dataHoraBanimentoEncontrada AND $row['idAdmin'] == $admin){
                $id = $row['id'];
                $date = $row['dataHoraBanimento'];
                break;
            }
        }

    }
    
    if(strlen($date) <= strlen("0000-01-01")){
        echo "Registro não encontrado";
    } else {
        $sqlAlter= "UPDATE TBBanimento 
                    SET dataHoraUnban ='".$dateToday."'
                    WHERE idUsuario = ".$id." AND dataHoraBanimento = '".$date."' AND idAdmin = ".$admin;
        $action = $conn->query($sqlAlter);
        

        //Input $emailUnban and $reason into TBbanimento
        if($emailUnban != "" && !(strlen($date) <= strlen("0000-01-01")) != "" && $admin != ""){
            if(isset($action) AND $action === TRUE){
                echo "Registro alterado com sucesso!";
            } else{
                echo "Erro ao alterar registro. ERRO: " . $conn->error;
            }
        } else{
            echo "<script>alert('Favor inserir dados!');</script>";
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