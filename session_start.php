<?php
session_start();


if(isset($_SESSION['Versao'])){
    echo "<h6 style='text-align:center'>Versão da sessão: ".$_SESSION['Versao']."</h6>";
} else {
    echo $_SESSION['Versao'];
    echo "<script type='text/javascript'>alert('Nenhuma versão encontrada. Retornando...');</script>";
    header("Location: index.php");
}
?>