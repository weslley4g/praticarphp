<?php
$con = new PDO("mysql:host=localhost;dbname=infoideias", "root", "");
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$con->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");


try {
    $pdoStatement = $con->query("SELECT * FROM conteudo where  conteudoid = 0 and conteudo.imobiliariaID = 99901");
    


    $arrPrimeiroNivel = $pdoStatement->fetchAll();

    function printNivelById($id)
    {

        $con = new PDO("mysql:host=localhost;dbname=infoideias", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
        $pdoStatement = $con->query("select * from conteudo where conteudoId = $id ");
        
        $row = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        if ($row !== false) {
            printNivelById($row['ID']);
        }
    }

    function printSubNivelById($id)
    {

        $con = new PDO("mysql:host=localhost;dbname=infoideias", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
        $pdoStatement = $con->query("select * from conteudo where conteudoId = $id ");
        
        $row = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        if ($row !== false) {
            printSubNivelById($row['ID']);
            return "<a href='#' id='".$row['ID']."'>".$row['Titulo']."</a>";
        }

    }

    foreach ($arrPrimeiroNivel as $val) {
        $id = $val['ID'];

        if ($val['ConteudoID'] == 0) {

            echo "<ul> <ul><a href='#' id='{$id}'> {$val['Titulo']} </a><li>".printSubNivelById($id)."</li></ul>";
        }
        printNivelById($id);
    }
} catch (Exception $e) {
    echo "Erro: {$e->getMessage()}";
}
