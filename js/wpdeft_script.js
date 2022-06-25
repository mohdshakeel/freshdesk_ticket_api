jQuery(function($){

    
    $('div[data-id="1615299419652"] input').live('click',function(){
 
        $.ajax({
            url : wpdeft_loadmore_params.ajaxurl, // AJAX handler
            data : {
                'action': 'freshdesk', // the parameter for admin-ajax.php
                'id' : jQuery(this).data('val')
            },
            type : 'POST',
            beforeSend : function ( xhr ) {
                $('#wpdeft_loadmore').text('Loading...'); // some type of preloader
            },
            success : function( response ){
                console.log(response);
        });
        return false; 
    });
 
   
 
});