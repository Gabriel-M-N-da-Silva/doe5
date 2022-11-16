<html>
    <head>
        <title>Doe 5</title>
        <link rel="stylesheet" href="./assets/ban.css">
    </head>
    <form name="ban" action="add_ban_action.php" method="get">
        <h2>Banir usuário</h2>
        <div>
            <h6>Email: </h6>
            <input name="emailAdd" type="searchbar">
        </div>
        <div>
            <h6>Motivo: </h6>
            <input name="reason" type="text">
        </div>
        <input type="submit" value="Banir">
    </form>
    <form name="ban" action="del_ban_action.php" method="get">
        <h2>Deletar banimento</h2>
        <div>
            <h6>Email: </h6>
            <input name="emailAdd" type="email">
        </div>
        <div>
            <h6>Data do banimento: </h6>
            <input name="date" type="date">
        </div>
        <div>
            <h6>ID admin: </h6>
            <input name="idAdmin" type="number" min=1>
        </div>
        <input type="submit" value="Deletar banimento">
    </form>
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
</html>

<?php
    include('conn.php');
    session_start();

    $email = isset($_GET['email'])? $_GET['email'] : "";
    $sqlPes= "SELECT  DISTINCT id, nome, email 
              FROM 
              TBUsuario U
              INNER JOIN TBBanimento B
              ON U.id = B.idUsuario
              WHERE U.email LIKE '".$email."%'";



    $resultPes = $conn->query($sqlPes);

    //Output table with the $sqlPes result
    if($resultPes->num_rows > 0){
        //Output data of each row
        echo "
        <h2>Lista de banidos</h2>
            <form name='search' action='' method='get'>
                <div>
                    <h6>Email: </h6>
                    <input name='email' type='searchbar'>
                    <input type='submit' value='Pesquisar'>
                </div>
            </form>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>    
                    <th>Email</th>    
                </tr>";
    
        while($row = $resultPes->fetch_assoc()){
            
            echo "
                <tr>
                    <td id='idTable'>"
                    .$row['id'].
                    "</td>
                    <td>"
                    .$row['nome'].
                    "</td>
                    <td>"
                    .$row['email'].
                    "</td>
                </tr>
            ";
            
            //echo "<br>ID: ".$row['id']."Nome: ".$row['nome'];
        }
        echo "</table>";
    } else {
        echo "<br>Nenhum resutado encontrado";
    }
?>

