<?php
include_once("header.php");
?>
</div>
<div class="container-fluid">
    <!-- Indicators -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="../assets/img/car1.jpg" class="car-img img-responsive">
                <div class="carousel-caption">
                    <h2>Bienvenue sur JS Pneus !</h2>
                    <p>Site de vente de pneus pour auto et moto</p>
                </div>
            </div>
            <div class="item">
                <img src="../assets/img/car2.jpg" class="car-img img-responsive">
                <div class="carousel-caption">
                    <h2>Un vaste choix de pneus</h2>
                    <p>Choisissez les pneus qu'il vous faut parmi une grande sélection de marques</p>
                </div>
            </div>
            <div class="item">
                <img src="../assets/img/car3.jpg" class="car-img img-responsive">
                <div class="carousel-caption">
                    <h2>Les prix les plus bas</h2>
                    <p>Des prix défiant toute concurrence !</p>
                </div>
            </div>
        </div>
        <!-- Left and right controls -->

        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="fa fa-angle-left fa-3x" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="fa fa-angle-right fa-3x" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>
    <hr>
    <div class="row">

        <div class="col-lg-4 img-col" id="home1">
            <div class="hovereffect">
                <a href="#">
                    <img class="img-responsive" src="../assets/img/home1.png">
                    <div class="overlay">
                        <h2>Catalogue</h2>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-4 img-col" id="home2">
            <div class="hovereffect">
                <a href="#">
                    <img class="img-responsive" src="../assets/img/home2.png">
                    <div class="overlay">
                        <h2>F.A.Q.</h2>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-4 img-col" id="home3">
            <div class="hovereffect">
                <a href="#">
                    <img class="img-responsive" src="../assets/img/home3.png">
                    <div class="overlay">
                        <h2>Contact</h2>
                    </div>
                </a>
            </div>
        </div>

    </div>
</div>
</div>
<div class="container" style="height: 0">
    <?php
    include_once("footer.php");
    ?>
