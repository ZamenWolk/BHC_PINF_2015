<?php
include_once("header.php");
?>

    <div class="row"> <!-- création d'une ligne -->
        <h1>Administration</h1>
        <div class="col-md-4" id="menu"> <!-- 8 colonnes pour la zone principale -->
            <div class="separator">
                <h4>Gestion des comptes</h4>
                <button id="createUser" type="button" class="btn btn-default btn-lg btn-block" data-toggle="modal"
                        data-target="#myModal">Créer un compte
                    utilisateur
                </button>
                <button id="createModo" type="button" class="btn btn-default btn-lg btn-block">Créer un compte
                    modérateur
                </button>
                <button id="banUser" type="button" class="btn btn-default btn-lg btn-block">Bannir un compte</button>
            </div>
            <div class="separator">
                <h4>Gestion des commandes</h4>
                <button id="createOrder" type="button" class="btn btn-default btn-lg btn-block">Voir les commandes
                </button>
            </div>
            <div class="separator">
                <h4>Autre</h4>
                <button id="modifCoef" type="button" class="btn btn-default btn-lg btn-block">Modifier coefficient des
                    prix
                </button>
                <button id="newsLetter" type="button" class="btn btn-default btn-lg btn-block">Envoyer une newsletter
                </button>
            </div>
        </div>
        <div class="col-md-8" id="content">
            <div class="separator2">
                <p>Bienvenue dans le menu d'administration !</p>
                <p>Pour commencer à administrer le site, cliquez sur le bouton correspondant à l'opération que vous
                    souhaitez faire.</p>
            </div>
            <div class="alert alert-success" role="alert" id="succesRequete">
                <i class="fa fa-check-square-o fa-fw"></i>
                <strong>Modifications enregistrées !</strong>
            </div>
            <div class="alert alert-danger" role="alert" id="echecNewPasse">
                <i class="fa fa-exclamation-triangle fa-fw"></i>
                <strong>Les mots de passes ne correspondent pas</strong>
            </div>
            <p id="texte"></p>
        </div>
    </div>

    <script>

        var panier;
        var prixTotal;
        var newsletter = 0;
        var set = 0;
        $.post("panier.php", {action: "contenuPanier"}, function (data) {
            if (data["etat"] == "reussite") {
                panier = data["panier"];
                prixTotal = data["prixTotal"];
            }
        });


        $(document).ready(function () {

            $("#echecNewPasse").hide();
            $("#succesRequete").hide();

            var nameModo, passeModo, passeModo2;

            $("#createModo").click(function() {
                $(document).on("change", "#nameModo", function () {
                    nameModo = $(this).val();
                });

                $(document).on("change", "#passeModo", function () {
                    passeModo = $(this).val();
                });

                $(document).on("change", "#passeModo2", function () {
                    passeModo2 = $(this).val();
                });
                $("#texte").append("<h3>Créer un modérateur</h3>");
                $("#texte").append("<input type=\"text\" class=\"form-control\" id=\"nameModo\" placeholder=\"Nom\"/></br>");
                $("#texte").append("<input type=\"password\" class=\"form-control\" id=\"passeModo\" placeholder=\"Mot de passe\"/></br>");
                $("#texte").append("<input type=\"password\" class=\"form-control\" id=\"passeModo2\" placeholder=\"Comfirmez le mot de passe\"/></br>");
                $("#texte").append("<button id=\"newModo\" type=\"button\" class=\"btn btn-block btn-default btn-lg\">Ajouter");
                $(".separator2").hide();
                $("#texte").show();
            });

            $(document).on("click", "#newModo", function() {
                if(passeModo == passeModo2) {
                    $.post("../assets/php/ajax/admin.php", {
                        action: "inscrire",
                        nom: nameModo,
                        password: passeModo
                    }, function (data) {
                        data = JSON.parse(data);
                        console.log(data);
                        if(data.etat == "reussite") {
                            $("#succesRequete").slideDown().delay(6000).slideUp();
                        }
                    });
                } else $("#echecNewPasse").slideDown().delay(6000).slideUp();

            });

            $("#createOrder").click(function () {
                $.post('../assets/php/ajax/pdf.php',
                    {
                        action: "gen_commande",
                        client_nom: "George",
                        client_prenom: "deLaJungle",
                        client_adresse: "La jungle"
                    },
                    function (data) {
                        console.log(data);
                        //document.open("../assets/php/ajax/test.pdf",'_blank');
                        var win = window.open("../assets/php/ajax/test.pdf", '_blank');
                        win.focus();
                    });
            });

            $("#newsLetter").click(function () {

                if (newsletter == 0) {
                    if (set == 0) {
                        $("#texte").append("<h3>Envoyer un message de newsletter</h3>");
                        $("#texte").append("<label for=\"obj\" class=\"sr-only\">Objet</label>");
                        $("#texte").append("<input type=\"text\" class=\"form-control\" id=\"obj\" placeholder=\"Objet\"/></br>");
                        $("#texte").append('<textarea id="message" class="form-control" placeholder="Composez votre message ici ..."></textarea></br>');
                        $("#texte").append("<button id=\"sendNews\" type=\"button\" class=\"btn btn-block btn-default btn-lg\"><i class=\"fa fa-envelope-o\"></i> Envoyer");
                        set = 1;
                    }
                    $(".separator2").hide();
                    $("#texte").show();
                    newsletter = 1;
                }
                else if (newsletter == 1) {
                    $(".separator2").show();
                    $("#texte").hide();
                    newsletter = 0;
                }
            });

            $("#sendNews").click(function () {
                console.log("ça clique hein");
            });

            $("#modifCoef").click(function () {
                $("#texte").append("<h3>Modifier le coefficient</h3>");
                $("#texte").append("<input type=\"text\" class=\"form-control\" id=\"obj\" placeholder=\"\"/></br>");
                $("#texte").append("<button id=\"validCoef\" type=\"button\" class=\"btn btn-block btn-default btn-lg\">Modifier");
                $(".separator2").hide();
                $("#texte").show();
            });


        });
    </script>
<?php
include_once("footer.php");
?>