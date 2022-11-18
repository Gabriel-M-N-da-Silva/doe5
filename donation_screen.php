<html>
    <head>
        <title>Doe 5</title>
        <link rel="stylesheet" href="./assets/banv1.css">
        <!-- <link rel="stylesheet" href="./assets/ban.css"> -->
    </head>
    
    
    <!-- Barra de pesquisa de doações realizadas -->
    <h2>Doações realizadas</h2>
    <form name='search' action='' method='get'>
        <div>
            <h6>Instituicao: </h6>
            <input name='instituicao' autocomplete='off' type='searchbar'>
            <input type='submit' value='Pesquisar'>
        </div>
    </form>


<?php
    include('conn.php');
    session_start();

    // Nome da instituição sendo procurada 
    $instituicao = isset($_GET['instituicao'])? $_GET['instituicao'] : "";
    // Select do id da doação, nome da instituição-destino e centro de captação destino
    $sqlPes= "SELECT 
                D.idDoacao,
                I.razaoSocial,
                CC.nome 
              FROM 
                TBDoacao D
                INNER JOIN TBCentrocaptacao CC
                    ON D.idCentro = CC.id
                INNER JOIN TBInstituicao I
                    ON CC.idInstituicao = I.idInstituicao
              WHERE 
                    D.idDoador = ".$_SESSION['idUsuario'].
              "     AND
                    I.razaoSocial LIKE '".$instituicao."%'
              GROUP BY D.idDoacao";
    
    // Resultado do select
    $resultPes = $conn->query($sqlPes);

    //Print do banco de dados
    if($resultPes->num_rows > 0){
        //Print do header da tabela
        echo "
            <table>
                <tr>
                    <th>ID</th>
                    <th>Instituição</th>    
                    <th>Centro de Captação</th>    
                    <th>Opções</th>    
                </tr>";
    
        while($row = $resultPes->fetch_assoc()){
            echo "
                <tr>
                    <td id='idTable'>"
                    .$row['idDoacao'].
                    "</td>
                    <td>"
                    .$row['razaoSocial'].
                    "</td>
                    <td>"
                    .$row['nome'].
                    "</td>
                    <td>
                        <a href='#'>Editar</a>
                        <a href='#'>Excluir</a>
                    </td>
                </tr>
            ";
            
            //echo "<br>ID: ".$row['id']."Nome: ".$row['nome'];
        }
        echo "</table>";
    } else {
        echo "<br>Nenhum resutado encontrado";
    }
?>

