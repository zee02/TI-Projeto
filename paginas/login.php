<?php 
session_start();
include('../connection.php');  
#Verifica se a sessão está vazia, se estiver manda para a página index.php
if(empty($_POST['username']) || empty($_POST['password'])){
    header('Location: index.php');
    exit();
}
#Se não estiver vazia, verifica se o usuário e a senha estão corretos
$user = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);

#Verifica se o usuário e a senha estão corretos
$query = "select * from user where username = '{$user}' and password = '{$password}'";
#Executa a query
$result = mysqli_query($con, $query);

$row = mysqli_num_rows($result);
if($row == 1){
    #Se estiver correto, inicia a sessão e manda para a dashboard
    $_SESSION['username'] = $user;
    header('Location: dashboard.php');
    exit();
}else {
    #Se não estiver correto, manda para a página login.php
    header('Location: login.php');
    $_SESSION['not_auth'] = true;
    exit();
}
?>