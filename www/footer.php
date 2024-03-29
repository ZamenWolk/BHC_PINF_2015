</div>
<div class="push"></div>
</div>

<footer class="footer">
    <ul class="nav nav-pills nav-justified">
        <li><a href="./cgv">C.G.V.</a></li>
        <li><a href="./mentions_legales">Mentions légales</a></li>
        <li><a href="./faq">FAQ</a></li>
    </ul>
</footer>

<div class="modal fade" id="modalPneuPanier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Vous venez d'ajouter à votre panier :</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPasse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Mot de passe oublié</h4>
            </div>
            <div class="modal-body">
                <p>Entrez votre adresse mail, nous vous enverrons votre nouveau mot de passe à cette adresse</p>
                    <label for="retrievePasse" class="sr-only">Adresse mail</label>
                    <input id="retrievePasse" type="email" class="form-control" name="mail"
                           placeholder="Adresse Mail">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-block">Demander un nouveau mot de passe</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Créer un compte</h4>
            </div>
            <form class=" container-fluid" action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ins_mail">Adresse mail</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span>
                            <input type="email"
                                   class="form-control"
                                   id="ins_mail"
                                   name="ins_mail"
                                   placeholder="Entrez votre email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ins_password">Mot de passe</label>
                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="fa fa-lock fa-fw"></i></span>
                            <input type="password"
                                   class="form-control"
                                   id="ins_password"
                                   name="ins_password"
                                   placeholder="Entrez un mot de passe"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="fa fa-lock fa-fw"></i></span>
                            <input type="password"
                                   class="form-control"
                                   id="ins_password2"
                                   name="ins_password2"
                                   placeholder="Confirmez le mot de passe" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ins_nom">Nom</label>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input type="text"
                                   class="form-control"
                                   id="ins_nom"
                                   name="ins_nom"
                                   placeholder="Entrez votre nom" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ins_prenom">Prenom</label>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input type="text"
                                   class="form-control"
                                   id="ins_prenom"
                                   name="ins_prenom"
                                   placeholder="Entrez votre prenom" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ins_adress">Adresse</label>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-home fa-fw"></i></span>
                            <input type="text"
                                   class="form-control"
                                   id="ins_adress"
                                   name="ins_adress"
                                   placeholder="Entrez votre adresse" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-7 col-sm-offset-1">
                            <div class="form-group">
                                <label class="sr-only" for="ins_comp_adress">Complément d'adresse</label>

                                <input type="text"
                                       class="form-control"
                                       id="ins_comp_adress"
                                       name="ins_comp_adress"
                                       placeholder="Complément d'adresse">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-1">
                            <div class="form-group">
                                <label class="sr-only" for="ins_postal">Code postal</label>
                                <input type="text"
                                       class="form-control"
                                       id="ins_postal"
                                       name="ins_postal"
                                       placeholder="Code postal" required>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="sr-only" for="ins_ville">Ville</label>
                                <input type="text"
                                       class="form-control"
                                       id="ins_ville"
                                       name="ins_ville"
                                       placeholder="Ville" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ins_phone">Téléphone</label>

                        <div class="input-group">
                                        <span class="input-group-addon"><i
                                                class="fa fa-phone fa-fw"></i></span>
                            <input type="tel"
                                   class="form-control"
                                   id="ins_phone"
                                   name="ins_phone"
                                   placeholder="Entrez votre numéro de téléphone" required>
                        </div>
                        <br/>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="checkbox2" id="checkbox2" autocomplete="off"/>
                        <div class="btn-group">
                            <label for="checkbox2" class="btn btn-default active">
                                <span class=" fa fa-check fa-fw"></span>
                                <span> </span>
                            </label>
                            <label for="checkbox2" class="btn btn-default">J'accepte les conditions
                                d'utilisations</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="checkbox1" id="checkbox1" autocomplete="off" checked/>
                        <div class="btn-group">
                            <label for="checkbox1" class="btn btn-default active">
                                <span class="fa fa-check fa-fw"></span>
                                <span> </span>
                            </label>
                            <label for="checkbox1" class="btn btn-default">J'accepte de recevoir des offres
                                promotionnelles de JS Pneus</label>
                        </div>
                    </div>
                </div>
                <div style="display:none" id="ins_alert_conditions" class="alert alert-danger" role="alert">Vous devez
                    accepter les conditions d'utilisations.
                </div>
                <div style="display:none" id="ins_alert_succes" class="alert alert-success" role="alert">Bravo, vous
                    vous êtes bien inscris!
                </div>
                <div style="display:none" id="ins_alert_mail" class="alert alert-danger" role="alert">Cet e-mail est
                    déja utilisé.
                </div>
                <div style="display:none" id="ins_alert_miss" class="alert alert-danger" role="alert">
                    Des champs sont manquants.
                </div>
                <div style="display:none" id="ins_alert_pass" class="alert alert-danger" role="alert">
                    Les deux mots de passe que vous avez entré sont différent.
                </div>
                <div class="modal-footer">
                    <button id="ins_submit" type="button" name="action" value="subscribe"
                            class="btn btn-lg btn-block btn-subscribe">
                        Inscription
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
