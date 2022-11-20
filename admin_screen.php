<html>
    <head>
        <title>Doe em 5</title>
        <link rel="stylesheet" href="./assets/resulttable.css">
    </head>
    <body>
        <!-- Barra de pesquisa -->
        <form method="GET" action="" name="form">
            <input type="search" name="nomePes" id="nomePes">
        </form>
        <a href="ban_screen_julio.php">Banir Usuário</a>
    </body>
</html>

<?php

include('conn.php');
include('session_start.php');

// Nome do usuário que será pesquisado
$nomePes= isset($_GET['nomePes']) ? $_GET['nomePes'] : "";

//Select dos usuários com nome parecido com $nomePes
$sql    = "SELECT * FROM TBUsuario WHERE nome LIKE '".$nomePes."%';";
$result = $conn->query($sql);

//Print do BD
if($result->num_rows > 0){
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
    }
    echo "</table>";
} else {
    echo "<br>Nenhum resutado encontrado";
}

?>

