</div>
<nav class="navbar navbar-default navbar-static-bottom" id="navFooter">
    <div class="container-fluid">
        <div class="collapse navbar-collapse">
            <ul class="nav nav-pills nav-justified">
                <li><a href="./cgv">C.G.V.</a></li>
                <li><a href="./mentions_legales">Mentions légales</a></li>
                <li><a href="#">Protection des données</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
        </div>
    </div>
</nav>

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
                                   placeholder="Entrez votre email">
                        </div>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label for="ins_password">Mot de passe</label>
                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="fa fa-lock fa-fw"></i></span>
                            <input type="password"
                                   class="form-control"
                                   id="ins_password"
                                   name="ins_password"
                                   placeholder="Entrez un mot de passe">
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
                                   placeholder="Confirmez le mot de passe">
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
                                   placeholder="Entrez votre nom">
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
                                   placeholder="Entrez votre prenom">
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
                                   placeholder="Entrez votre adresse">
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
                                       placeholder="Code postal">
                            </div>
                        </div>

                        <div class="col-sm-7 col-sm-offset-1">
                            <div class="form-group">
                                <label class="sr-only" for="ins_ville">Ville</label>
                                <input type="text"
                                       class="form-control"
                                       id="ins_ville"
                                       name="ins_ville"
                                       placeholder="Ville">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ins_phone">Téléphone</label>

                        <div class="input-group">
                                        <span class="input-group-addon"><i
                                                class="fa fa-phone fa-fw"></i></span>
                            <input type="text"
                                   class="form-control"
                                   id="ins_phone"
                                   name="ins_phone"
                                   placeholder="Entrez votre numéro de téléphone">
                        </div>
                        <br/>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="checkbox2" id="checkbox2" autocomplete="off" />
                        <div class="btn-group">
                            <label for="checkbox2" class="btn btn-warning">
                                <span class=" fa fa-check"></span>
                                <span> </span>
                            </label>
                            <label for="checkbox2" class="btn btn-default active">
                                J'accepte les conditions d'utilisations
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="checkbox1" id="checkbox1" autocomplete="off" />
                        <div class="btn-group">
                            <label for="checkbox1" class="btn btn-warning">
                                <span class="fa fa-check"></span>
                                <span> </span>
                            </label>
                            <label for="checkbox1" class="btn btn-default active">
                                J'accepte de recevoir des offres promotionnelles de JS Pneus
                            </label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" name="action" value="subscribe"
                            class="btn btn-subscribe btn-lg btn-block">
                        Inscription
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
