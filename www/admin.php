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
            <div id="coef">
                <h3>Modifier le coefficient</h3>
                <input type="number" step='0.01' min='0' class="form-control" id="ratio" placeholder=""/></br>
                <button id="validCoef" type="button" class="btn btn-block btn-default btn-lg">Modifier</button>
            </div>
            <div id="creerModo">
                <h3>Créer un modérateur</h3>
                <input type="text" class="form-control" id="nameModo" placeholder="Nom"/></br>
                <input type="password" class="form-control" id="passeModo" placeholder="Mot de passe"/></br>
                <input type="password" class="form-control" id="passeModo2"
                       placeholder="Comfirmez le mot de passe"/></br>
                <button id="newModo" type="button" class="btn btn-block btn-default btn-lg">Ajouter</button>
            </div>
            <div id="newsletter">
                <h3>Envoyer un message de newsletter</h3>
                <label for="obj" class="sr-only">Objet</label>
                <input type="text" class="form-control" id="obj" placeholder="Objet"/></br>
                <textarea id="message" class="form-control"
                          placeholder="Composez votre message ici ..."></textarea></br>
                <button id="sendNews" type="button" class="btn btn-block btn-default btn-lg"><i
                        class="fa fa-envelope-o"></i> Envoyer
                </button>
            </div>
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

            $.post("../assets/php/ajax/admin.php", {
                action: "getConnectedAdmin"
            }, function (data) {

                data = JSON.parse(data);
                if (data["etat"] == "reussite") {


                    $("#echecNewPasse").hide();
                    $("#succesRequete").hide();
                    $("#coef").hide();
                    $("#creerModo").hide();
                    $("#newsletter").hide();

                    var nameModo, passeModo, passeModo2, ratio;

                    $("#createModo").click(function () {
                        $(document).on("change", "#nameModo", function () {
                            nameModo = $(this).val();
                        });

                        $(document).on("change", "#passeModo", function () {
                            passeModo = $(this).val();
                        });

                        $(document).on("change", "#passeModo2", function () {
                            passeModo2 = $(this).val();
                        });

                        $("#coef").hide();
                        $("#newsletter").hide();
                        $(".separator2").hide();
                        $("#creerModo").show();
                    });

                    $(document).on("click", "#newModo", function () {
                        if (passeModo == passeModo2) {
                            $.post("../assets/php/ajax/admin.php", {
                                action: "inscrire",
                                nom: nameModo,
                                password: passeModo
                            }, function (data) {
                                data = JSON.parse(data);
                                console.log(data);
                                if (data.etat == "reussite") {
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

                        $("#coef").hide();
                        $("#creerModo").hide();
                        $("#newsletter").show();
                        $(".separator2").hide();
                    });

                    $("#sendNews").click(function () {
                        console.log("ça clique hein");
                    });

                    $("#modifCoef").click(function () {

                        $("#creerModo").hide();
                        $("#newsletter").hide();
                        $(document).on("change", "#ratio", function () {
                            ratio = $(this).val();
                        });
                        $.post("../assets/php/ajax/config.php", {
                            action: "getRatio"
                        }, function (data) {
                            data = JSON.parse(data);
                            console.log(data);
                            $(".separator2").hide();
                            $("#coef").show();
                            $("#coef").children("input").attr("placeholder", data["ratio"]);
                        });

                    });

                    $(document).on("click", "#validCoef", function () {
                        console.log(ratio);
                        $.post("../assets/php/ajax/config.php", {
                            action: "setRatio",
                            newRatio: ratio
                        }, function (data) {
                            data = JSON.parse(data);
                            console.log(data);
                            if (data.etat == "reussite") {
                                $("#succesRequete").slideDown().delay(6000).slideUp();
                                $(".separator2").show();
                                $("#coef").hide();
                            }
                        });
                    });

                } else document.location.href = "./accueil";
            });
        });
    </script>
<?php
include_once("footer.php");
?>