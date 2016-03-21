<?php
include_once('header.php');
?>


    <form class="form">
        <h1> Contact </h1>
        <a href="./faq">
            <div class="alert alert-info" role="alert">
                <i class="fa fa-info-circle fa-fw"></i>
                <strong>Avant de nous contacter, avez-vous lu notre section FAQ ? La réponse à votre question pourrait déjà s'y
                trouver !</strong>
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
        <button type="button" class="btn btn-block btn-default btn-lg"><i class="fa fa-envelope-o"></i>
            Envoyer votre message
        </button>

    </form>

    <script>

        $(document).ready(function () {
            $("#BoutonEnvoi").click(function () {
                $.post('../assets/php/ajax/mail.php',
                    {
                        action: "mail_contact",
                        from_email: $('#ContactMail').val(),
                        from_name: $('#ContactNom').val(),
                        subject: $('#ContactObj').val(),
                        html: $('#ContactMessage').val(),
                    },
                    function (data) {
                        console.log(data);
                    });

            });
        });
    </script>

<?php
include_once('footer.php');
?>