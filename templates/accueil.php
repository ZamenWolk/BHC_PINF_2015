<div class="row">
    <div class="col-md-12">
        <h1> Vous êtes à l'accueil</h1>
        <?php include_once ("lib/maLibSQL.pdo.php");
        include_once ("lib/maLibUtils.php");
        $sql =  "SELECT * FROM pneus";
        $res = SQLSelect($sql);
        foreach($res AS $row)/* Permet d'obtenir les différents contenues des pneus */
        {
            print $row['marque'] . "\t";
            print  $row['dimension'] . "\t";
            print $row['stock'] . "\n";
        }
        ?>

    </div>
</div>