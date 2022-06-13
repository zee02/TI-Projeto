<?php
    #Código para fazer a conexão entre o banco de dados e o PHP      
    $host = "localhost";  #Nome do host
    $user = "root";  #Nome do usuário
    $password = "";  #Senha do usuário
    $db_name = "projeto";  #Nome do banco de dados
      
    $con = mysqli_connect($host, $user, $password, $db_name);  #Faz a conexão com o banco de dados
    if(!$con) {   #Se não conseguir conectar
        die("Failed to connect with MySQL: ". mysqli_connect_error());  #Mostra a mensagem de erro
    }  
?>