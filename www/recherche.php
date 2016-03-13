<?php
include_once "../secret/credentials.php";
include_once("header.php");
include_once "../assets/php/fonctions/fonctionRecherche.php";
//TODO : Quand le doc est pret charger les variables php en js ensuite en Ajax la fonction rechercher pour la page etafficher les résultats
// Refaire les étapes précédentes si on change  les critére ou si on change de page en actualisant les paramètres










?>
<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Page précédente</a></li>
            <li class="next"><a href="#">Page suivante <span aria-hidden="true">&rarr;</span></a></li>
        </ul>
    </nav>
</div>
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div id="articles">
            <br>
                <div class="panel panel-default model_article">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <div class="col-md-2"><img src="../assets/img/pneu.jpg" class="annonce"/></div>
                        <div class="col-md-6">
                            <ul>
                                <li class="categorie" >Catégorie:</li>
                                <li class="largeur" >Largeur:</li>
                                <li class="serie">Serie:</li>
                                <li class="jante">Jante:</li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-footer">Prix:<button class="panier"> Ajouter au panier <span class="glyphicon glyphicon-shopping-cart"></span></button></div>
                </div>
        </div>
    </div>
</div>
<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Page précédente</a></li>
            <li class="next"><a href="#">Page suivante <span aria-hidden="true">&rarr;</span></a></li>
        </ul>
    </nav>
</div>

