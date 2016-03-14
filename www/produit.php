<?php
include_once "../secret/credentials.php";
include_once("header.php");
?>


<div class="row">

</div>

<script>
    $(document).ready(function(){
        var ref = <?php echo $_GET["ref"];?>;
        console.log(ref);

        $.post(
            "../assets/php/ajax/recherche.php",
            {
                action: "chargementRef",
                ref: ref
            },
            function(data){
                data = JSON.parse(data);
                console.log(data);
            });
    });
</script>
<?php
include_once("footer.php");
?>
