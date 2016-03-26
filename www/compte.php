<?php
include_once("header.php");
?>

<script src="../assets/js/script_compte.js">


</script>

<div class="row">
    <h2 class="page-header">Mes informations</h2>
    <div class="col-md-offset-1 col-md-9 personal-info">
        <div class="alert alert-success" role="alert" id="succesRequete">
            <i class="fa fa-check-square-o fa-fw"></i>
            <strong>Modifications enregistrées !</strong>
        </div>
        <form class="form-horizontal" role="form">
            <div class="row form-group">
                <label class="col-lg-4 control-label">Nom:</label>
                <div class="col-lg-8">
                    <h5 id="ins_nom"></h5>

                </div>
            </div>
            <div class="row form-group">
                <label class="col-lg-4 control-label">Prénom:</label>
                <div class="col-lg-8">
                    <h5 id="ins_prenom"></h5>
                </div>
            </div>

            <div class="row form-group">
                <label class="col-lg-4 control-label">Téléphone:</label>
                <div class="col-lg-8">
                    <h5 id="ins_tel"></h5>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-lg-4 control-label">Adresse:</label>
                <div class="col-lg-8">
                    <h5 id="ins_adress"></h5>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-lg-4 control-label">Complément d'adresse:</label>
                <div class="col-lg-8">
                    <h5 id="ins_comp_adress"></h5>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-lg-4 control-label">Code postal:</label>
                <div class="col-lg-8">
                    <h5 id="ins_postal"></h5>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-lg-4 control-label">Ville:</label>
                <div class="col-lg-8">
                    <h5 id="ins_ville"></h5>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-lg-4 control-label">Email:</label>
                <div class="col-lg-8">
                    <h5 id="ins_mail"></h5>
                </div>
            </div>

            <div class="row form-group">
                <label class="col-lg-4 control-label">Newsletter:</label>
                <div class="col-lg-8">
                    <h5 id="ins_newsletter"></h5>
                    <div class="btn-group" id="checkbox">
                        <label for="ins_newsletter" class="btn btn-default active">
                            <span class="fa fa-check fa-fw"></span>
                            <span> </span>
                        </label>
                        <label for="ins_newsletter" class="btn btn-default">J'accepte de recevoir des offres
                            promotionnelles de JS Pneus</label>
                    </div>
                </div>
            </div>
        </form>
        <button type="button" class="btn btn-default pull-right" id="modif">Modifier mes informations</button>
        <button type="button" class="btn btn-default pull-right" id="validate">Enregistrer les modifications</button>
        <button type="button" class="btn btn-default pull-right" id="cancel">Annuler</button>
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
                    var user_id = data["user"]["ID"];
                    var email = data["user"]["mail"];
                    var name = data["user"]["nom"];
                    var surname = data["user"]["prenom"];
                    var newsletter = data["user"]["newsletter"];
                    var telephone = data["user"]["telephone"];

                    $("#ins_mail").html(email);
                    $("#ins_nom").html(name);
                    $("#ins_prenom").html(surname);
                    $("#ins_tel").html(telephone);
                    if (newsletter == 1) {
                        $("#ins_newsletter").html("Vous êtes inscrit à notre newsletter");
                    } else $("#ins_newsletter").html("Vous n'êtes pas inscrit à notre newsletter");
                    $.post(
                        "../assets/php/ajax/adresse.php",
                        {
                            action: "getAdresse",
                            user_id: user_id
                        },
                        function (data2) {
                            data2 = JSON.parse(data2);
                            console.log(data2);
                            if (data2["etat"] == "reussite") {
                                var ligne1 = data2["adresse"]["adresse_ligne1"];
                                var ligne2 = data2["adresse"]["adresse_ligne2"];
                                var codeP = data2["adresse"]["adresse_codeP"];
                                var ville = data2["adresse"]["adresse_ville"];

                                $("#ins_adress").html(ligne1);
                                $("#ins_comp_adress").html(ligne2);
                                $("#ins_postal").html(codeP);
                                $("#ins_ville").html(ville);
                            }
                        });

                }

            });


    });
</script>
<?php
include_once("footer.php");
?>
