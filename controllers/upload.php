<?php
require_once("../models/functions.php");

$erreurs = array();

if (isset($_FILES) && is_array($_FILES) && count($_FILES) > 0) {
    $fichiers = $_FILES['fichiers'];

    for ($i = 0; $i < count($fichiers['name']); $i++) {
        if ($fichiers['size'][$i] > 3000000) {
            $erreurs[count($erreurs)] = $fichiers['name'][$i] . " est trop grand.";
        }

        if (
            $fichiers['type'][$i] != "jpg" &&
            $fichiers['type'][$i] != "png" &&
            $fichiers['type'][$i] != "jpeg" &&
            $fichiers['type'][$i] != "gif"
        ) {
            $erreurs[count($erreurs)] = $fichiers['name'][$i] . " n'est pas une image.";
        }
    }

    if (count($erreurs) < 1) {
        # code...
    }
}

function Uploader()
{
}
