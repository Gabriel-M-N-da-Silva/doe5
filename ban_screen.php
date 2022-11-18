<html>

    <head>
        <title>Doe 5</title>
        <link rel="stylesheet" href="./assets/banv1.css">
    </head>

    <!--Form de dados de conta SENDO BANIDA - Banimento -->
    <form name="ban" action="add_ban_action.php" method="get">
        <h2>Banir usuário</h2>
        <div>
            <!--Email do USUÁRIO que foi banido-->
            <h6>Email: </h6>
            <input name="emailAdd" type="searchbar">
        </div>
        <div>
            <h6>Motivo: </h6>
            <input name="reason" type="text">
        </div>
        <input type="submit" value="Banir">
    </form>
    
    <!--Form de dados de REGISTRO DE BANIMENTO SENDO DELETADO - Apagar registro -->
    <form name="ban" action="del_ban_action.php" method="get">
        <h2>Deletar banimento</h2>
        <div>
            <!--Email do USUÁRIO que foi banido-->
            <h6>Email: </h6>
            <input name="emailAdd" type="email">
        </div>
        <div>
            <h6>Data do banimento: </h6>
            <input name="date" type="date">
        </div>
        <div>
            <!--Id do admin que BANIU o usuário-->
            <h6>ID admin: </h6>
            <input name="idAdmin" type="number" min=1>
        </div>
        <input type="submit" value="Deletar banimento">
    </form>

    <!--Form de dados de USUÁRIO recebendo UNBAN - Unban -->
    <form name="ban" action="unban_action.php" method="get">
        <h2>Unban de usuário</h2>
        <div>
            <h6>Email: </h6>
            <input name="emailUnban" type="email">
        </div>
        <div>
            <h6>Data do banimento: </h6>
            <input name="dateBan" type="date">
        </div>
        <div>
            <h6>ID admin: </h6>
            <input name="idAdminBan" type="number" min=1>
        </div>
        <input type="submit" value="Unban">
    </form>
    
    <!--Barra de PESQUISA de usuários BANIDOS - Lista de banidos -->
    <h2>Lista de usuários banidos</h2>
    <form name='search' action='' method='get'>
        <div>
            <h6>Email: </h6>
            <input name='email' type='searchbar'>
            <input type='submit' value='Pesquisar'>
        </div>
    </form>
    
</html>

<?php
    //Conexão com BD
    include('conn.php');
    //Sessão iniciada
    session_start();

    //Email inserido na barra de pesquisa pelo usuário
    $email = isset($_GET['email'])? $_GET['email'] : "";

    /*
        Select dos registros de banimento com emails
        similares ao inserido pelo usuário
    */
    $sqlPes= "SELECT  DISTINCT id, nome, email 
              FROM 
              TBUsuario U
              INNER JOIN TBBanimento B
              ON U.id = B.idUsuario
              WHERE U.email LIKE '".$email."%'";

    //Executa o código sql acima ↑
    $resultPes = $conn->query($sqlPes);

    //Print do resultado de resultPes
    if($resultPes->num_rows > 0){
        
        //Cabeçalho
        echo "
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>    
                    <th>Email</th>    
                </tr>";

        //Print de cada linha da tabela    
        while($row = $resultPes->fetch_assoc()){
            echo "
                <tr>
                    <td id='idTable'>".$row['id']   ."</td>
                    <td>"             .$row['nome'] ."</td>
                    <td>"             .$row['email']."</td>
                </tr>
            ";            
        }
        
        echo "</table>";

    } else {
        echo "<br>Nenhum resutado encontrado";
    }
?>

