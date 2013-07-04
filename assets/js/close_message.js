/* 
 * Basic function to close 'popup' message
 */

function ok_message(){ //remove a message
        $("div.message").click(function(){
            $(this).css("display","none");
        });
}

