/*
 * @author Paul-Yves
 * 
 */

$(function(){  
    $('.annotation').dialog({position: { my: "right top", at: "right top", of: $('html') } });
    $('.annotation.new').dialog("close").dialog( "option", "position", { my: "center", at: "center", of: $('div.newAnnot') } );
    
    $('#newAnnot').click(function(){
        $('.annotation.new').dialog("open");
    });
});

