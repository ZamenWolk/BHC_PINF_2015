<?php
include_once "secret/credentials.php";
include_once("header.php");
?>
    <div class="container-fluid">
        <h2 class="page-header">Historique des commandes</h2>
        <div class="row">
            <div class="span5">
                <table class="table table-striped table-condensed">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Nombre d'articles</th>
                        <th>Prix total</th>
                        <th>Statut</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><span class="label label-success">Active</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function () {
        $.post(
            "assets/php/ajax/user.php",
            {
                action: "getConnectedUser"
            },
            function (data) {
                data = JSON.parse(data);
                console.log(data);

                if (data["etat"] == "reussite") {

                } else {
                    document.location.href = "./accueil";
                }
            });
    });
</script>
<?php
include_once("footer.php");
?>