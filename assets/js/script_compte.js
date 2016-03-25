//var flagMdp=true;
$(document).ready(function () {
    $("#validate").hide();
    $("#cancel").hide();
    $("#succesRequete").hide();


    $(document).on("change", "#ins_mail", function () {
        ins_mail = $(this).val();
    });
    $(document).on("change", "#ins_phone", function () {
        ins_tel = $(this).val();
    });
    $(document).on("change", "#ins_nom", function () {
        ins_nom = $(this).val();
    });
    $(document).on("change", "#ins_prenom", function () {
        ins_prenom = $(this).val();
    });
    $(document).on("change", "#ins_adress", function () {
        ins_adress = $(this).val();
    });
    $(document).on("change", "#ins_comp_adress", function () {
        ins_comp_adress = $(this).val();
    });
    $(document).on("change", "#ins_postal", function () {
        ins_postal = $(this).val();
    });
    $(document).on("change", "#ins_ville", function () {
        ins_ville = $(this).val();
    });

    $('#modif').click(function () {
        $("#validate").show();
        $("#cancel").show();
        $("#modif").hide();
        $('h5').each(function () {
            var elemH5 = $(this);
            elemH5.replaceWith("<input id='" + $(this).attr("id") + "'  class='champs form-control' type='text' value='" + $(this).html() + "'>");
        });
    });

    $('#cancel').click(function () {
        $("#modif").show();
        $("#cancel").hide();
        $("#validate").hide();
        $('input').each(function () {
            var input = $(this);
            input.replaceWith("<h5 id=" + $(this).attr("id") + " class='champs form-control'></h5>");
        });
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

});
