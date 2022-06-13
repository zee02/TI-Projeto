<?php
header('Content-Type: text/html; charset=utf-8');

include $_SERVER["DOCUMENT_ROOT"] . "/TI-Projeto/connection.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    #Verifica se os campos estão preenchidos
    if (isset($_POST["nome"]) && isset($_POST["hora"]) && isset($_POST["valor"])) {
        $nome = $_POST["nome"];
        $hora = $_POST["hora"];
        $valor = $_POST["valor"];
        $log = $_POST["hora"] . ";" . $_POST["valor"] . PHP_EOL;
        FILE_APPEND;
        #Query para inserir os dados no banco de dados
        $query = "insert into {$nome} (hora,valor,log,nome) values ('{$hora}', '{$valor}', '{$log}', '{$nome}')";
        mysqli_query($con, $query);
    } elseif (isset($_POST['webcam'])) { #Verifica se o campo webcam está preenchido
        $nome = "webcam";
        $valor = 1;
        date_default_timezone_set('Europe/London');
        $dt = new DateTime();
        $hora = $dt->format('Y/m/d H:i:s');
        $log = $hora . ";" . $valor . PHP_EOL;
        $query = "insert into webcam(hora,valor,log,nome) values ('{$hora}', '{$valor}', '{$log}', '{$nome}')";
        mysqli_query($con, $query);
    }elseif (isset($_POST['garage_door_open'])) { #Verifica se o campo garage_door_open está preenchido
        $nome = "garage_door";
        $valor = 1;
        date_default_timezone_set('Europe/London');
        $dt = new DateTime();
        $hora = $dt->format('Y/m/d H:i:s');
        $log = $hora . ";" . $valor . PHP_EOL;
        $query = "insert into garage_door(hora,valor,log,nome) values ('{$hora}', '{$valor}', '{$log}', '{$nome}')";
        mysqli_query($con, $query);
    } elseif (isset($_POST['garage_door_close'])) { #Verifica se o campo garage_door_close está preenchido
        $nome = "garage_door";
        $valor = 0;
        date_default_timezone_set('Europe/London');
        $dt = new DateTime();
        $hora = $dt->format('Y/m/d H:i:s');
        $log = $hora . ";" . $valor . PHP_EOL;
        $query = "insert into garage_door(hora,valor,log,nome) values ('{$hora}', '{$valor}', '{$log}', '{$nome}')";
        mysqli_query($con, $query);
    }else {
        echo "Erro na API";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") { #Verifica se o método é GET
    if (isset($_GET["nome"])) { #   Verifica se o campo nome está preenchido
        $nome = $_GET["nome"]; #   Pega o valor do campo nome
        $sql = "select * from {$nome} ORDER BY id DESC LIMIT 1"; #   Query para selecionar o último valor do campo nome
        $sql_run = $con->query($sql); #   Executa a query
        $row = $sql_run->fetch_assoc(); #   Pega o valor do campo nome
        echo $row['valor']; #   Retorna o valor do campo nome
    } else {
        http_response_code(404); #   Se não estiver preenchido, retorna 404
    }
} else {
    echo "metodo errado";
}
