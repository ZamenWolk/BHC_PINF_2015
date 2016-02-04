<?php
include('config.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style>
		</style>
        <title>Mon compte</title>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    </head>
    <body>
    	<br>
<div class="container">
    <h1>Mon compte</h1>
  	<hr>
	<div class="row">
      <!-- Colonne de gauche si besoin est -->
     <!-- <div class="col-md-3">
        <div class="text-center">
          <img src="//placehold.it/100" class="avatar img-circle" alt="avatar">
          <h6></h6>
          
          <input type="file" class="form-control">
        </div>
      </div> -->
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i>
          Mofidiez vos informations et sauvegardez les avec le boutons en bas de la page
        </div>
        <h3>Mes informations</h3>
        
        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="col-lg-3 control-label">Nom:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="Jane"><!-- INSERT PHP HERE  -->
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Prénom:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="Bishop"> <!-- INSERT PHP HERE  -->
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Entreprise:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="EntrepriseActuelle"><!-- INSERT PHP HERE  -->
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="MailActuel@gmail.com"><!-- INSERT PHP HERE  -->
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Mot de passe:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" value="11111122333"><!-- INSERT PHP HERE  -->
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirmation du mot de passe:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" value="11111122333"><!-- INSERT PHP HERE  -->
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input type="button" class="btn btn-primary" value="Confirmer modifications">
              <span></span>
              <input type="reset" class="btn btn-default" value="Annuler">
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
<hr>
	</body>
</html>
