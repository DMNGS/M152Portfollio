<?php
require_once "dbconnection.php";

function select($table)
{
    $db = connectDb();
    $sql = "SELECT * FROM `:table`";
    $request = $db->prepare($sql);
    $request->execute(array('table' => $table));
    return $request->fetchAll(PDO::FETCH_ASSOC);
}
function selectOrder($table, $orderBy)
{
    $db = connectDb();
    $sql = "SELECT * FROM `:table` ORDER BY `:orderBy` ASC";
    $request = $db->prepare($sql);
    $request->execute(array(
        'table' => $table,
        'orderBy' => $orderBy
    ));
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

function selectJoin($base, $table, $baseJoindre, $tableJoindre)
{
    $db = connectDb();
    $sql = "SELECT * FROM `:table` JOIN `:tableJoindre` ON `:baseJoindre`.`:tableJoindre`=`:base`.`:table`";
    $request = $db->prepare($sql);
    $request->execute(array(
        'table' => $base,
        'table' => $table,
        'baseJoindre' => $baseJoindre,
        'tableJoindre' => $tableJoindre
    ));
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

function insertPoste($comment, $fichiers)
{
    
}