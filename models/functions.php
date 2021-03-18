<?php
require_once "dbconnection.php";

//Lit les données de la table des posts
function Select()
{
    $db = ConnectDb();
    $sql = "SELECT * FROM `posts`";
    $request = $db->prepare($sql);
    $request->execute(array());
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

//Cherche les média d'un poste donné
function SelectMediaFromPost($idPost)
{
    $db = ConnectDb();
    $sql = "SELECT * FROM `medias` WHERE `idPost`=:idPost";
    $request = $db->prepare($sql);
    $request->execute(array('idPost' => $idPost));
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

//Compte le nombre de postes dans la base
function CompterPostes()
{
    $db = ConnectDb();
    $sql = "SELECT * FROM `posts`";
    $request = $db->prepare($sql);
    $request->execute(array());
    return $db->lastInsertId();
}

//Crée un poste dans la base
function InsertPoste($commentaire)
{
    $db = connectDb();
    $sql = "INSERT INTO `posts`(`commentaire`, `dateDeCreation`) VALUES (:commentaire, :dateDeCreation)";
    $request = $db->prepare($sql);

    $db->beginTransaction();
    
    try {
        $request->execute(array(
            'commentaire' => $commentaire,
            'dateDeCreation' => date("Y-m-d")));
        $db->commit();
    } catch (Exception $e) {
        $db->rollBack();
    }
}

//Crée un média dans la base
function InsertMedia($media, $idPoste)
{
    $db = connectDb();
    $sql = "INSERT INTO `medias`(`dateDeCreation`, `nomFichierMedia`, `idPost`) VALUES (:dateDeCreation, :nomFichierMedia, :idPost)";
    $request = $db->prepare($sql);

    $db->beginTransaction();

    try {
        $request->execute(array(
            'dateDeCreation' => date("Y-m-d"),
            'nomFichierMedia' => $media,
            'idPost' => $idPoste
        ));
        $db->commit();
    } catch (Exception $e) {
        $db->rollBack();
    }
}
