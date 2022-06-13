<?php
header('Content-Type: text/html; charset=utf-8');

include $_SERVER["DOCUMENT_ROOT"] . "/TI-Projeto/connection.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST["nome"]) && isset($_POST["hora"]) && isset($_POST["valor"])) {
        $nome = $_POST["nome"];
        $hora = $_POST["hora"];
        $valor = $_POST["valor"];
        $log = $_POST["hora"] . ";" . $_POST["valor"] . PHP_EOL;
        FILE_APPEND;

        $query = "insert into {$nome} (hora,valor,log,nome) values ('{$hora}', '{$valor}', '{$log}', '{$nome}')";
        mysqli_query($con, $query);
    } elseif (isset($_POST['webcam'])) {
        $nome = "webcam";
        $valor = 1;
        date_default_timezone_set('Europe/London');
        $dt = new DateTime();
        $hora = $dt->format('Y/m/d H:i:s');
        $log = $hora . ";" . $valor . PHP_EOL;
        $query = "insert into webcam(hora,valor,log,nome) values ('{$hora}', '{$valor}', '{$log}', '{$nome}')";
        mysqli_query($con, $query);
    }elseif (isset($_POST['garage_door_open'])) {
        $nome = "garage_door";
        $valor = 1;
        date_default_timezone_set('Europe/London');
        $dt = new DateTime();
        $hora = $dt->format('Y/m/d H:i:s');
        $log = $hora . ";" . $valor . PHP_EOL;
        $query = "insert into garage_door(hora,valor,log,nome) values ('{$hora}', '{$valor}', '{$log}', '{$nome}')";
        mysqli_query($con, $query);
    } elseif (isset($_POST['garage_door_close'])) {
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
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET["nome"])) {
        $nome = $_GET["nome"];
        $sql = "select * from {$nome} ORDER BY id DESC LIMIT 1";
        $sql_run = $con->query($sql);
        $row = $sql_run->fetch_assoc();
        echo $row['valor'];
    } else {
        http_response_code(404);
    }
} else {
    echo "metodo errado";
}