<script>
    $(document).ready(function(){
        var numero_page=1;
        var categorie= "<?php  echo $_GET['categorie'];?>";
        var marque=  "<?php echo $_GET['marque'];?>";
        var largeur= "<?php echo $_GET['largeur'];?>";
        var serie= "<?php echo $_GET['serie'];?>";
        var jante = "<?php echo $_GET['jante']; ?>";
        var charge= "<?php echo $_GET['charge'];?>";
        var vitesse= "<?php echo $_GET['vitesse'];?>";
        var order= "<?php echo $_GET['tri'];?>";
        var model= $(".model_article");
        var div_articles=$("#articles");
        $.post(
            "../assets/php/ajax/recherche.php",
            {
                action: "chargement",
                categorie: categorie,
                marque: marque,
                largeur: largeur,
                serie: serie,
                jante: jante,
                charge: charge,
                vitesse: vitesse,
                numeroPage: numero_page,
                order: order
            },
            function (data){
            data = JSON.parse(data);

            console.log(data);
            if(data["etat"]== "reussite") {
                if (data["nbrResult"] > 0) {
                    for (var i = 0; i < data["nbrResult"]; i++) {
                        var pneu_marque = data["resultat"][i]["pneu_marque"];
                        var pneu_categorie = data["resultat"][i]["pneu_categorie"];
                        var pneu_largeur = data["resultat"][i]["pneu_largeur"];
                        var  pneu_serie = data["resultat"][i]["pneu_serie"];
                        var  pneu_jante = data["resultat"][i]["pneu_jante"];
                        var  pneu_charge = data["resultat"][i]["pneu_charge"];
                        var  pneu_vitesse = data["resultat"][i]["pneu_vitesse"];
                        var  pneu_description = data["resultat"][i]["pneu_description"];
                        var  pneu_prix = data["resultat"][i]["pneu_prix"];// Attention peut être à changer pour tenir compte du multplicateur
                        //console.log(marque);
                        //console.log("Je boucle" + i);
                        var jQ = model.clone();
                        jQ.removeClass("model_article").children(".panel-heading").html("<b>" + pneu_marque + "</b>   " +  pneu_description);
                        var panelBody = jQ.children(".panel-body");
                        //console.log(panelBody);
                        var div_panel = panelBody.children(".col-md-6");
                        var ul_panel = div_panel.children("ul");
                        ul_panel.children(".largeur").html("Largeur:  " +  pneu_largeur);
                        ul_panel.children(".categorie").html("Categorie: " +  pneu_categorie);
                        ul_panel.children(".serie").html("Serie:  " +  pneu_serie);
                        ul_panel.children(".jante").html("Jante:  " +  pneu_jante);
                        var  pneu_ref = data["resultat"][i]["pneu_ref"];

                        jQ.children(".panel-footer").html("Prix:" +pneu_prix+" € <button value=\""+ pneu_ref+"\" class='panier'> Ajouter au panier <span class=\"glyphicon glyphicon-shopping-cart\"> </button>"
                    );


                        div_articles.append(jQ)
                    }
                    model.hide();
                }
                else
                {
                    model.hide();
                    div_articles.html("<h2 style='color:white' >Nous somme désolé mais il n'y a aucun pneus correspondant à vos critères de recherches.</h2>");
                }
            }


            /* Gestion des boutons suivant et précédent*/
            var prev = $(".previous");
            var activePrev =false;
            var suiv = $(".next");
            var activeNext =true;
            prev.addClass("disabled");

            prev.click(function(){
                if(activePrev){
                    numero_page--;
                    $.post(
                        "../assets/php/ajax/recherche.php",
                        {
                            action: "chargement",
                            categorie: categorie,
                            marque: marque,
                            largeur: largeur,
                            serie: serie,
                            jante: jante,
                            charge: charge,
                            vitesse: vitesse,
                            numeroPage: numero_page,
                            order: order
                        },
                        function (data) {
                            data = JSON.parse(data);
                            if(numero_page == 1 )
                            {
                                prev.addClass("disabled");
                                activePrev = false;
                            }
                            if(data["nbrResult"]==25)
                            {
                                suiv.removeClass("disabled");
                                activeNext = true;
                            }
                            div_articles.html("");
                            if(data["etat"]== "reussite") {
                                if (data["nbrResult"] > 0) {
                                    for (var i = 0; i < data["nbrResult"]; i++) {
                                        var pneu_marque = data["resultat"][i]["pneu_marque"];
                                        var pneu_categorie = data["resultat"][i]["pneu_categorie"];
                                        var pneu_largeur = data["resultat"][i]["pneu_largeur"];
                                        var  pneu_serie = data["resultat"][i]["pneu_serie"];
                                        var  pneu_jante = data["resultat"][i]["pneu_jante"];
                                        var  pneu_charge = data["resultat"][i]["pneu_charge"];
                                        var  pneu_vitesse = data["resultat"][i]["pneu_vitesse"];
                                        var  pneu_description = data["resultat"][i]["pneu_description"];
                                        var  pneu_prix = data["resultat"][i]["pneu_prix"];// Attention peut être à changer pour tenir compte du multplicateur
                                        //console.log(marque);
                                        //console.log("Je boucle" + i);
                                        var jQ = model.clone();
                                        jQ.removeClass("model_article").children(".panel-heading").html("<b>" + pneu_marque + "</b>   " +  pneu_description);
                                        var panelBody = jQ.children(".panel-body");
                                        //console.log(panelBody);
                                        var div_panel = panelBody.children(".col-md-6");
                                        var ul_panel = div_panel.children("ul");
                                        ul_panel.children(".largeur").html("Largeur:  " +  pneu_largeur);
                                        ul_panel.children(".categorie").html("Categorie: " +  pneu_categorie);
                                        ul_panel.children(".serie").html("Serie:  " +  pneu_serie);
                                        ul_panel.children(".jante").html("Jante:  " +  pneu_jante);
                                        var  pneu_ref = data["resultat"][i]["pneu_ref"];

                                        jQ.children(".panel-footer").html("Prix:" +pneu_prix+" € <button value=\""+ pneu_ref+"\" class='panier'> Ajouter au panier <span class=\"glyphicon glyphicon-shopping-cart\"> </button>"
                                        );


                                        div_articles.append(jQ);
                                        jQ.show();
                                    }
                                    model.hide();
                                }
                                else
                                {
                                    model.hide();
                                    div_articles.html("<h2 style='color:white' >Nous somme désolé mais il n'y a aucun pneus correspondant à vos critères de recherches.</h2>");
                                }
                            }

                        });
                }
            });
            suiv.click(function(){
                if(activeNext) {
                    numero_page++;
                    activePrev = true;
                    $.post(
                        "../assets/php/ajax/recherche.php",
                        {
                            action: "chargement",
                            categorie: categorie,
                            marque: marque,
                            largeur: largeur,
                            serie: serie,
                            jante: jante,
                            charge: charge,
                            vitesse: vitesse,
                            numeroPage: numero_page,
                            order: order
                        },
                        function (data) {
                            data = JSON.parse(data);
                            if (numero_page > 1) {
                                prev.removeClass("disabled");
                                activePrev = true;
                            }
                            if (data["nbrResult"] < 25) {
                                suiv.addClass("disabled");
                                activeNext = false;
                            }
                            div_articles.html("");
                            if (data["etat"] == "reussite") {
                                if (data["nbrResult"] > 0) {
                                    for (var i = 0; i < data["nbrResult"]; i++) {
                                        var pneu_marque = data["resultat"][i]["pneu_marque"];
                                        var pneu_categorie = data["resultat"][i]["pneu_categorie"];
                                        var pneu_largeur = data["resultat"][i]["pneu_largeur"];
                                        var pneu_serie = data["resultat"][i]["pneu_serie"];
                                        var pneu_jante = data["resultat"][i]["pneu_jante"];
                                        var pneu_charge = data["resultat"][i]["pneu_charge"];
                                        var pneu_vitesse = data["resultat"][i]["pneu_vitesse"];
                                        var pneu_description = data["resultat"][i]["pneu_description"];
                                        var pneu_prix = data["resultat"][i]["pneu_prix"];// Attention peut être à changer pour tenir compte du multplicateur
                                        //console.log(marque);
                                        //console.log("Je boucle" + i);
                                        var jQ = model.clone();
                                        jQ.removeClass("model_article").children(".panel-heading").html("<b>" + pneu_marque + "</b>   " + pneu_description);
                                        var panelBody = jQ.children(".panel-body");
                                        //console.log(panelBody);
                                        var div_panel = panelBody.children(".col-md-6");
                                        var ul_panel = div_panel.children("ul");
                                        ul_panel.children(".largeur").html("Largeur:  " + pneu_largeur);
                                        ul_panel.children(".categorie").html("Categorie: " + pneu_categorie);
                                        ul_panel.children(".serie").html("Serie:  " + pneu_serie);
                                        ul_panel.children(".jante").html("Jante:  " + pneu_jante);
                                        var pneu_ref = data["resultat"][i]["pneu_ref"];

                                        jQ.children(".panel-footer").html("Prix:" + pneu_prix + " € <button value=\"" + pneu_ref + "\" class='panier'> Ajouter au panier <span class=\"glyphicon glyphicon-shopping-cart\"> </button>"
                                        );


                                        div_articles.append(jQ);
                                        jQ.show();
                                    }
                                    model.hide();
                                }
                                else {
                                    model.hide();
                                    div_articles.html("<h2 style='color:white' >Nous somme désolé mais il n'y a aucun pneus correspondant à vos critères de recherches.</h2>");
                                }
                            }

                        });
                }
            });


        });
    });
</script>

<?php
include_once("footer.php");
?>