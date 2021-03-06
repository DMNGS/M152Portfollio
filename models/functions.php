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

//Cherche un poste donné
function SelectPoste($id)
{
    $db = ConnectDb();
    $sql = "SELECT * FROM `posts` WHERE idPost=:id";
    $request = $db->prepare($sql);
    $request->bindParam('id', $id);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

//Cherche les média d'un poste donné
function SelectMediaFromPost($idPost)
{
    $db = ConnectDb();
    $sql = "SELECT * FROM `medias` WHERE `idPost`=:idPost";
    $request = $db->prepare($sql);
    $request->bindParam('idPost', $idPost);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
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
            'dateDeCreation' => date("Y-m-d")
        ));
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

function UpdatePoste($commentaire, $idPoste, $date)
{
    $db = connectDb();
    $sql = "UPDATE `posts` 
            SET `commentaire` = :commentaire,
            `dateDeModification` = :dateDeModification
            WHERE `idPost` = :idPost";

    $db->beginTransaction();

    try {
        $request = $db->prepare($sql);
        $request->bindParam(":commentaire", $commentaire);
        $request->bindParam(":dateDeModification", $date);
        $request->bindParam(":idPost", $idPoste);
        $request->execute();

        $db->commit();
    } catch (\Throwable $th) {
        $db->rollBack();
    }
}

function SupprimerPoste($id)
{
    $db = connectDb();
    $sqlPost = "DELETE FROM `posts` WHERE `idPost` = :id";
    $sqlMedias = "DELETE FROM `medias` WHERE `idPost` = :id";

    $db->beginTransaction();

    try {
        $requestPost = $db->prepare($sqlPost);
        $requestPost->bindParam(":id", $id);
        $requestPost->execute();
        $requestPost = $db->prepare($sqlMedias);
        $requestPost->bindParam(":id", $id);
        $requestPost->execute();

        $db->commit();
        return true;
    } catch (\Throwable $th) {
        $db->rollBack();
        return false;
    }
}
