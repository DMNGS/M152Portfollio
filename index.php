<?php
/*
 * Projet      : M152Portfollio
 * Script      : index.php
 * Description : La page principale du site
 * Auteur      : DOMINGUES PEDROSA Samuel
 * Date        : 2021.01.28
 * Version     : 1.0
 */
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
                            <a href="/M152Portfollio/" class="navbar-brand logo">A</a>
                        </div>
                        <nav class="collapse navbar-collapse" role="navigation">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="#"><i class="fas fa-home"></i> Home</a>
                                </li>
                                <li>
                                    <a href="#postModal" role="button" data-toggle="modal"><i class="fas fa-plus"></i> Post</a>
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
                                        <div class="panel-thumbnail"><img src="./img/bg_5.jpg" class="img-responsive"></div>
                                        <div class="panel-body">
                                            <p class="lead">Portfollio</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- main col right -->
                                <div class="col-sm-9">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Lorem Ipsum</h4>
                                        </div>
                                        <div class="panel-body">
                                            Magna nulla consequat aliquip esse non id mollit sint qui Lorem. Voluptate ullamco anim do duis excepteur eiusmod est cillum culpa nostrud nulla do.
                                            Ipsum dolor aliqua est enim id exercitation magna amet aute excepteur amet laborum laborum. Ullamco eiusmod nulla reprehenderit anim minim aliqua laboris in culpa nisi aute.
                                            Est nulla Lorem ipsum sint in irure consequat nostrud minim in nostrud commodo consectetur.
                                            Occaecat enim voluptate ipsum id proident ipsum nisi nulla sit esse qui. Cillum pariatur quis quis voluptate ipsum veniam fugiat aliquip laborum quis. Ex quis aliqua irure irure.
                                            Aute ipsum laborum do dolore velit Lorem irure nulla veniam tempor quis qui excepteur. Nulla fugiat nisi anim Lorem aliqua.
                                            Tempor id et duis dolor elit exercitation minim eiusmod ut elit labore.
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