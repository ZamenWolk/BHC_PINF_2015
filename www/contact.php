<?php
include_once('header.php');

?>


<div class=" well well-lg">
<h1> Contact </h1>
<form action="" method="post">
<div>
        <label id = "ContactObj" for="nom">Objet :</label></br>
        <input type="text" id="obj" style="width:40%;" />
    </div>
    <div>
        <label id = "ContactNom" for="nom">Nom :</label></br>
        <input type="text" id="nom" style="width:40%;" />
    </div>
    <div>
        <label id = "ContactMail" for="courriel">Adresse mail :</label></br>
        <input type="email" id="mail" style="width:40%;" />
    </div>
    <div>
        <label id = "ContactMessage" for="message">Message :</label></br>
        <textarea style = "resize:none; width:100%; height:200px" id="message"></textarea>
    </div>
    
    <div id="BoutonEnvoi" class="button">
        <button type="submit">Envoyer votre message</button>
    </div>
</form>
</div>
<script>
$('#BoutonEnvoi').click(function(){
	$.ajax({
	type: “POST”,
	url: “send_mail.php”,
	data: {
    ‘message’: {
      ‘from_email’: martin.canivez@gmail.com’,
      ‘to’: [
          {
            ‘email’: ‘$('#ContactMail').val();’,
            ‘name’: ‘$('#ContactNom').val()’,
            ‘type’: ‘to’
          },
        ],
      ‘autotext’: ‘true’,
      ‘subject’: ‘$('#ContactObj').val();’,
      ‘html’: ‘$('#ContactMessage').val();’
    }
  }
 }).done(function(response) {
   console.log(response);
 });
</script>
<?php
include_once('footer.php');
?>