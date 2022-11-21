<html>

    <head>
        <title>Doe 5</title>
        <link rel="stylesheet" href="./assets/styles/header.css">
    </head>

    <header>
        <a id="voltar"href="admin_screen.php">
            <img src="./assets/imgs/voltar.svg" alt="Voltar">
            <h1>Voltar</h1>
        </a>
    </header>
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
    $sqlPes= 
            "SELECT 
                DISTINCT B.idUsuario,
                U.email,
                B.idAdmin,
                B.dataHoraBanimento,
                B.motivo
            FROM
                TBBanimento B
                INNER JOIN TBUsuario U
                ON B.idUsuario = U.id
            WHERE 
                B.dataHoraUnban IS NULL;";

    //Executa o código sql acima ↑
    $resultPes = $conn->query($sqlPes);

    //Print do resultado de resultPes
    if($resultPes->num_rows > 0){
        
        //Cabeçalho
        echo "
            <table>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Motivo</th>
                    <th>Admin</th>    
                    <th>Data-hora banimento</th>    
                    <th>Opções</th>     
                </tr>";

        //Print de cada linha da tabela    
        while($row = $resultPes->fetch_assoc()){
            echo "
                <tr>
                    <td>".$row['idUsuario']        ."</td>
                    <td>".$row['email']            ."</td>
                    <td>".$row['motivo']           ."</td>
                    <td>".$row['idAdmin']          ."</td>
                    <td>".$row['dataHoraBanimento']."</td>
                    <td>
                        <a href='del_ban_action.php?deleteId=".$row['idUsuario']."&&"."deleteDataHoraBan=".$row['dataHoraBanimento']."'>deletar</a>
                    </td>
                </tr>
            ";           
        }
        
        echo "</table>";

    } else {
        echo "<br>Nenhum resutado encontrado";
    }
?>

