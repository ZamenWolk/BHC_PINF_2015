<?php
include_once "../secret/credentials.php";
include_once("header.php");
include_once "../assets/php/fonctions/fonctionRecherche.php";
//TODO : QUand le doc est pret charger les variables php en js ensuite en Ajax la fonction rechercher pour la page etafficher les résultats
// Refaire les étapes précédentes si on change  les critére ou si on change de page en actualisant les paramètres










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
        $.post("../assets/php/ajax/recherche.php", {action: "chargement"}, function (data){
            //data = JSON.parse(data);
            console.log(data);

        });
        console.log(categorie);
        console.log(largeur);
        console.log(serie);
    });
</script>

<?php
echo Recherche::rechercher("Toutes","Toutes","Toutes","Toutes","Toutes","Toutes","Toutes",1);

include_once("footer.php");
?>