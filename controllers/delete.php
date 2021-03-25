<?php
require_once("../models/tableauxTypes.inc.php");
require_once("../models/functions.php");

$dossier = "../media/";
$idPoste = filter_input(INPUT_POST, 'idPoste', FILTER_SANITIZE_STRING);
$postes = Select();

if (isset($_POST['delete'])) {
    for ($i = 0; $i < count($postes); $i++) {
        if ($postes[$i]['idPost'] == $idPoste) {

            SupprimerPoste($idPoste);

            foreach (SelectMediaFromPost($postes[$i]['idPost']) as $key => $value) {
                if (in_array(pathinfo($value["nomFichierMedia"])["extension"], $typesImage))
                {
                    unlink($dossier . "img/" . $value["nomFichierMedia"]);
                }
                elseif (in_array(pathinfo($value["nomFichierMedia"])["extension"], $typesVideo))
                {
                    unlink($dossier . "video/" . $value["nomFichierMedia"]);
                }
                elseif (in_array(pathinfo($value["nomFichierMedia"])["extension"], $typesAudio))
                {
                    unlink($dossier . "audio/" . $value["nomFichierMedia"]);
                }
            }
        }
    }
}

header("location:../index.php");
