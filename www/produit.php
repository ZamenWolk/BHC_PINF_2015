<?php
include_once "../secret/credentials.php";
include_once("header.php");
?>
<a href="./catalogue" type="button" class="btn btn-default"><i class="fa fa-arrow-left"></i> Retour au catalogue</a>
<div class="model_article container-fluid">
    <div class="row heading">
        <div class="col-md-10 col-md-offset-2 item-heading-container pull-right">
            <h1 class="item-heading"></h1>
        </div>
    </div>
    <div class="row item-rest">
        <div class="col-md-3 img-div">
            <img src="" alt="Pas d'image disponible" class="annonce img-responsive"/>
        </div>
        <div class="col-md-6">
            <dl class="dl-horizontal">
                <dt>Catégorie:</dt>
                <dd class="categorie"></dd>
                <dt>Largeur:</dt>
                <dd class="largeur"></dd>
                <dt>Série:</dt>
                <dd class="serie"></dd>
                <dt>Jante:</dt>
                <dd class="jante"></dd>
                <dt>Charge:</dt>
                <dd class="charge"></dd>
                <dt>Vitesse:</dt>
                <dd class="vitesse"></dd>
                <dt>Consommation:</dt>
                <dd class="consommation"></dd>
                <dt>Decibel:</dt>
                <dd class="decibel"></dd>
            </dl>
        </div>
        <div class="col-md-3 add-cart-div">
            <h3 id="price"></h3>
            <label for="qte">Quantité: </label>
            <select class="form-control" id="qte">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option  value="4">4</option>
                <option  value="5">5</option>
                <option  value="6">6</option>
                <option  value="7">7</option>
                <option  value="8">8</option>
                <option  value="9">9</option>
                <option  value="10">10</option>
            </select>
            <button type="button" class="btn btn-default btn-block pull-right shop-btn"><span
                    class="fa fa-shopping-cart"
                    aria-hidden="true"></span> Ajouter au panier
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <h3>A quoi correspondent ces chiffres ?</h3>
    </div>
