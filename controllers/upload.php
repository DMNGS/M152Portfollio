<?php
require_once("../models/functions.php");

define("TAILLE_MAX_FICHIER", 3000000);
define("TAILLE_MAX_TOTALE", 70000000);


$dossier = "../img/";
$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
$typesAutorises = array("image/jpeg", "image/png", "image/gif", "image/svg");
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
        if ($fichiers['size'][$i] > TAILLE_MAX_FICHIER) {
            $erreurs[count($erreurs)] = $fichiers['name'][$i] . " est trop grand.";
        }
        $tailleTotaleFichiers += $fichiers['size'][$i];

        //Vérifie qu'on a que des fichers du bon type
        if (!in_array($fichiers['type'][$i], $typesAutorises)) {
            $erreurs[count($erreurs)] = $fichiers['name'][$i] . " n'est pas une image.";
        }
    }

    //Vérifier que la tialle totale ne dépasse pas 70 Mo
    if ($tailleTotaleFichiers > TAILLE_MAX_TOTALE) {
        $erreurs[count($erreurs)] = "Taille totale des images trop grandes.";
    }

    for ($i = 0; $i < count($fichiers['name']); $i++) {
        $nomUnique = uniqid("", false);
        $extention = pathinfo($fichiers["name"][$i])["extension"];

        if (move_uploaded_file($fichiers['tmp_name'][$i], "$dossier$nomUnique.$extention")) {
        } else {
            $erreurs[count($erreurs)] = "Erreur dans l'upload de " . $fichiers['name'][$i];
        }
    }

    if (count($erreurs) < 1) {
        InsertPoste($content);

        for ($i = 0; $i < count($fichiers['name']); $i++) {
            $nomUnique = uniqid("", false);
            $extention = pathinfo($fichiers["name"][$i])["extension"];
            InsertMedia("$nomUnique.$extention", $nbPosts);
        }
    }
}
