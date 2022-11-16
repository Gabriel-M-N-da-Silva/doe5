<?php
    include('conn.php');
    session_start();
    $date = isset($_GET['date'])? $_GET['date'] : "0000-01-01";
    $emailAdd = isset($_GET['emailAdd'])? $_GET['emailAdd'] : "";
    $admin = isset($_GET['idAdmin'])? $_GET['idAdmin'] : 1;
    $search = $conn->query("SELECT U.id, U.email, B.dataHoraBanimento, B.dataHoraUnban, B.idAdmin FROM TBUsuario U INNER JOIN TBBanimento B ON U.id = B.idUsuario WHERE email = '".$emailAdd."';");
    
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
        $sqlDel= "DELETE FROM TBBanimento 
                  WHERE idUsuario = ".$id." AND dataHoraBanimento = '".$date."' AND idAdmin = ".$admin;
        $action = $conn->query($sqlDel);
        
        //Input $emailAdd and $reason into TBbanimento
        if($emailAdd != "" && !(strlen($date) <= strlen("0000-01-01")) != "" && $admin != ""){
            if(isset($action) AND $action === TRUE){
                echo "Registro deletado com sucesso!";
            } else{
                echo "Erro ao deletar registro. ERRO: " . $conn->error;
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