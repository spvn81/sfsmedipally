<?php
require('db_config.php');
require('MainFunctions.php');


try {
    $database = new Connection();
    $db = $database->openConnection();

    $data = new MainFunctions();
    $menu_data  = $data->getMainMenu($db);
    $getMainMenuOfSub  = $data->getMainMenuOfSub($db);
} catch (PDOException $e) {
    echo "There is some problem in connection: " . $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>title || ee </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="user_asset/css/style.css">
    <link rel="stylesheet" href="user_asset/css/responsive.css">
    <link href="user_asset/lightgallery/src/css/lightgallery.css" rel="stylesheet">

</head>

<body>


    <div class="boxed_wrapper">

        <header class="top-bar">
            <div class="container">
                <div class="clearfix">
                    <div class="col-left float_left">


                        <ul class="top-bar-info">
                            <li><i class="icon-technology"></i>Phone: 040-2988 0005, +91 91219 09351</li>
                            <li><i class="icon-note2"></i>sfshighschoolmedipally@gmail.com</li>
                        </ul>
                    </div>
                    <div class="col-right float_right">
                        <ul class="social">
                            <li>Stay Connected: </li>

                            <li><a href=""><i class="fa fa-youtube"></i></a></li>
                            <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>

                        </ul>

                    </div>


                </div>


            </div>
        </header>
        <section class="theme_menu stricky">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="main-logo">

                            <a href="https://sfsmedipally.in">

                                <h4 style="margin-top:25px;font-weight:bold;">St. FRANCIS DE SALES' SCHOOL</h4>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-10 menu-column">
                        <nav class="main-menu navbar-expand-lg navbar-light bg-light">
                            <div class="navbar-header">

                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <div class="navbar-collapse collapse clearfix">
                                <ul class="navigation clearfix">
                                    <?php foreach ($menu_data as  $menu_data_menu) { ?>

                                        <li>
                                            <a href="<?= $menu_data_menu['page_link'] ?>" class="text-capitalize"><?= $menu_data_menu['title'] ?></a>
                                        </li>
                                    <?php     } ?>




                                    <?php foreach ($getMainMenuOfSub as $getMainMenuOfSubData) { ?>


                                        <li class="dropdown">


                                            <a href="#" data-toggle="dropdown" class="text-capitalize"><?= $getMainMenuOfSubData['title'] ?></a>
                                            <ul class="dropdown-menu">
                                                <?php
                                                $getSubMainMenu  = $data->getSubMainMenu($getMainMenuOfSubData['id'], $db);
                                                ?>
                                                <?php foreach ($getSubMainMenu as  $getSubMainMenu_data) { ?>

                                                    <li>
                                                        <a href="<?= $getSubMainMenu_data['page_link'] ?>" class="text-capitalize"><?= $getSubMainMenu_data['title'] ?></a>
                                                    </li>
                                                <?php } ?>

                                            </ul>
                                        </li>

                                    <?php  } ?>




                                </ul>


                                <ul class="mobile-menu clearfix">
                                    <ul class="mobile-menu clearfix">

                                        <?php foreach ($menu_data as  $menu_data_menu) { ?>

                                            <li>
                                                <a href="<?= $menu_data_menu['page_link'] ?>" class="text-capitalize"><?= $menu_data_menu['title'] ?></a>
                                            </li>
                                        <?php     } ?>


                                        <?php foreach ($getMainMenuOfSub as $getMainMenuOfSubData) { ?>


                                            <li class="dropdown">




                                                <a href="/#" data-toggle="dropdown" class="text-capitalize">gallery</a>

                                                <?php
                                                $getSubMainMenu  = $data->getSubMainMenu($getMainMenuOfSubData['id'], $db);
                                                ?>

                                                <ul class="dropdown-menu">

                                                    <?php foreach ($getSubMainMenu as  $getSubMainMenu_data) { ?>
                                                        <li>
                                                            <a href="/image-gallery" class="text-capitalize">image gallery</a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>



                                            </li>

                                        <?php  } ?>




                                    </ul>
                                </ul>
                            </div>
                        </nav> <!-- End of #main_menu -->
                    </div>

                </div>


            </div> <!-- End of .conatiner -->
        </section>