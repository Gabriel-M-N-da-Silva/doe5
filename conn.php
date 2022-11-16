<?php
$severname="localhost";
$username ="gabrielmns";
$password ="Gabriel@2004";
$dbname   ="doe5";

//Creating connection
$conn = new mysqli($severname,$username,$password,$dbname);

//Checking connection
if($conn->connect_error){
    die("Conexão falhou : ". $conn->connect_error);
}
?>