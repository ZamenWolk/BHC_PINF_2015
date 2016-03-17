<?php
include_once("header.php");
?>

<script src="../assets/js/script_compte.js">


</script>


<div class="row">
    <div class="col-md-offset-1 col-md-11"><h1>Mon compte</h1></div>

</div>
<div class="row">
    <div class="col-md-12">
        <hr>
    </div>
</div>
<div class="row">
  <!-- Colonne de gauche si besoin est -->
 <!-- <div class="col-md-3">
    <div class="text-center">
      <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
      <h6></h6>

      <input type="file" class="form-control">
    </div>
  </div> -->

  <!-- edit form column --><!--TODO: rajouter un petit JQuery pour le supprimer aprés x temps-->
    <div class="col-md-offset-1 col-md-9 personal-info">
        <div id="message" class="alert alert-info alert-dismissable">
            <a class="panel-close close" data-dismiss="alert">×</a>
            <i class="fa fa-coffee"></i>
            Mofidiez vos informations et sauvegardez les avec le bouton en bas de la page
        </div>

        <div class="row">
            <div class="col-md-offset-1 col-md-11"><h3>Mes informations</h3></div>

        </div>


        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label class="col-lg-3 control-label">Nom:</label>
                <div class="col-lg-8">
                    <h5 id="nom" class="titres">Jane</h5>
                    <!-- INSERT PHP HERE  -->

                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Prénom:</label>
                <div class="col-lg-8">
                    <h5 id="prenom" class="titre">Bishop</h5>
                     <!-- INSERT PHP HERE  -->
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Entreprise:</label>
                <div class="col-lg-8">
                    <h5 id="entreprise" class="titre">EntrepriseActuelle</h5>
                    <!-- INSERT PHP HERE  -->
                </div>
            </div>
                <div class="form-group">
                <label class="col-lg-3 control-label">Téléphone:</label>
                <div class="col-lg-8">
                    <h5 id="numero" class="titre">012323232323</h5>
                  <!-- INSERT PHP HERE  -->
                </div>
                </div>
                <div class="form-group">
                <label class="col-lg-3 control-label">Adresse:</label>
                <div class="col-lg-8">
                    <h5 id="adresse" class="titre">Ma Maison</h5>
                  <!-- INSERT PHP HERE  -->
                </div>
                </div>
                <div class="form-group">
                <label class="col-lg-3 control-label">Ville:</label>
                <div class="col-lg-8">
                    <h5 id="ville" class="titre">Ma Maison</h5>
                  <!-- INSERT PHP HERE  -->
                </div>
                </div>
                <div class="form-group">
                <label class="col-lg-3 control-label">Code postal:</label>
                <div class="col-lg-8">
                    <h5 id="code" class="titre">59000</h5>
                 <!-- INSERT PHP HERE  -->
                </div>
                </div>
                <div class="form-group">
                <label class="col-lg-3 control-label">Email:</label>
                <div class="col-lg-8">
                    <h5 id="mail" class="titre">MailActuel@gmail.com</h5>
                  <!-- INSERT PHP HERE  -->
                </div>
                </div>
                <div id="divMdp1" class="form-group">
                <label class="col-md-3 control-label">Mot de passe:</label>
                <div class="col-md-8">
                  <input id="mdp1" class="form-control" type="password" value="11111122333"><!-- INSERT PHP HERE  -->
                </div>
                </div>
                <div id="divMdp2" class="form-group">
                <label class="col-md-3 control-label">Confirmation du mot de passe:</label>
                <div class="col-md-8">
                  <input id="mdp2" class="form-control" type="password" value="11111122333"><!-- INSERT PHP HERE  -->
                </div>
                </div>
                <div class="form-group">
                <label class="col-md-3 control-label"></label>
                <div id="boutons" class="col-md-8">
                  <input id="btn1" type="button"  class="btn btn-primary" value="Confirmer modifications">


                  <span></span>
                  <input id="btn2" type="reset" class="btn btn-default" value="Annuler" >
                    <input id="modif" type="button" class="btn btn-primary" value="Modifier informations"> <br> <br>

                    <div  id="errMdp" class='alert alert-danger' role='alert'> les mots de passe ne correspondent pas </div>
                    <div hidden id="succesRequete" class='alert alert-success' role='alert'> les informations on été modifiées avec succès </div>


                </div>
            </div>
        </form>
    </div>
</div>

