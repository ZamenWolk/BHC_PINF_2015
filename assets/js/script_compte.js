//var flagMdp=true;
$(document).ready(function () {
    $("#validate").hide();
    $("#cancel").hide();
    $("#succesRequete").hide();
    $("#checkbox").hide();
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

                $(document).on("change", "#ins_mail", function () {
                    email = $(this).val();
                });
                $(document).on("change", "#ins_phone", function () {
                    telephone = $(this).val();
                });
                $(document).on("change", "#ins_nom", function () {
                    name = $(this).val();
                });
                $(document).on("change", "#ins_prenom", function () {
                    surname = $(this).val();
                });
                $(document).on("change", "#ins_newsletter", function () {
                    if (this.checked) {
                        newsletter = 1;
                    }
                    else newsletter = 0;
                });
                $('#modif').click(function () {
                    $("#validate").show();
                    $("#cancel").show();
                    $("#modif").hide();
                    $('h5').each(function () {
                        var elemH5 = $(this);
                        elemH5.replaceWith("<input id='" + $(this).attr("id") + "'  class='champs form-control' type='text' value='" + $(this).html() + "'>");
                    });
                    $("#ins_newsletter").replaceWith('<input type="checkbox" name="ins_newsletter" id="ins_newsletter" autocomplete="off"/>');
                    $("#checkbox").show();
                    if (newsletter == 1) {
                        $("#ins_newsletter").prop("checked", true);
                    }
                });

                $('#validate').click(function () {
                    $.post(
                        "../assets/php/ajax/user.php",
                        {
                            action: "changerInformations",
                            nom: name,
                            prenom: surname,
                            mail: email,
                            newsletter: newsletter,
                            telephone: telephone,
                            user_id: user_id
                        },
                        function (data) {
                            data = JSON.parse(data);
                            console.log(data);
                        }
                    );
                    $('input').each(function () {
                        var input = $(this);
                        input.replaceWith("<h5 id=" + $(this).attr("id") + "></h5>");
                    });
                    $("#ins_newsletter").replaceWith('<h5 id="ins_newsletter"></h5>');
                    $("#checkbox").hide();
                    $("#validate").hide();
                    $("#cancel").hide();
                    $("#modif").show();
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

                $('#cancel').click(function () {
                    $("#modif").show();
                    $("#cancel").hide();
                    $("#validate").hide();
                    $('input').each(function () {
                        var input = $(this);
                        input.replaceWith("<h5 id=" + $(this).attr("id") + "></h5>");
                    });
                    $("#ins_newsletter").replaceWith('<h5 id="ins_newsletter"></h5>');
                    $("#checkbox").hide();
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

                            }
                        });

                });
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


                            $(document).on("change", "#ins_adress", function () {
                                ligne1 = $(this).val();
                            });
                            $(document).on("change", "#ins_comp_adress", function () {
                                ligne2 = $(this).val();
                            });
                            $(document).on("change", "#ins_postal", function () {
                                codeP = $(this).val();
                            });
                            $(document).on("change", "#ins_ville", function () {
                                ville = $(this).val();
                            });

                            $('#validate').click(function () {
                                $.post(
                                    "../assets/php/ajax/adresse.php",
                                    {
                                        action: "setAdresse",
                                        user_id: user_id,
                                        adresse_ligne1: ligne1,
                                        adresse_ligne2: ligne2,
                                        adresse_codeP: codeP,
                                        adresse_ville: ville
                                    }, function (data) {
                                        data = JSON.parse(data);
                                        console.log(data);
                                    }
                                );
                            });
                            $("#cancel").click(function () {
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
                            })
                        }
                    });
            }
        });
});
