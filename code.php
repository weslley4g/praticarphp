<?php
$con = new PDO("mysql:host=localhost;dbname=infoideias", "root", "");
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$con->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");



try {
    $pdoStatement = $con->query("SELECT ID, Titulo, imobiliariaID, ConteudoID FROM conteudo  ORDER BY
     ConteudoID, imobiliariaID   DESC");



    while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {

        echo "<ul>
       {$row['ID']} 
       <li>{$row['Titulo']}</li> 
       {$row['imobiliariaID']} 
       {$row['ConteudoID']}
       </ul>";
    }
} catch (Exception $e) {
    echo "Erro: {$e->getMessage()}";
}
