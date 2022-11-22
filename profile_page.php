<?php
    include('session_start.php');
    include('conn.php');

    $idUser = $_GET['id'];
    $status = "<span class='active'>Ativo</span>";

    $sqlPesq = "SELECT * 
                FROM 
                    TBUsuario U 
                    LEFT JOIN 
                    tbBanimento B 
                    ON U.id = B.idUsuario
                WHERE U.id = ".$idUser.";";

    $resultPesq = $conn->query($sqlPesq);

    while($row = $resultPesq->fetch_assoc()){
        if (!is_null($row['dataHoraBanimento'])){
            $status = "<span class='banned'>Banido</span>";
        }

        
        $name = $row['nome'];
        $email = $row['email'];
        $telefone = $row['celular'];
        $dataNasc = $row['dataNascimento'];
    }
?>

<html>
    <head>
        <title>Doe em 5</title>
        <link rel="stylesheet" href="./assets/styles/header.css">
        <link rel="stylesheet" href="./assets/styles/profile_page.css">
    </head>
    <body>
        
        <header>
            <a id="voltar" aria-label="Voltar para página anterior" href="admin_screen.php">
                <img src="./assets/imgs/voltar.svg" alt="Voltar">
                <h1>Voltar</h1>
            </a>
        </header>
        
        <section id="main">
            <section id="sidebar">
                <div id='profile-side'>
                    <img id="profile-photo" src="./assets/imgs/usuario.svg" alt="Foto de perfil">
                    <p>Status da conta: <?php echo $status?></p>
                </div>
                <div id="options">
                    <a id="ban-option" href="#"> Banir usuário</a>
                </div>
            </section>
            <section id="container">
                <div class="info-container">
                    <h4>Nome:               </h4>&nbsp;
                    <?php echo "<p>".$name."</p>"?>
                </div>
                <div class="info-container">
                    <h4>Data de nascimento:</h4>&nbsp;
                    <?php echo "<p>".$dataNasc."</p>"?>
                </div>
                <div class="info-container">
                    <h4>Telefone:           </h4>&nbsp;
                    <?php echo "<p>".$telefone."</p>"?>
                </div>
                <div class="info-container">
                    <h4>Email:              </h4>&nbsp;
                    <?php echo "<p>".$email."</p>"?>                    
                </div>
            </section>
        </section>
    </body>
</html>