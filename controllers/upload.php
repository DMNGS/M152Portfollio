<?php
require_once("../models/tableauxTypes.inc.php");
require_once("../models/functions.php");

define("TAILLE_MAX_FICHIER", 10000000);
define("TAILLE_MAX_TOTALE", 70000000);


$dossier = "../media/img/";
$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
$erreurs = array();
$extention = array();
$postes = Select();
$dernierPoste = $postes[count($postes)-1]['idPost'] + 1;
$tailleTotaleFichiers = 0;

//Vérifie qu'on a envoyer des fichers
if (isset($_FILES) && is_array($_FILES) && count($_FILES) > 0) {
    $fichiers = $_FILES['fichiers'];

    for ($i = 0; $i < count($fichiers['name']); $i++) {
        $extention[$i] = pathinfo($fichiers["name"][$i])["extension"];

        //Vérifie que la taille du ficher ne dépasse pas la taille maximale
        if ($fichiers['size'][$i] > TAILLE_MAX_FICHIER) {
            $erreurs[count($erreurs)] = $fichiers['name'][$i] . " est trop grand.";
        }
        $tailleTotaleFichiers += $fichiers['size'][$i];

        //Vérifie qu'on a que des fichers du bon type
        if (
            !in_array($extention[$i], $typesImage) &&
            !in_array($extention[$i], $typesVideo) &&
            !in_array($extention[$i], $typesAudio))
        {
            $erreurs[count($erreurs)] = $fichiers['name'][$i] . " n'est pas un fichier autorisé.";
        }
    }

    //Vérifier que la tialle totale ne dépasse pas 70 Mo
    if ($tailleTotaleFichiers > TAILLE_MAX_TOTALE) {
        $erreurs[count($erreurs)] = "Taille totale des images trop grandes.";
    }

    for ($i = 0; $i < count($fichiers['name']); $i++) {
        $nomFinal[$i] = uniqid("", false);
        $cheminFichier = $dossier . $nomFinal[$i]. ".". $extention[$i];

        if (!move_uploaded_file($fichiers['tmp_name'][$i], $cheminFichier)) {
            $erreurs[count($erreurs)] = "Erreur dans l'upload de " . $fichiers['name'][$i];
        }
    }

    if (count($erreurs) < 1) {
        InsertPoste($content);

        for ($i = 0; $i < count($fichiers['name']); $i++) {
            InsertMedia($nomFinal[$i]. ".". $extention[$i], $dernierPoste);
        }

        header("location:../index.php");
    }
}
