<?php
    include('conn.php');
    
    session_start();
    $_SESSION['Versao'] = 1;
    $login = isset($_GET["login"]) ? $_GET["login"] : "";
    $senha = isset($_GET["senha"]) ? $_GET["senha"]: "";
    
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Doe em 5</title>
        <link rel="stylesheet" href="./assets/style.css">
    </head>
    <body>
        <form action="login_action.php" method="get">
        <!-- <form action="search.php" method="get"> -->
            <table>
                <tr>
                    <td>
                        <h4>Login:</h4>
                        <input placeholder="exemplo@gmail.com" type="email" name="login" value="<?=$login?>">
                    </td>
                    <td>
                        <h4>Senha:</h4>
                        <input placeholder="Senha" type="text" name="senha" value="<?=$senha?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Enviar" style="width:100%">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>