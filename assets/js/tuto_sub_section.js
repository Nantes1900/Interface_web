/* 
 * Simple js file managing the toggle of sub section
 * in the tutorial section
 */

$(function() { //initiate the dropdown menu at a hidden position
    $('div.subSection div.subText').finish().slideUp().finish();
});

$(function() {
    $('div.subSection h3').click(function() {
        $(this).parent().children('div.subText').finish().slideToggle('slow');
    });
});
