<div class="row">

    <div class="col-md-2 filtre">
        <div class="panel panel-default" style="position: fixed; margin-top: 10px;">
            <div class="panel-heading">Affinage de la recherche</div>
            <div class="panel-body">
                Types de pneus:<br/>
                <input type="checkbox" value="pneus de camion"/>Pneus de Camion<br/>
                <input type="checkbox" value="pneus de voiture"/>Pneus de Voiture<br/>
                <input type="checkbox" value="pneus motos"/>Pneus Moto<br/>
                <br/>
                <br/>
                Classement:<br/>
                <select name="classement">
                    <option>Meilleures ventes
                    <option>Mieux notés
                </select>

                <br/>
                <br/>

                Choix des marques:<br/>
                <div class="btn-group">
                    <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Marques <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><input type="checkbox" class="marque" id="pneu">yokohama</li>
                        <li><input type="checkbox" class="marque">bridgestone</li>
                        <li><input type="checkbox" class="marque">michelin</li>
                    </ul>
                </div>
                <br/>
                <br/>

                <button class="btn btn-default"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span>      Rechercher </button>



            </div>
        </div>

    </div>
    <div class="col-md-offset-1 col-md-8">
       <!-- <div class="pages" id="top">
            <ul class="pagination">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </div>-->
<?php
        include_once "lib/fonctionsBDD.php";

        //Ici on charge tous les pneus de la marque donnée à améliorer

        $marque = securite_bdd($_GET['marque']);
        $rch = rechercherParMarque($marque);
        foreach($rch AS $row){
            echo '<div id="articles">
                <div class="panel panel-default">
                    <div class="panel-heading">'.$row["marque"]." ".$row["dimension"].'</div>
                    <div class="panel-body">
                        <div class="col-md-2"><img src="ressources/pneu.jpg" class="annonce"/></div>
                        <div class="col-md-6">
                            <ul>
                                <li>Catégorie:'.$row["categorie"].'</li>
                                <li>Largeur:'.$row["largeur"].'</li>
                                <li>Serie:'.$row["serie"].'</li>
                                <li>Jante:'.$row["jante"].' pouces</li>
                                <li> <input type="number" name="your_awesome_parameter" id="some_id" class="rating" data-clearable="remove"/></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-footer">Prix:'.$row["prix"].' € <button class="panier"> Ajouter au panier <span class="glyphicon glyphicon-shopping-cart"></span></button></div>
                </div>';
        }



            ?>

        <!--<div class="pages">

            <ul class="pagination">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </div>-->

        <div style="text-align: center; margin-bottom: 30px;"> <a href="#top" >Retour en haut de page</a></div>
    </div>