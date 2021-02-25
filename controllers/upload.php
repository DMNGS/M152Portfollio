<?php
require_once("../models/functions.php");

$dossier = "../img/";
$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
$erreurs = array();
// $postes = count(CompterPostes());
// $nbPostes =count($postes['idPost]']);
$nbPosts = CompterPostes();
$tailleTotaleFichiers = 0;

//Vérifie qu'on a envoyer des fichers
if (isset($_FILES) && is_array($_FILES) && count($_FILES) > 0) {
    $fichiers = $_FILES['fichiers'];

    for ($i = 0; $i < count($fichiers['name']); $i++) {
        //Vérifie que la taille du ficher ne dépasse pas 3 Mo
        if ($fichiers['size'][$i] > 3000000) {
            $erreurs[count($erreurs)] = $fichiers['name'][$i] . " est trop grand.";
        }
        $tailleTotaleFichiers += $fichiers['size'][$i];

        //Vérifie qu'on a que des fichers du bon type
        if (
            $fichiers['type'][$i] != "image/jpeg" &&
            $fichiers['type'][$i] != "image/png" &&
            $fichiers['type'][$i] != "image/gif"
        ) {
            $erreurs[count($erreurs)] = $fichiers['name'][$i] . " n'est pas une image.";
        }
    }

    //Vérifier que la tialle totale ne dépasse pas 70 Mo
    if ($tailleTotaleFichiers > 70000000) {
        $erreurs[count($erreurs)] = "Taille totale des images trop grandes.";
    }

    if (count($erreurs) < 1) {
        InsertPoste($content);
        
        for ($i=0; $i < count($fichiers['name']); $i++) { 
            $nomUnique = uniqid("", false);
            $extention = pathinfo($fichiers["name"][$i])["extension"];

            if (move_uploaded_file($fichiers['tmp_name'][$i], "$dossiernomUnique.$extention")) {
                InsertMedia("$nomUnique.$extention", $nbPosts);
            }
            else {
                $erreurs[count($erreurs)] = "Erreur dans l'upload de " . $fichiers['name'][$i];
            }
        }
    } else {
        header("location:../pages/post.php");
    }
}