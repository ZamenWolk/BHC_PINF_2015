//var flagMdp=true;
$(document).ready(function(){
    $("#btn1").hide();
    $("#btn2").hide();
    //$("input[class='form-control']").hide();
    $("#message").delay(10000).fadeOut("slow");
    $("#errMdp").hide();
    $("#succesRequete").hide();
    $("#divMdp1").hide();
    $('#divMdp2').hide();



});


$(function(){
    $.nom=$("#nom").html();
    $.prenom=$("#prenom").html();
    $.entreprise=$("#entreprise").html();
    $.numero=$("#numero").html();
    $.adresse=$("#adresse").html();
    $.ville=$("#ville").html();
    $.code=$("#code").html();
    $.mail=$("#mail").html();
    $.mdp=$("#mdp1").html();

    $('#modif').click(function(){
        $("#btn1").show();
        $("#btn2").show();
        $("#modif").hide();
        // $("input[class='form-control']").show();
        $('h5').each(function(){
            var elemH5=$(this);
            elemH5.replaceWith("<input id='"+$(this).attr("id")+"'  class='champs form-control' type='text' value='"+$(this).html()+"'>");
        });
        // $("input[class='form-control']").prop("disabled",false);
        $("#divMdp1").show("slow");
        $("#divMdp2").show("slow");
    });

    $('#btn2').click(function(){
        $("#nom").val($.nom);
        $("#prenom").val($.prenom);
        $("#entreprise").val($.entreprise);
        $("#numero").val($.numero);
        $("#adresse").val($.adresse);
        $("#ville").val($.ville);
        $("#code").val($.code);
        $("#mail").val($.mail);
        $("#mdp1").val($.mdp);
        $("#mdp2").val($.mdp);
        $("#btn1").hide();
        $("#btn2").hide();
        $("#modif").show();
        // $("input[class='form-control']").prop("disabled",true);
        $("#errMdp").hide();
        $("#divMdp1").hide("slow");
        $('#divMdp2').hide("slow");

    });

    $('#btn1').click(function(){

        if(($("#mdp1").val()!=$("#mdp2").val()))
        {
            $("#errMdp").show();
            $('html,body').animate({scrollTop: $("#errMdp").offset().top}, 'slow'      );
            //flagMdp=false;
        }
        else
        {

            $("#errMdp").hide();
            $.ajax({
                url:'modification.php',
                type:'get',
                data:"nom="+ $.nom+"&prenom="+ $.prenom+"&entreprise="+ $.entreprise+"&numero="+ $.numero+"&adresse="+ $.adresse+"&ville="+ $.ville+"&code="+ $.code+"&mail="+ $.mail+"&mdp="+ $.mdp,
                //dataType:'json',
                success:function(obj){
                    console.log("reussite");
                    //console.log(obj);
                    $.resultat=JSON.parse(obj);
                    console.log("nom:"+$.resultat.nom);
                    console.log("mail:"+$.resultat.mail);
                    console.log("nom="+ $.nom+"&prenom="+ $.prenom+"&entreprise="+ $.entreprise+"&numero="+ $.numero+"&adresse="+ $.adresse+"&ville=");
                    $("#modif").show();
                    $("#btn1").hide();
                    $("#btn2").hide();
                    // $("input[class='form-control']").prop("disabled",true);
                    $("#succesRequete").show();
                    $('html,body').animate({scrollTop: $("#succesRequete").offset().top}, 'slow'      );
                    $("#succesRequete").delay(5000).fadeOut("slow");
                    $("#divMdp1").hide("slow");
                    $('#divMdp2').hide("slow");
                    $('input[class="champs form-control"]').each(function(){
                        var elem=$(this);
                        elem.replaceWith("<h5 id='"+$(this).attr('id')+"'>"+$(this).val()+"</h5>")
                    });

                },
                error:function(resultat, statut, erreur){
                    console.log("erreur");
                }
            });

            console.log("nom:"+ $.nom);
        }
    });
});