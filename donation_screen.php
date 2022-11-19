<html>
    <head>
        <title>Doe 5</title>
        <link rel="stylesheet" href="./assets/don.css">
        <!-- <link rel="stylesheet" href="./assets/ban.css"> -->
    </head>
    
    <body>
        <!-- Barra de pesquisa de doações realizadas -->
        <h2>Doações</h2>
        <form id='form-search' name='search' action='' method='get'>
            <input id='barra-pesquisa' name='instituicao' placeholder='Insira o nome da instituição' autocomplete='off' type='searchbar'>
            <button id='btn-search' type='submit' value='' aria-label='Pesquisar'><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352c79.5 0 144-64.5 144-144s-64.5-144-144-144S64 128.5 64 208s64.5 144 144 144z"/></svg></button>
            
            <!-- <input id='btn-search' type='submit' value='' aria-label='Pesquisar'> -->
        </form>
    </body>


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

