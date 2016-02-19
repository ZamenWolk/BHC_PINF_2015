<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <h3 class="text-center">Identifiez-vous</h3>
        <form class="form-horizontal container-fluid" action="interpretation.php" method="post"><!-- TODO : Rajouter la page ou on traitera l'information -->
            <div class="form-group">
                <label for="conn_mail">Adresse mail</label>

                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input type="email"
                           class="form-control"
                           id="conn_mail"
                           name="conn_mail"
                           placeholder="Entrez votre email">
                </div>
            </div>

            <br/>

            <div class="form-group">
                <label for="conn_password">Mot de passe</label>

                <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-lock"></i></span>
                    <input type="password"
                           class="form-control"
                           id="conn_password"
                           name="conn_password"
                           placeholder="Entrez un mot de passe">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" name="action" value="connection"
                        class="btn btn-success btn-lg btn-block">Identifiez-vous</button>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <a href="?url=inscription">Pas encore inscrit ?</a>
    </div>
</div>

