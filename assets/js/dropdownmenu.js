//these functions are used to generate a drop down menu 
//for navigation class ul elements
$(function() { //initiate the dropdown menu at a hidden position
    $('ul.navigation li ul li').finish().slideUp('slow').finish();
});
        
$(function() {
    $('ul.navigation li').mouseenter(function() {
        $('ul.navigation li:hover ul li').finish().slideDown('slow');
    });
});

$(function() {
    $('ul.navigation li ul').mouseleave(function() {
        $('ul.navigation li:hover ul li').finish().slideUp('slow');
    });
});

$(function() {
    $('ul.navigation').mouseleave(function() {
        $('ul.navigation li ul li').finish().slideUp('slow');
    });
});
        
    