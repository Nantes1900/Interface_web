/* 
 * Small JS to toogle the confirmation popup
 * when user try to remove something (objet, ressource...)
 */

$(function(){
        $("button.removePopup").click(function(){
            $(this).parent().children("form").children("div.message").css("display","inline");
        });

        $("img.removePopup").click(function(){
            $(this).parent().css("display","none");
        });
});
