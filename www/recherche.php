<?php
include_once "../secret/credentials.php";
include_once("header.php");
include_once "../assets/php/fonctions/fonctionRecherche.php";
//TODO : Quand le doc est pret charger les variables php en js ensuite en Ajax la fonction rechercher pour la page etafficher les résultats
// Refaire les étapes précédentes si on change  les critére ou si on change de page en actualisant les paramètres










?>


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

<script>
    $(document).ready(function(){
        var categorie= "<?php  echo $_GET['categorie'];?>";
        var marque=  "<?php echo $_GET['marque'];?>";
        var largeur= "<?php echo $_GET['largeur'];?>";
        var serie= "<?php echo $_GET['serie'];?>";
        var jante = "<?php echo $_GET['jante']; ?>";
        var charge= "<?php echo $_GET['charge'];?>";
        var vitesse= "<?php echo $_GET['vitesse'];?>";
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
                vitesse: vitesse
            },
            function (data){
            data = JSON.parse(data);

            console.log(data);
            if(data["etat"]== "reussite") {
                if (data["nbrResult"] > 0) {
                    for (var i = 0; i < data["nbrResult"]; i++) {
                        var marque = data["resultat"][i]["pneu_marque"];
                        var categorie = data["resultat"][i]["pneu_categorie"];
                        var largeur = data["resultat"][i]["pneu_largeur"];
                        var serie = data["resultat"][i]["pneu_serie"];
                        var jante = data["resultat"][i]["pneu_jante"];
                        var charge = data["resultat"][i]["pneu_charge"];
                        var vitesse = data["resultat"][i]["pneu_vitesse"];
                        var description = data["resultat"][i]["pneu_description"];
                        var prix = data["resultat"][i]["pneu_prix"];// Attention peut être à changer pour tenir compte du multplicateur
                        //console.log(marque);
                        //console.log("Je boucle" + i);
                        var jQ = $(".model_article").clone();
                        jQ.removeClass("model_article").children(".panel-heading").html("<b>" + marque + "</b>   " + description);
                        var panelBody = jQ.children(".panel-body");
                        //console.log(panelBody);
                        var div_panel = panelBody.children(".col-md-6");
                        var ul_panel = div_panel.children("ul");
                        ul_panel.children(".largeur").html("Largeur:  " + serie);
                        ul_panel.children(".categorie").html("Categorie: " + categorie);
                        ul_panel.children(".serie").html("Serie:  " + serie);
                        ul_panel.children(".jante").html("Jante:  " + jante);
                        var ref = data["resultat"][i]["pneu_ref"];
                        jQ.children(".panel-footer").html("Prix:" + prix+"<button value=\""+ref+"\" class='panier'> Ajouter au panier <span class=\"glyphicon glyphicon-shopping-cart\"> </button>"
                    );


                        $("#articles").append(jQ)
                    }
                    $(".model_article").hide();
                }
                else
                {
                    $(".model_article").hide();
                    var div_article = $(".articles").html("<h2>Nous somme désolé mais il n'y a aucun pneus correspondant à vos critères de recherches.</h2>")
                }
            }
        });
      //  console.log(categorie);
        //console.log(largeur);
        //console.log(serie);
    });
</script>

<?php
include_once("footer.php");
?>