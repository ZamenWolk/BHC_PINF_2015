<?php
include_once "../secret/credentials.php";
include_once("header.php");
//include_once "../assets/php/fonctions/Recherche.php";
//TODO : Quand le doc est pret charger les variables php en js ensuite en Ajax la fonction rechercher pour la page etafficher les résultats
// Refaire les étapes précédentes si on change  les critére ou si on change de page en actualisant les paramètres

?>
    <nav>
        <ul class="pager">
            <li class="previous"><a href="#"><i class="fa fa-arrow-left fa-fw"></i>Page précédente</a></li>
            <li class="next"><a href="#">Page suivante<i class="fa fa-arrow-right fa-fw"></i></a></li>
        </ul>
    </nav>

    <div class="row">
        <div class="well">
            <h1 class="text-center">RECHERCHE</h1>
            <div class="list-group">
                <div class="row" id="articles">
                    <div class="model_article">
                        <div class="col-md-10 list-group-item">
                            <a href="#" id="item-link">
                                <div class="col-md-2 logo-img">
                                    <img src="" alt="Pas d'image disponible" class="annonce img-responsive"/>
                                </div>
                                <div class="col-md-8 list-group-desc">
                                    <h4 class="list-group-item-heading"></h4>
                                    <dl class="col-md-3 dl-horizontal">
                                        <dt>Catégorie:</dt>
                                        <dd class="categorie"></dd>
                                        <dt>Largeur:</dt>
                                        <dd class="largeur"></dd>
                                        <dt>Série:</dt>
                                        <dd class="serie"></dd>
                                        <dt>Jante:</dt>
                                        <dd class="jante"></dd>
                                    </dl>
                                    <dl class="col-md-3 col-md-offset-2 dl-horizontal">
                                        <dt>Charge:</dt>
                                        <dd class="charge"></dd>
                                        <dt>Vitesse:</dt>
                                        <dd class="vitesse"></dd>
                                        <dt>Conso:</dt>
                                        <dd class="consommation"></dd>
                                        <dt>Décibels:</dt>
                                        <dd class="decibel"></dd>
                                    </dl>
                                </div>
                                <div class="col-md-2 text-center price-div">
                                    <h4 id="price">Prix:</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2 catalog-cart-div">
                            <label for="qte">Quantité: </label>
                            <select class="form-control" id="qte">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            <button type="button" class="btn btn-default btn-block pull-right shop-btn"><span
                                    class="fa fa-shopping-cart"
                                    aria-hidden="true"></span> Ajouter au panier
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav>
        <ul class="pager">
            <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Page précédente</a></li>
            <li class="next"><a href="#">Page suivante <span aria-hidden="true">&rarr;</span></a></li>
        </ul>
    </nav>

    <script src="../assets/js/recherche.js"></script>

<?php
include_once("footer.php");
?>