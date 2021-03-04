<?php
/*
 * Projet      : M152Portfollio
 * Script      : post.php
 * Description : La page pour créer un post
 * Auteur      : DOMINGUES PEDROSA Samuel
 * Date        : 2021.02.04
 * Version     : 1.0
 */

include_once("../controllers/upload.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Portfollio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="../css/all.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/facebook.css" rel="stylesheet">
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
                            <img src="../img/pfp.png" alt="PFP" class="navbar-brand logo">
                        </div>
                        <nav class="collapse navbar-collapse" role="navigation">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="../"><i class="fas fa-home"></i> Home</a>
                                </li>
                                <li>
                                    <a href="./post.php" role="button" data-toggle="modal"><i class="fas fa-plus"></i> Post</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- /top nav -->

                    <div class="padding">
                        <div class="full col-sm-9">

                            <!-- content -->
                            <div class="row">

                                <!-- main col right -->
                                <div class="col-sm-4 col-sm-offset-4">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Créer un post</h4>
                                            <?php
                                            for ($i = 0; $i < count(($erreurs)); $i++) {
                                                echo "<h5 class='text-danger'>" . $erreurs[$i] . "</h5>";
                                            }
                                            ?>
                                        </div>
                                        <div class="panel-body">
                                            <form action="" method="POST" id="formCreate" enctype="multipart/form-data">
                                                <textarea class="col-sm-12" name="content" form="formCreate" placeholder="Contenu du poste"></textarea>
                                                <input type="file" name="fichiers[]" accept="image/jpeg,image/png,image/gif" multiple>
                                                <input class="btn btn-primary" type="submit" name="create" value="Créer">
                                            </form>
                                        </div>
                                    </div>

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