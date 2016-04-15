<?php
include_once('header.php');
?>

    <form class="form">
        <h1> Contact </h1>
        <a href="./faq">
            <div class="alert alert-info" role="alert">
                <i class="fa fa-info-circle fa-fw"></i>
                Avant de nous contacter, avez-vous lu notre section FAQ ?
            </div>
        </a>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="nom" class="sr-only">Nom</label>
                    <input type="text" class="form-control" id="nom" placeholder="Nom"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="mail" class="sr-only">Adresse mail</label>
                    <input type="email" class="form-control" id="mail" placeholder="Email"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    <label for="obj" class="sr-only">Objet</label>
                    <input type="text" class="form-control" id="obj" placeholder="Objet"/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="message" class="sr-only">Message</label>
            <textarea id="message" class="form-control" placeholder="Composez votre message ici ..."></textarea>
        </div>


        <button id="BoutonEnvoi" type="button" class="btn btn-block btn-default btn-lg"><i class="fa fa-envelope-o"></i>
            Envoyer votre message
        </button>



        <div style="display:none" id="con_alert_msg_failure" class="alert alert-danger" role="alert">
            Le mail n'a pas été envoyé, veuillez remplir tous les champs.
        </div>
        <div style="display:none" id="con_alert_msg_succes" class="alert alert-success" role="alert">
            Le mail a bien été envoyé. Nous vous répondrons dans les plus bref délais.
        </div>
    </form>


    <script>

        $(document).ready(function () {
            var html;
            var succes = $("#con_alert_msg_succes");
            var failure = $("#con_alert_msg_failure");

            $("#message").change(function(){
                html=this.value;
            });


            $("#BoutonEnvoi").click(function () {
                succes.hide('slow');
                failure.hide('slow');
                $.post('assets/php/ajax/mail.php',
                    {
                        action: "mail_contact",
                        from_email: $('#mail').val(),
                        from_name: $('#nom').val(),
                        subject: $('#obj').val(),
                        html: html
                    },
                    function (data) {

                        data = JSON.parse(data);
                        //console.log(data);

                        if(data.etat == "reussite")
                        {
                            succes.show('slow');
                            failure.hide('slow');
                        }
                        else
                        {
                            succes.hide('slow');
                            failure.show('slow');
                        }
                     });

            });
        });
    </script>

<?php
include_once('footer.php');
?>