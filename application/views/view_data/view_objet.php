<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 
    <body>
        <h1>Détails de l'objet : <?php echo $objet->get_nom_objet(); ?> afaze aaz ar zr qrr  arzerzer azr arerrzr</h1>
        
        <h2> Résumé </h2>
        <p> <?php echo $objet->get_resume(); ?> </p>
        
        <h2> Description </h2>
        <p> <?php echo $objet->get_description(); ?> </p>
        
        <h2> Historique </h2>
        <p> <?php echo $objet->get_historique(); ?> </p>
        
        <h3> Adresse postale </h3>
        <p> <?php echo $objet->get_adresse_postale(); ?> </p>
        
        <h3> Mots-clés </h3>
        <p> <?php echo $objet->get_mots_cles(); ?> </p>
        
        
    </body>
</html>