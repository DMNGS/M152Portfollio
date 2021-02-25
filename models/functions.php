<?php
require_once "dbconnection.php";

function Select($table)
{
    $db = ConnectDb();
    $sql = "SELECT * FROM `:table`";
    $request = $db->prepare($sql);
    $request->execute(array('table' => $table));
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

function CompterPostes()
{
    $db = ConnectDb();
    $sql = "SELECT * FROM `posts`";
    $request = $db->prepare($sql);
    $request->execute(array());
    return $request->fetchColumn();
}

function InsertPoste($commentaire)
{
    $db = connectDb();
    $sql = "INSERT INTO `posts`(`commentaire`, `dateDeCreation`) VALUES (:commentaire, :dateDeCreation)";
    $request = $db->prepare($sql);
    if ($request->execute(array(
        'commentaire' => $commentaire,
        'dateDeCreation' => date("Y-m-d")
    ))) {
        return $db->lastInsertID();
    } else {
        return NULL;
    }
}

function InsertMedia($media, $idPoste)
{
    $db = connectDb();
    $sql = "INSERT INTO `medias`(`dateDeCreation`, `nomFichierMedia`, `idPost`) VALUES (:dateDeCreation, :nomFichierMedia, :idPost)";
    $request = $db->prepare($sql);
    if ($request->execute(array(
        'dateDeCreation' => date("Y-m-d"),
        'nomFichierMedia' => $media,
        'idPost' => $idPoste
    ))) {
        return $db->lastInsertID();
    } else {
        return NULL;
    }
}
