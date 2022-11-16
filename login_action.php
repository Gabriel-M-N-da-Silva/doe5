<?php
include('conn.php');
session_start();

$sql    = "SELECT id, email, senha FROM TBUsuario";
$result = $conn->query($sql);
$login = isset($_GET["login"]) ? $_GET["login"]: "";
$senha = isset($_GET["senha"]) ? $_GET["senha"]: "";

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        if($row['email'] == $login && $row['senha'] == $senha){
            $_SESSION['idUsuario'] = $row['id'];
            header("Location: donation_screen.php");
            break;
        }
    }
} else {
    echo "<script>alert('Email ou senha inválidos!')</script>";
}

?>