<?php
include_once('header.php');
?>


<div class=" well well-lg">
<h1> Contact </h1>
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
        <button>Envoyer votre message</button>
    </div>
</div>
<script>

$(document).ready(function(){
	$("#BoutonEnvoi").click(function(){
        $.post('../assets/php/ajax/mail.php',
        {action:"mail_contact",
		from_email:$('#ContactMail').val(),
		from_name:$('#ContactNom').val(),
		subject:$('#ContactObj').val(),
		html:$('#ContactMessage').val(),
		},
		function(data){
			console.log(data);
		});
		
        });
    });
</script>

<?php
include_once('footer.php');
?>