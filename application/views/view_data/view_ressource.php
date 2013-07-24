
        <h1><?php echo $this->lang->line('common_view_detail_ress').$ressource->get_titre(); ?> </h1>
        
        <h2> <?php echo $this->lang->line('common_ress_description'); ?> </h2>
        <p> <?php echo $ressource->get_description(); ?> </p> 
        
        <?php if ($ressource->get_reference_ressource()!=null){ ?>
            <h2> <?php echo $this->lang->line('common_ress_reference'); ?> </h2>
            <p> <?php echo $ressource->get_reference_ressource(); ?> </p> 
        <?php } ?>
            
        <?php if ($typeRessource == 'ressource_texte' && $ressource->get_sous_categorie()!=null){ ?>
            <h2> <?php echo $this->lang->line('common_ress_subcategory'); ?> </h2>
            <p> <?php echo $ressource->get_sous_categorie(); ?> </p> 
        <?php } ?>    
        
        <?php if ($ressource->get_disponibilite()!=null){ ?>
            <h2> <?php echo $this->lang->line('common_ress_disponibilite'); ?> </h2>
            <p> <?php echo $ressource->get_disponibilite(); ?> </p> 
        <?php } ?>
        
        <?php if ($ressource->get_theme_ressource()!=null){ ?>
            <h2> <?php echo $this->lang->line('common_ress_theme_ressource'); ?> </h2>
            <p> <?php echo $ressource->get_theme_ressource(); ?> </p> 
        <?php } ?>
            
        <?php if ($ressource->get_auteurs()!=null){ ?>
            <h2> <?php echo $this->lang->line('common_ress_author'); ?> </h2>
            <p> <?php echo $ressource->get_auteurs(); ?> </p> 
        <?php } ?>
            
        <?php if ($ressource->get_editeur()!=null){ ?>
            <h2> <?php echo $this->lang->line('common_ress_editor'); ?> </h2>
            <p> <?php echo $ressource->get_editeur(); ?> </p> 
        <?php } ?>    
            
        <?php if ($ressource->get_ville_edition()!=null){ ?>
            <h2> <?php echo $this->lang->line('common_ress_edit_town'); ?> </h2>
            <p> <?php echo $ressource->get_ville_edition(); ?> </p> 
        <?php } ?>
            
        <?php if ($ressource->get_date_debut_ressource()!=null){ ?>
            <h2> <?php echo $this->lang->line('common_ress_begin_date'); ?> </h2>
            <p> 
                <?php echo to_date_dmy($ressource->get_date_debut_ressource()); ?>
                <?php if ($ressource->get_date_precision()!=null){
                    echo $this->lang->line('common_ress_precision').$ressource->get_date_precision();
                } ?>
            </p> 
        <?php } ?>   
            
        <?php if ($typeRessource == 'ressource_graphique'){ ?>
            <h2> <?php echo $this->lang->line('common_ress_color'); ?> </h2>
            <p> <?php  if ($ressource->get_couleur()==TRUE){
                    echo $this->lang->line('common_ress_color');                
                } else {
                    echo $this->lang->line('common_ress_color_BW');
                }?>
            </p> 
        <?php } ?>  
        
        <?php if ($typeRessource == 'ressource_graphique'){ ?>
            <h2> <?php echo $this->lang->line('common_ress_img_title'); ?> </h2>
            <?php if($ressource->get_image()!=null || $ressource->get_legende()!=null){
                    echo img(array('src'=>'assets/images/'.$ressource->get_image())); 
                    echo $ressource->get_legende(); 
                  } 
            ?>
            <?php if($ressource->get_image_link()!=null){ ?>
                    <br/>
                    <a href="<?php echo $ressource->get_image_link(); ?>" target="_blank"> 
                        <?php echo $this->lang->line('common_ress_link_to_img'); ?> 
                    </a>
            <?php } ?>
            <br/>
            <?php if($ressource->get_dimension()!=null){
                        echo $this->lang->line('common_ress_size').': '.$ressource->get_dimension().'<br/>';
                  }
                  if($ressource->get_date_prise_vue()!=null){
                        echo $this->lang->line('date_shot').': '.to_date_dmy($ressource->get_date_prise_vue()).'<br/>';
                  }
                  if($ressource->get_localisation()!=null){
                        echo $this->lang->line('common_ress_shot_place').': '.$ressource->get_localisation().'<br/>';
                  }
                  if($ressource->get_technique()!=null){
                        echo $this->lang->line('common_ress_tec_used').': '.$ressource->get_technique().'<br/>';
                  }
                  if($ressource->get_type_support()!=null){
                        echo $this->lang->line('common_ress_media').': '.$ressource->get_type_support().'<br/>';
                  }
            ?>
        <?php } ?>    
            
        <?php if($typeRessource == 'ressource_video'){  ?>
            
            <h2> <?php echo $this->lang->line('common_ress_vid_title'); ?> </h2>
            <?php if($ressource->get_video()!=null){ ?>
                    <video src="<?php echo base_url().'assets/video/'.$ressource->get_video(); ?>" controls >
                        <?php echo $this->lang->line('common_view_video_alt'); ?>
                    </video>
            <?php } ?>
            <?php if($ressource->get_video_link()!=null){ ?>
                    <br/>
                    <a href="<?php echo $ressource->get_video_link(); ?>" target="_blank"> 
                        <?php echo $this->lang->line('common_ress_vid_url'); ?>
                    </a>
            <?php } ?>
            <br/>
            <?php if($ressource->get_date_production()!=null){
                        echo $this->lang->line('date_prod').': '.to_date_dmy($ressource->get_date_production()).'<br/>';
                  }
                  if($ressource->get_duree()!=null){
                        echo $this->lang->line('common_ress_length').': '.$ressource->get_duree().'<br/>';
                  }
                  if($ressource->get_diffusion()!=null){
                        echo $this->lang->line('common_ress_broadcast').': '.$ressource->get_diffusion().'<br/>';
                  }
                  if($ressource->get_versionvideo()!=null){
                        echo $this->lang->line('common_ress_version').': '.$ressource->get_versionvideo().'<br/>';
                  }
                  if($ressource->get_distribution()!=null){
                        echo $this->lang->line('common_ress_distrib').': '.$ressource->get_distribution().'<br/>';
                  }
                  if($ressource->get_production()!=null){
                        echo $this->lang->line('common_ress_prod').': '.$ressource->get_production().'<br/>';
                  }
            ?>
        <?php } ?>
            
        <?php if ($typeRessource != 'ressource_video' && $ressource->get_pagination() > 0){ ?>
            <h2> <?php echo $this->lang->line('common_ress_pagination'); ?> </h2>
            <p> <?php echo $ressource->get_pagination(); ?> </p> 
        <?php } ?>    
            
        <h3> <?php echo $this->lang->line('common_ress_keywords'); ?> </h3>
        <p> <?php echo $ressource->get_mots_cles(); ?> </p>
        
        <h3> <?php echo $this->lang->line('common_view_author'); ?> </h3>
        <p> <?php echo $ressource->get_username(); ?> </p>
        
        <?php if($this->session->userdata('user_level') >= 5){ ?>
                <?php echo form_open('moderation/modify_ressource/index/'.$typeRessource) ?>
                            <input type="hidden" name="ressource_id" value="<?php if($typeRessource=='ressource_texte'){
                                                                                    echo $ressource->get_ressource_textuelle_id();
                                                                                  } else {
                                                                                    $getMethod='get_'.$typeRessource.'_id';
                                                                                    echo $ressource->$getMethod(); 
                                                                                  } ?>" />
                            <input type="submit" value="<?php echo $this->lang->line('common_view_modify_ress');?>" />
                </form>
        <?php } ?>
        