</div>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">

            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"
               aria-controls="collapseOne">
                <h4 class="panel-title">Largeur</h4>
            </a>

        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                Largeur Nominale de section du pneu en mm.
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">

            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
               aria-expanded="false" aria-controls="collapseTwo">
                <h4 class="panel-title">Série</h4>
            </a>

        </div>
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
                Série du pneu. Rapport Hauteur-Largeur en %.
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingThree">

            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
               aria-expanded="false" aria-controls="collapseThree">
                <h4 class="panel-title">Jante</h4>
            </a>

        </div>
        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">
                Diamètre de la jante (en pouces).
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingFour">

            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour"
               aria-expanded="false" aria-controls="collapseFour">
                <h4 class="panel-title">Charge</h4>
            </a>

        </div>
        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
            <div class="panel-body">
                Indice de charge du pneumatique.
                <div class="row">
                    <div class="col-md-3">
                        <table border="1">
                            <thead>
                            <tr>
                                <th>
                                    Indice
                                </th>
                                <th>
                                    Poids en kg
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    20
                                </td>
                                <td>
                                    80
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    22
                                </td>
                                <td>
                                    85
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    24
                                </td>
                                <td>
                                    85
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    26
                                </td>
                                <td>
                                    90
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    28
                                </td>
                                <td>
                                    100
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    30
                                </td>
                                <td>
                                    106
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    31
                                </td>
                                <td>
                                    109
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    33
                                </td>
                                <td>
                                    115
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    35
                                </td>
                                <td>
                                    121
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    37
                                </td>
                                <td>
                                    128
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    40
                                </td>
                                <td>
                                    136
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    41
                                </td>
                                <td>
                                    145
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    42
                                </td>
                                <td>
                                    150
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    44
                                </td>
                                <td>
                                    160
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    46
                                </td>
                                <td>
                                    170
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    47
                                </td>
                                <td>
                                    175
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    48
                                </td>
                                <td>
                                    180
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    50
                                </td>
                                <td>
                                    190
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    51
                                </td>
                                <td>
                                    195
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    52
                                </td>
                                <td>
                                    200
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    53
                                </td>
                                <td>
                                    206
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    54
                                </td>
                                <td>
                                    212
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table border="1">
                            <thead>
                            <tr>
                                <th>
                                    Indice
                                </th>
                                <th>
                                    Poids en kg
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    55
                                </td>
                                <td>
                                    218
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    58
                                </td>
                                <td>
                                    236
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    59
                                </td>
                                <td>
                                    243
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    60
                                </td>
                                <td>
                                    250
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    61
                                </td>
                                <td>
                                    257
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    62
                                </td>
                                <td>
                                    265
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    63
                                </td>
                                <td>
                                    272
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    64
                                </td>
                                <td>
                                    280
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    65
                                </td>
                                <td>
                                    290
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    66
                                </td>
                                <td>
                                    300
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    67
                                </td>
                                <td>
                                    307
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    68
                                </td>
                                <td>
                                    315
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    69
                                </td>
                                <td>
                                    325
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    70
                                </td>
                                <td>
                                    335
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    71
                                </td>
                                <td>
                                    345
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    72
                                </td>
                                <td>
                                    355
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    73
                                </td>
                                <td>
                                    365
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    74
                                </td>
                                <td>
                                    375
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    75
                                </td>
                                <td>
                                    387
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    76
                                </td>
                                <td>
                                    400
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    77
                                </td>
                                <td>
                                    412
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    78
                                </td>
                                <td>
                                    425
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table border="1">
                            <thead>
                            <tr>
                                <th>
                                    Indice
                                </th>
                                <th>
                                    Poids en kg
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    79
                                </td>
                                <td>
                                    437
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    80
                                </td>
                                <td>
                                    450
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    81
                                </td>
                                <td>
                                    462
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    82
                                </td>
                                <td>
                                    475
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    83
                                </td>
                                <td>
                                    487
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    84
                                </td>
                                <td>
                                    500
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    85
                                </td>
                                <td>
                                    515
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    86
                                </td>
                                <td>
                                    530
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    87
                                </td>
                                <td>
                                    545
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    88
                                </td>
                                <td>
                                    560
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    89
                                </td>
                                <td>
                                    580
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    90
                                </td>
                                <td>
                                    600
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    91
                                </td>
                                <td>
                                    615
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    92
                                </td>
                                <td>
                                    630
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    93
                                </td>
                                <td>
                                    650
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    94
                                </td>
                                <td>
                                    670
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    95
                                </td>
                                <td>
                                    690
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    96
                                </td>
                                <td>
                                    710
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    97
                                </td>
                                <td>
                                    730
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    98
                                </td>
                                <td>
                                    750
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    99
                                </td>
                                <td>
                                    775
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    100
                                </td>
                                <td>
                                    800
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table border="1">
                            <thead>
                            <tr>
                                <th>
                                    Indice
                                </th>
                                <th>
                                    Poids en kg
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    101
                                </td>
                                <td>
                                    825
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    102
                                </td>
                                <td>
                                    850
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    103
                                </td>
                                <td>
                                    875
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    104
                                </td>
                                <td>
                                    900
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    105
                                </td>
                                <td>
                                    925
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    106
                                </td>
                                <td>
                                    950
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    107
                                </td>
                                <td>
                                    975
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    108
                                </td>
                                <td>
                                    1000
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    109
                                </td>
                                <td>
                                    1030
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    110
                                </td>
                                <td>
                                    1060
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    111
                                </td>
                                <td>
                                    1090
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    112
                                </td>
                                <td>
                                    1120
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    113
                                </td>
                                <td>
                                    1150
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    114
                                </td>
                                <td>
                                    1180
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    115
                                </td>
                                <td>
                                    1215
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    116
                                </td>
                                <td>
                                    1250
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    117
                                </td>
                                <td>
                                    1285
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    118
                                </td>
                                <td>
                                    1320
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    119
                                </td>
                                <td>
                                    1360
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    120
                                </td>
                                <td>
                                    1400
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingFive">

            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive"
               aria-expanded="false" aria-controls="collapseFive">
                <h4 class="panel-title">Vitesse</h4>
            </a>

        </div>
        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
            <div class="panel-body">
                Indice de vitesse, indiquant la vitesse maximale autorisée.
                <div class="row">
                    <div class="col-md-3">
                        <table border="1">
                            <thead>
                            <tr>
                                <th>
                                    Indice de vitesse
                                </th>
                                <th>
                                    Vitesse en km/h
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    A1
                                </td>
                                <td>
                                    5
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    A2
                                </td>
                                <td>
                                    10
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    A3
                                </td>
                                <td>
                                    15
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    A4
                                </td>
                                <td>
                                    20
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    A5
                                </td>
                                <td>
                                    25
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    A6
                                </td>
                                <td>
                                    30
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    A7
                                </td>
                                <td>
                                    35
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    A8
                                </td>
                                <td>
                                    40
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    B
                                </td>
                                <td>
                                    50
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    C
                                </td>
                                <td>
                                    60
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table border="1">
                            <thead>
                            <tr>
                                <th>
                                    Indice de vitesse
                                </th>
                                <th>
                                    Vitesse en km/h
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    D
                                </td>
                                <td>
                                    65
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    E
                                </td>
                                <td>
                                    70
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    F
                                </td>
                                <td>
                                    80
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    G
                                </td>
                                <td>
                                    90
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    J
                                </td>
                                <td>
                                    100
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    K
                                </td>
                                <td>
                                    110
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    L
                                </td>
                                <td>
                                    120
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    M
                                </td>
                                <td>
                                    130
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    N
                                </td>
                                <td>
                                    140
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    P
                                </td>
                                <td>
                                    150
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <table border="1">
                            <thead>
                            <tr>
                                <th>
                                    Indice de vitesse
                                </th>
                                <th>
                                    Vitesse en km/h
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    Q
                                </td>
                                <td>
                                    160
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    R
                                </td>
                                <td>
                                    170
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    S
                                </td>
                                <td>
                                    180
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    T
                                </td>
                                <td>
                                    190
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    U
                                </td>
                                <td>
                                    200
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    H
                                </td>
                                <td>
                                    210
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    V
                                </td>
                                <td>
                                    240
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    ZR
                                </td>
                                <td>
                                    >240
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    W
                                </td>
                                <td>
                                    270
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Y
                                </td>
                                <td>
                                    300
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        var url = window.location.href;
        var arr = url.split("=");
        var ref = arr[1];

        $.post(
            "../assets/php/ajax/pneu.php",
            {
                action: "getPneu",
                referencePneu: ref
            },
            function (data) {
                data = JSON.parse(data);
                console.log(data);
                if (data["etat"] == "reussite") {
                    var pneu_marque = data["pneu"]["marque"];
                    var pneu_categorie = data["pneu"]["categorie"];
                    var pneu_largeur = data["pneu"]["largeur"];
                    var pneu_serie = data["pneu"]["serie"];
                    var pneu_jante = data["pneu"]["jante"];
                    var pneu_charge = data["pneu"]["charge"];
                    var pneu_vitesse = data["pneu"]["vitesse"];
                    var pneu_description = data["pneu"]["description"];
                    var pneu_prix = data["prix"];// Attention peut être à changer pour tenir compte du multplicateur
                    var pneu_ref = data["pneu"]["reference"];
                    var pneu_conso = data["pneu"]["consommation"];
                    var pneu_bruit = data["pneu"]["decibel"];
                    var jQ = $(".model_article");
                    var heading = jQ.children(".heading");
                    var list = jQ.children(".list-group-item");
                    var itemRest = jQ.children(".item-rest");
                    var desc = itemRest.children(".col-md-6");
                    var title = heading.children(".item-heading-container");
                    jQ.removeClass("model_article");
                    title.children(".item-heading").html(pneu_description);
                    //console.log(panelBody);
                    var dl_specs = desc.children("dl");
                    var imgDiv = itemRest.children(".img-div");
                    imgDiv.children("img").attr("src","../assets/img/logo/" + data["pneu"]["marque"] +".png");
                    dl_specs.children(".largeur").html(pneu_largeur);
                    dl_specs.children(".categorie").html(pneu_categorie);
                    dl_specs.children(".serie").html(pneu_serie);
                    dl_specs.children(".jante").html(pneu_jante);
                    dl_specs.children(".charge").html(pneu_charge);
                    dl_specs.children(".vitesse").html(pneu_vitesse);
                    dl_specs.children(".consommation").html(pneu_conso);
                    dl_specs.children(".decibel").html(pneu_bruit);
                    var priceDiv = itemRest.children(".add-cart-div");
                    priceDiv.children("#price").html("Prix : " + pneu_prix + " € ");

                    $(document).on("click",".shop-btn", function(e){

                        /*On récupère le div du pneu */
                        var qtt = $("#qte option:selected").val();
                        console.log(qtt);
                        $.post("../assets/php/ajax/panier.php",{action :"ajouterArticle", referencePneu: pneu_ref, quantite:qtt}, function(data){
                        data = JSON.parse(data);
                        console.log(data);

                        /* On ajout le div du pneu au modal */
                        var modal = $('#modalPneuPanier');
                        var img = $(".img-div");
                        var pneu = $(".item-heading");
                        var modalDialog = modal.children(".modal-dialog");
                        var contentModal = modalDialog.children(".modal-content");

                        var bodyModal = contentModal.children(".modal-body");
                        bodyModal.children(".row").html("<div class='col-md-3'> "+img.html()+"</div><div class='col-md-6'><h4>"+pneu.html()+"</h4></div><div class='col-md-3'><h4>Quantité :"+qtt+"</h4> ");
                        modal.modal('show');
                    });

                    });
                }
            });

    });
</script>
<?php
include_once("footer.php");
?>
