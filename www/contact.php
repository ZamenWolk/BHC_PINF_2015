<?php
include_once('header.php');
?>
<div class=" well well-lg">
<h1> Contact </h1>
<form action="" method="post">
    <div>
        <label for="nom">Nom :</label></br>
        <input type="text" id="nom" style="width:40%;" />
    </div>
    <div>
        <label for="courriel">Adresse mail :</label></br>
        <input type="email" id="mail" style="width:40%;" />
    </div>
    <div>
        <label for="message">Message :</label></br>
        <textarea style = "resize:none; width:100%; height:200px" id="message"></textarea>
    </div>
    
    <div class="button">
        <button type="submit">Envoyer votre message</button>
    </div>
</form>
</div>
<?php
include_once('footer.php');
?>