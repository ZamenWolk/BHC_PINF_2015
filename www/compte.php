<?php
include_once("header.php");
?>

<script src="../assets/js/script_compte.js">


</script>

<div class="row">
    <h2 class="page-header">Mes informations</h2>
    <div class="col-md-offset-1 col-md-9 personal-info">

        <form class="form-horizontal" role="form">
            <div class="row form-group">
                <label class="col-lg-4 control-label">Nom:</label>
                <div class="col-lg-8">
                    <h5 id="nom" class="titres"></h5>

                </div>
            </div>
            <div class="row form-group">
                <label class="col-lg-4 control-label">Prénom:</label>
                <div class="col-lg-8">
                    <h5 id="prenom" class="titre"></h5>
                </div>
            </div>

            <div class="row form-group">
                <label class="col-lg-4 control-label">Téléphone:</label>
                <div class="col-lg-8">
                    <h5 id="tel" class="titre"></h5>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-lg-4 control-label">Adresse:</label>
                <div class="col-lg-8">
                    <h5 id="ligne1" class="titre"></h5>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-lg-4 control-label">Complément d'adresse:</label>
                <div class="col-lg-8">
                    <h5 id="ligne2" class="titre"></h5>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-lg-4 control-label">Code postal:</label>
                <div class="col-lg-8">
                    <h5 id="codeP" class="titre"></h5>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-lg-4 control-label">Ville:</label>
                <div class="col-lg-8">
                    <h5 id="ville" class="titre"></h5>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-lg-4 control-label">Email:</label>
                <div class="col-lg-8">
                    <h5 id="mail" class="titre"></h5>
                </div>
            </div>

            <div class="row form-group">
                <label class="col-lg-4 control-label">Newsletter:</label>
                <div class="col-lg-8">
                    <h5 id="newsletter" class="titre"></h5>
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
                    var user_id = data["user"]["ID"];
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
                                var ligne1 = data2["adresse"]["adresse_ligne1"];
                                var ligne2 = data2["adresse"]["adresse_ligne2"];
                                var codeP = data2["adresse"]["adresse_codeP"];
                                var ville = data2["adresse"]["adresse_ville"];

                                $("#ligne1").html(ligne1);
                                $("#ligne2").html(ligne2);
                                $("#codeP").html(codeP);
                                $("#ville").html(ville);
                            }
                        });

                }

            });


    });
</script>
<?php
include_once("footer.php");
?>
