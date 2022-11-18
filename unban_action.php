<?php
    include('conn.php');
    session_start();

    // Data-hora atual
    date_default_timezone_set('America/Sao_Paulo');
    $dateToday = date('Y-m-d h:i:s', time());
    //Data de BANIMENTO
    $date = isset($_GET['dateBan'])? $_GET['dateBan'] : "0000-01-01";
    //Email do usuário banido
    $emailUnban = isset($_GET['emailUnban'])? $_GET['emailUnban'] : "";
    //ID do admin que BANIU o usuário a ser desbanido
    $admin = isset($_GET['idAdminban'])? $_GET['idAdminban'] : 1;
    //Select dos dados usuário que será desbanido onde email = $emailUnban
    $search = $conn->query("SELECT U.id, U.email, B.dataHoraBanimento, B.dataHoraUnban, B.idAdmin FROM TBUsuario U INNER JOIN TBBanimento B ON U.id = B.idUsuario WHERE email = '".$emailUnban."';");
    
    if($search->num_rows > 0){
        while($row = $search->fetch_assoc()){

            // Se ele já não foi desbanido
            $semUnban = is_null($row['dataHoraUnban']);
            // E já foi banido
            $dataHoraBanimentoEncontrada = str_contains($row['dataHoraBanimento'],$date);

            //Coleta id e data de banimento do usuário
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
        // UPDATE da data de desbanimento do usuário para a data e hora de agora
        $sqlAlter= "UPDATE TBBanimento 
                    SET dataHoraUnban ='".$dateToday."'
                    WHERE idUsuario = ".$id." AND dataHoraBanimento = '".$date."' AND idAdmin = ".$admin;
        $action = $conn->query($sqlAlter);
        

        //Mensagem de erro ou sucesso
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