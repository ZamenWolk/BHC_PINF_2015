var clic=0;
$(function() {
    $('#recherche').click(function(){
            if(clic==0){
                $(this).val("");
                $(this).css("color","black");
                clic=1;
            }
        }
    );

});