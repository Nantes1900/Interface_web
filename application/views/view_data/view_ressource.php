<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 
    <body>
        <h1> Détails de la ressource : <?php echo $ressource->get_titre(); ?> </h1>
        
        <h2> Description </h2>
        <p> <?php echo $ressource->get_description(); ?> </p> 
        
        <?php if ($ressource->get_reference_ressource()!=null){ ?>
            <h2> Référence </h2>
            <p> <?php echo $ressource->get_reference_ressource(); ?> </p> 
        <?php } ?>
            
        <?php if ($typeRessource == 'ressource_texte' && $ressource->get_sous_categorie()!=null){ ?>
            <h2> Sous catégorie </h2>
            <p> <?php echo $ressource->get_sous_categorie(); ?> </p> 
        <?php } ?>    
        
        <?php if ($ressource->get_disponibilite()!=null){ ?>
            <h2> Disponibilité </h2>
            <p> <?php echo $ressource->get_disponibilite(); ?> </p> 
        <?php } ?>
        
        <?php if ($ressource->get_theme_ressource()!=null){ ?>
            <h2> Thème de la ressource </h2>
            <p> <?php echo $ressource->get_theme_ressource(); ?> </p> 
        <?php } ?>
            
        <?php if ($ressource->get_auteurs()!=null){ ?>
            <h2> Auteur </h2>
            <p> <?php echo $ressource->get_auteurs(); ?> </p> 
        <?php } ?>
            
        <?php if ($ressource->get_editeur()!=null){ ?>
            <h2> Editeur </h2>
            <p> <?php echo $ressource->get_editeur(); ?> </p> 
        <?php } ?>    
            
        <?php if ($ressource->get_ville_edition()!=null){ ?>
            <h2> Ville édition </h2>
            <p> <?php echo $ressource->get_ville_edition(); ?> </p> 
        <?php } ?>
            
        <?php if ($ressource->get_date_debut_ressource()!=null){ ?>
            <h2> Date de début de la ressource </h2>
            <p> 
                <?php echo to_date_dmy($ressource->get_date_debut_ressource()); ?>
                <?php if ($ressource->get_date_precision()!=null){
                    echo 'précision : '.$ressource->get_date_precision();
                } ?>
            </p> 
        <?php } ?>   
            
        <?php if ($typeRessource == 'ressource_graphique'){ ?>
            <h2> Couleur </h2>
            <p> <?php  if ($ressource->get_couleur()==TRUE){
                    echo 'couleur';                
                } else {
                    echo 'noir et blanc';
                }?>
            </p> 
        <?php } ?>  
        
        <?php if ($typeRessource == 'ressource_graphique'){ ?>
            <h2> Image </h2>
            <?php if($ressource->get_image()!=null || $ressource->get_legende()!=null){
                    echo img(array('src'=>'assets/images/'.$ressource->get_image())); 
                    echo $ressource->get_legende(); 
                  } 
            ?>
            <?php if($ressource->get_image_link()!=null){ ?>
                    <br/>
                    <a href="<?php echo $ressource->get_image_link(); ?>" target="_blank"> Lien vers l'image </a>
            <?php } ?>
            <br/>
            <?php if($ressource->get_dimension()!=null){
                        echo 'Dimension: '.$ressource->get_dimension().'<br/>';
                  }
                  if($ressource->get_date_prise_vue()!=null){
                        echo 'Date de prise de vue: '.to_date_dmy($ressource->get_date_prise_vue()).'<br/>';
                  }
                  if($ressource->get_localisation()!=null){
                        echo 'Lieu de la prise de vue: '.$ressource->get_localisation().'<br/>';
                  }
                  if($ressource->get_technique()!=null){
                        echo 'Technique utilisée: '.$ressource->get_technique().'<br/>';
                  }
                  if($ressource->get_type_support()!=null){
                        echo 'Support utilisé: '.$ressource->get_type_support().'<br/>';
                  }
            ?>
        <?php } ?>    
            
        <?php if($typeRessource == 'ressource_video'){  ?>
            
            <h2> Video </h2>
            <?php if($ressource->get_video()!=null){ ?>
                    <video src="<?php echo base_url().'assets/video/'.$ressource->get_video(); ?>" controls >
                        Si la vidéo n'apparait pas, essayez avec un autre navigateur
                    </video>
            <?php } ?>
            <?php if($ressource->get_video_link()!=null){ ?>
                    <br/>
                    <a href="<?php echo $ressource->get_video_link(); ?>" target="_blank"> Site hébergeant la vidéo </a>
            <?php } ?>
            <br/>
            <?php if($ressource->get_date_production()!=null){
                        echo 'Date de production: '.  to_date_dmy($ressource->get_date_production()).'<br/>';
                  }
                  if($ressource->get_duree()!=null){
                        echo 'Durée de la vidéo: '.$ressource->get_duree().'<br/>';
                  }
                  if($ressource->get_diffusion()!=null){
                        echo 'Diffusion: '.$ressource->get_diffusion().'<br/>';
                  }
                  if($ressource->get_versionvideo()!=null){
                        echo 'Version de la vidéo: '.$ressource->get_versionvideo().'<br/>';
                  }
                  if($ressource->get_distribution()!=null){
                        echo 'Distribution: '.$ressource->get_distribution().'<br/>';
                  }
                  if($ressource->get_production()!=null){
                        echo 'Production: '.$ressource->get_production().'<br/>';
                  }
            ?>
        <?php } ?>
            
        <?php if ($typeRessource != 'ressource_video' && $ressource->get_pagination()!=null){ ?>
            <h2> Pagination </h2>
            <p> <?php echo $ressource->get_pagination(); ?> </p> 
        <?php } ?>    
            
        <h3> Mots-clés </h3>
        <p> <?php echo $ressource->get_mots_cles(); ?> </p>
        
        <h3> Informations fournies par </h3>
        <p> <?php echo $ressource->get_username(); ?> </p>
        
    </body>
</html>