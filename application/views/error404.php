<html>
    <head>
        <title>Projet Nantes 1900 - Rework</title>
   	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    	<meta name="robots" content="index,follow"/>
        <meta name="keywords" content="château_des_ducs_de_bretagne, nantes, 1900, projet, maquette, port, chateau, numerisation, exposition, graphisme, conferences, publicitaire, " />
	<meta name="description" content="Site officiel. A travers la maquette du port de Nantes découvrez le projet Nantes 1900" />
	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo css_url('style'); ?>" />
	<div class=banniere></div>
	<p><?php echo anchor('accueil', 'Revenir à la page d&rsquo;accueil'); ?></p>
    </head>
    <body>
        <h1> Error 404 : page not found ! </h1>
        <p>If you are lost, you can always click on the cat...</p>
        <?php echo img(array('src'=>'assets/utils/lolcat_404.jpeg', 'id'=>'lolcat', 
                        'style'=>'position: fixed; left: 25%; cursor:hand; cursor:pointer;')); ?>
        
        
        
    <script src="<?php echo base_url();?>assets/js/jquery.js"></script>    
    <script>
        //will move the cat when mouse over it
        $(function() {
            var startTime = new Date().getTime();  
            var elapsedTime = 0;  
            // Dimensions de la fenêtre
            var largeur = ($(window).width()) - 349;
            var hauteur = ($(window).height());
            
            $("#lolcat").mousemove(function annoyingMove() {
                var x = Math.floor(Math.random()*largeur);
                var y = Math.floor(Math.random()*hauteur);
                $('#lolcat').animate({
                    left : x,
                    top : y
                }, 100);
            });
            
            $("#lolcat").click(function(){
                elapsedTime = new Date().getTime() - startTime;  
                startTime = new Date().getTime();  
                alert('Félicitation, vous avez mis environ '+Math.floor(elapsedTime/1000)+' secondes pour toucher le chat!');
            });
        });
    </script>
    </body>
</html>
