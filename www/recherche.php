<?php
include_once("header.php");
if(isset($_POST["categorie"]))

?>
<div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div id="articles">
                <br>
                    <div class="panel panel-default">
                        <div class="panel-heading"></div>
                        <div class="panel-body">
                            <div class="col-md-2"><img src="../assets/img/pneu.jpg" class="annonce"/></div>
                            <div class="col-md-6">
                                <ul>
                                    <li>Catégorie:</li>
                                    <li>Largeur:</li>
                                    <li>Serie:</li>
                                    <li>Jante:</li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-footer">Prix:<button class="panier"> Ajouter au panier <span class="glyphicon glyphicon-shopping-cart"></span></button></div>
                    </div>
        </div>
    </div>
</div>

<?php
include_once("footer.php");
?>