//will move the cat when mouse over it
$(function() {
    var startTime = new Date().getTime();
    var elapsedTime = 0;
    // Dimensions de la fenêtre
    var largeur = ($(window).width()) - 349;
    var hauteur = ($(window).height()) - 250;

    $("#lolcat").mousemove(function annoyingMove() {
        var x = Math.floor(Math.random() * largeur);
        var y = Math.floor(Math.random() * hauteur);
        $('#lolcat').animate({
            left: x,
            top: y
        }, 150);
    });

    $("#lolcat").click(function() {
        elapsedTime = new Date().getTime() - startTime;
        startTime = new Date().getTime();
        alert('Félicitation, vous avez mis environ ' + Math.floor(elapsedTime / 1000) + ' secondes pour toucher le chat!');
    });
});