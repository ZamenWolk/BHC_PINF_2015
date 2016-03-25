<?php
include_once("header.php");
?>

<script src="../assets/js/script_compte.js">


</script>


<div class="row">
    <div class="col-md-offset-1 col-md-11"><h1>Mon compte</h1></div>

</div>
<div class="row">
    <div class="col-md-12">
        <hr>
    </div>
</div>
<div class="row">
    <!-- Colonne de gauche si besoin est -->
    <!-- <div class="col-md-3">
       <div class="text-center">
         <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
         <h6></h6>

         <input type="file" class="form-control">
       </div>
     </div> -->

    <!-- edit form column --><!--TODO: rajouter un petit JQuery pour le supprimer aprés x temps-->
    <div class="col-md-offset-1 col-md-9 personal-info">

        <div class="row">
            <div class="col-md-offset-1 col-md-11"><h3>Mes informations</h3></div>
        </div>


        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-lg-3 control-label">Nom:</label>
                <div class="col-lg-8">
                    <h5 id="nom" class="titres"></h5>
                    <!-- INSERT PHP HERE  -->

                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Prénom:</label>
                <div class="col-lg-8">
                    <h5 id="prenom" class="titre"></h5>
                    <!-- INSERT PHP HERE  -->
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Téléphone:</label>
                <div class="col-lg-8">
                    <h5 id="tel" class="titre"></h5>
                    <!-- INSERT PHP HERE  -->
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Adresse:</label>
                <div class="col-lg-8">
                    <h5 id="adresse" class="titre"></h5>
                    <!-- INSERT PHP HERE  -->
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Ville:</label>
                <div class="col-lg-8">
                    <h5 id="ville" class="titre"></h5>
                    <!-- INSERT PHP HERE  -->
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Code postal:</label>
                <div class="col-lg-8">
                    <h5 id="code" class="titre"></h5>
                    <!-- INSERT PHP HERE  -->
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Email:</label>
                <div class="col-lg-8">
                    <h5 id="mail" class="titre"></h5>
                    <!-- INSERT PHP HERE  -->
                </div>
            </div>
            <div id="divMdp1" class="form-group">
                <label class="col-md-3 control-label">Mot de passe:</label>
                <div class="col-md-8">
                    <input id="mdp1" class="form-control" type="password" value="11111122333"><!-- INSERT PHP HERE  -->
                </div>
            </div>
            <div id="divMdp2" class="form-group">
                <label class="col-md-3 control-label">Confirmation du mot de passe:</label>
                <div class="col-md-8">
                    <input id="mdp2" class="form-control" type="password" value="11111122333"><!-- INSERT PHP HERE  -->
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Newsletter:</label>
                <div class="col-lg-8">
                    <h5 id="newsletter" class="titre"></h5>
                    <!-- INSERT PHP HERE  -->
                </div>
            </div>


            <div class="form-group">
                <label class="col-md-3 control-label"></label>
                <div id="boutons" class="col-md-8">
                    <input id="btn1" type="button" class="btn btn-primary" value="Confirmer modifications">


                    <span></span>
                    <input id="btn2" type="reset" class="btn btn-default" value="Annuler">
                    <input id="modif" type="button" class="btn btn-primary" value="Modifier informations"> <br> <br>

                    <div id="errMdp" class='alert alert-danger' role='alert'> les mots de passe ne correspondent pas
                    </div>
                    <div hidden id="succesRequete" class='alert alert-success' role='alert'> les informations on été
                        modifiées avec succès
                    </div>


                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $.post(
            "../assets/php/ajax/user.php",
            {
                action: "getConnectedUser"
            },
            function (data) {
                data = JSON.parse(data);
                console.log(data);

                if (data["etat"] == "reussite") {
                    var user_id = data["user"]["id"];
                    var email = data["user"]["mail"];
                    var name = data["user"]["nom"];
                    var surname = data["user"]["prenom"];
                    var newsletter = data["user"]["newsletter"];
                    var telephone = data["user"]["telephone"];

                    $("#mail").html(email);
                    $("#nom").html(name);
                    $("#prenom").html(surname);
                    $("#tel").html(telephone);
                    if (newsletter == 1) {
                        $("#newsletter").html("Vous êtes inscrit à notre newsletter");
                    } else $("#newsletter").html("Vous n'êtes pas inscrit à notre newsletter");
                    $.post(
                        "../assets/php/ajax/adresse.php",
                        {
                            action: "getAdresse",
                            user_id: user_id
                        },
                        function (data2) {
                            data2 = JSON.parse(data2);
                            console.log(data2);
                            if(data2["etat"] == "reussite") {

                            }
                        });

                }

            });


    });
</script>
<?php
include_once("footer.php");
?>
