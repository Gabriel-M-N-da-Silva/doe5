<html>
    <head>
        <title>Doe em 5</title>
        <link rel="stylesheet" href="./assets/resulttable.css">
    </head>
    <body>
        <form method="GET" action="" name="form">
            <input type="search" name="nomePes" id="nomePes">
        </form>
        <a href="ban_screen.php">Banir Usuário</a>
    </body>
</html>

<?php

include('conn.php');
include('session_start.php');


$nomePes= isset($_GET['nomePes']) ? $_GET['nomePes'] : "";
$sql    = "SELECT * FROM TBUsuario WHERE nome LIKE '".$nomePes."%';";
$result = $conn->query($sql);
$nome   = isset($_GET["nome"]) ? $_GET["nome"] : "";
$email  = isset($_GET["email"]) ? $_GET["email"]: "";

if($result->num_rows > 0){
    //Output data of each row
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Nome</th>    
            </tr>";

    while($row = $result->fetch_assoc()){
        
        echo "
            <tr>
                <td id='id'>"
                .$row['id'].
                "</td>
                <td>"
                .$row['nome'].
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

