/* 
 * Basic function to close 'popup' message
 */


$(function ok_message(){ //remove a message
        $(this).parent().css("display","none");
});

$(function(){
        $("div.message img").click(function(){
            $(this).parent().css("display","none");
        });
});