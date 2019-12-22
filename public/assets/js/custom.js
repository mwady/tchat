
(function ($) {
    "use strict";

    $('body').off('click', '.liUser');
    $('body').on('click', '.liUser', function(){
        var val = $(this).data('id');
        $.ajax({
            url: "conversation",
            data: "id="+val,
            success: function(result){
                $("#contentChat").html(result);
            }
        });
    });

    $('body').off('submit', '.conversationForm');
    $('body').on('submit', '.conversationForm', function(e){

        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: "add_message",
            data: data,
            success: function(result){

                $("#contentChat").load("conversation?id="+result);

            }
        });
        
    });

    setInterval(function(){
        $.ajax({
            url: "live_users",
            success: function(result){
                $("#contacts").html(result);
            }
        });
    },1000);
    
    

})(jQuery);