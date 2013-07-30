/*
 * @author Paul-Yves
 * 
 */

$(function(){  
    $('.annotation').dialog();
    $('.annotation.new').dialog("close").dialog( "option", "position", { my: "center", at: "center", of: $('div.newAnnot') } );
    
    $('#newAnnot').click(function(){
        $('.annotation.new').dialog("open");
    });
});

