<?php
include_once("header.php");
?>

<script src="../assets/js/script_compte.js"></script>

<div class="row">
    <h2 class="page-header">Mes informations</h2>
    <div class="col-md-offset-1 col-md-9 personal-info" id="infoForm">
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
        <button type="button" class="btn btn-default pull-right" id="modifPasse">Modifier mon mot de passe</button>

        <button type="button" class="btn btn-default pull-right" id="validate">Enregistrer les modifications</button>
        <button type="button" class="btn btn-default pull-right" id="cancel">Annuler</button>

    </div>
    <div class="col-md-offset-1 col-md-9 personal-info" id="passeForm">
        <div class="alert alert-danger" role="alert" id="echecNewPasse">
            <i class="fa fa-exclamation-triangle fa-fw"></i>
            <strong>Les mots de passes ne correspondent pas</strong>
        </div>
        <div class="alert alert-danger" role="alert" id="echecOldPasse">
            <i class="fa fa-exclamation-triangle fa-fw"></i>
            <strong>L'ancien mot de passe est faux</strong>
        </div>
        <form class="form-horizontal" role="form">
            <div class="row form-group">
                <label class="col-lg-4 control-label" for="oldPasse">Ancien mot de passe</label>
                <div class="col-lg-8">
                    <input class='form-control' type='password' id="oldPasse">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-lg-4 control-label" for="newPasse">Nouveau mot de passe</label>
                <div class="col-lg-8">
                    <input class='form-control' type='password' id="newPasse">
                </div>
            </div>

            <div class="row form-group">
                <label class="col-lg-4 control-label" for="newPasse2">Comfirmez le mot de passe</label>
                <div class="col-lg-8">
                    <input class='form-control' type='password' id="newPasse2">
                </div>
            </div>
        </form>
        <button type="button" class="btn btn-default pull-right" id="validatePasse">Modifier le mot de passe</button>
        <button type="button" class="btn btn-default pull-right" id="cancelPasse">Annuler</button>
    </div>

</div>

<?php
include_once("footer.php");
?>
