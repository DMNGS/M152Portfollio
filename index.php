<?php

/*
 * Projet      : M152Portfollio
 * Script      : index.php
 * Description : La page principale du site
 * Auteur      : DOMINGUES PEDROSA Samuel
 * Date        : 2021.01.28
 * Version     : 1.0
 */

include_once("models/tableauxTypes.inc.php");
include_once("models/functions.php");

$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
$posts = Select();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Portfollio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="./css/all.css" rel="stylesheet">
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link href="./css/facebook.css" rel="stylesheet">
    <link href="./css/main.css" rel="stylesheet">
</head>

<body>

    <div class="wrapper">
        <div class="box">
            <div class="row row-offcanvas row-offcanvas-left">

                <!-- main right col -->
                <div class="column col-sm-12 col-xs-12 " id="main">

                    <!-- top nav -->
                    <div class="navbar navbar-blue navbar-static-top">
                        <div class="navbar-header">
                            <img src="./img/pfp.png" alt="PFP" class="navbar-brand logo">
                        </div>
                        <nav class="collapse navbar-collapse" role="navigation">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="./"><i class="fas fa-home"></i> Home</a>
                                </li>
                                <li>
                                    <a href="./pages/post.php" role="button" data-toggle="modal"><i class="fas fa-plus"></i> Post</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- /top nav -->

                    <div class="padding">
                        <div class="full col-sm-9">

                            <!-- content -->
                            <div class="row">

                                <!-- main col left -->
                                <div class="col-sm-3">

                                    <div class="panel panel-default">
                                        <div class="panel-thumbnail col-sm-offset-1"><img src="./img/pfp.png" class="img-responsive"></div>
                                        <div class="panel-body">
                                            <p class="lead">Bienvenue dans mon portfollio</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-9">

                                    <?php
                                    for ($i = 0; $i < count($posts); $i++) {
                                        $post = '<div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>' . $posts[$i]['commentaire'] . '</h4>
                                        </div>';
                                        $post .= '<div class="panel-body">';

                                        
                                        foreach (SelectMediaFromPost($posts[$i]['idPost']) as $key => $value) {
                                            if (in_array(pathinfo($value["nomFichierMedia"])["extension"], $typesImage)) {
                                                $post .= '<img class="img-fluid img-thumbnail img-post" src="/img/' . $value['nomFichierMedia'] . '">';
                                            }
                                            elseif (in_array(pathinfo($value["nomFichierMedia"])["extension"], $typesVideo)) {
                                                $post .= '<video class="img-post" controls autoplay loop>
                                                <source src="/img/' . $value['nomFichierMedia'] . '" type="video/mp4">
                                              Your browser does not support the video tag.
                                              </video>';
                                            }
                                            elseif (in_array(pathinfo($value["nomFichierMedia"])["extension"], $typesAudio)) {
                                                $post.= ' <audio controls autoplay loop>
                                                <source src="/img/' . $value['nomFichierMedia'] . '" type="audio/mpeg">
                                              Your browser does not support the audio element.
                                              </audio> ';
                                            }
                                        }

                                        $post .= '</div>
                                        </div>';

                                        echo $post;
                                    }
                                    ?>

                                </div>

                            </div>
                            <!--/row-->
                        </div><!-- /col-9 -->
                    </div><!-- /padding -->
                </div>
                <!-- /main -->

            </div>
        </div>
    </div>
    <script type="text/javascript" src="./js/bootstrap.js"></script>
</body>

</html>