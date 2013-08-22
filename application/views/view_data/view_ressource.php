
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
        
        <?php if($typeRessource=='ressource_texte'){
                  $ressource_id = $ressource->get_ressource_textuelle_id();
              } else {
                  $getMethod='get_'.$typeRessource.'_id';
                  $ressource_id = $ressource->$getMethod(); 
              } ?>
        
        
        <?php if($this->session->userdata('user_level') >= 5){ ?>
                <?php echo form_open('moderation/modify_ressource/index/'.$typeRessource) ?>
                            <input type="hidden" name="ressource_id" value="<?php echo $ressource_id?>" />
                            <input type="submit" value="<?php echo $this->lang->line('common_view_modify_ress');?>" />
                </form>
        <?php } ?>
                
        <?php if($this->session->userdata('user_level') >= 4){ ?>
                <?php echo form_open('view_data/select_data/select_objet/add_doc') ?>
                            <input type="hidden" name="ressource_id" value="<?php echo $ressource_id?>" />
                            <input type="hidden" name="typeRessource" value="<?php echo $typeRessource; ?>">
                            <input type="submit" value="<?php echo $this->lang->line('common_list_link_ress'); ?>" />
                </form>
        <?php } ?>
        
<!--    printing the annotations            -->
        <?php if (isset($annotationList)){ 
                    foreach ($annotationList as $annotations){ ?>
                        <div class="annotation" title="<?php echo $annotations['father']->get_titre(); ?>">
                            <?php echo '<b>'.$annotations['father']->get_username().
                                        '</b>: '.$annotations['father']->get_texte(); ?>
                            <div class="annotSeparator"></div>
                            <?php foreach($annotations['children'] as $answer){ ?>
                                <?php echo '<b>'.$answer->get_username().
                                        '</b>: '.$answer->get_texte(); 
                                        if($this->session->userdata('username')==$answer->get_username()){
                                            echo form_open('data_center/ajout_annotation/index/delete');?>
                                            <input type="hidden" name="type_target" value="<?php echo $typeRessource; ?>" />
                                            <input type="hidden" name="target_id" value="<?php echo $ressource_id; ?>" />
                                            <input type="hidden" name="annot_id" value="<?php echo $answer->get_annotation_id(); ?>" />
                                            <button type="submit" class="invisible" title="<?php echo $this->lang->line('common_annot_delete_com');?>"> 
                                                   <?php echo img(array('src'=>'assets/utils/delete.png','alt'=>'delete',
                                                        'width'=>'50%')); ?>
                                           </button>
                                        <?php echo form_close();
                                         } ?>
                                <div class="annotSeparator"></div>
                            <?php } 
                            echo form_open('data_center/ajout_annotation/index/answer')?>
                                <textarea name="texte" rows="4" cols="33"></textarea>
                                <input type="hidden" name="type_target" value="<?php echo $typeRessource; ?>" />
                                <input type="hidden" name="target_id" value="<?php echo $ressource_id; ?>" />
                                <input type="hidden" name="parent_id" value="<?php echo $annotations['father']->get_annotation_id(); ?>" />
                                <input type="submit" value="<?php echo $this->lang->line('common_annot_answer');?>" />
                            <?php echo form_close() ?>
                                <?php if($this->session->userdata('username')==$annotations['father']->get_username()
                                         || $this->session->userdata('user_level')>=5){
                                          echo form_open('data_center/ajout_annotation/index/delete');?>
                                             <input type="hidden" name="type_target" value="<?php echo $typeRessource; ?>" />
                                             <input type="hidden" name="target_id" value="<?php echo $ressource_id; ?>" />
                                             <input type="hidden" name="annot_id" 
                                                   value="<?php echo $annotations['father']->get_annotation_id(); ?>" />
                                             <div class="message" style="left:15%; top:40%; display:none">
                                                 <p><?php echo $this->lang->line('common_annot_delete_warning');?></p>
                                                <button type="submit" > <?php echo $this->lang->line('common_annot_delete');?> </button>
                                                 <button type="reset" class="closePopup"><?php echo $this->lang->line('common_cancel'); ?></button>
                                                 <?php echo img(array('src'=>'assets/utils/close.png','alt'=>'fermer', 
                                                         'class'=>'removePopup')); ?>
                                             </div>
                                <?php    echo form_close(); ?>
                                             <button class="removePopup invisible" title="<?php echo $this->lang->line('common_annot_delete');?>" style="margin-left:90%;"> 
                                                      <?php echo img(array('src'=>'assets/utils/delete.png','alt'=>'delete')); ?>
                                             </button>
                                <?php      } ?>
                        </div>
        <?php        }
            }?>
           
<!--new annotation form-->
        <?php if ($this->session->userdata('user_level') >= 4){ ?>
            <button id="newAnnot"><?php echo $this->lang->line('common_new_annot');?></button>
            <div class="newAnnot"></div>
            <div class="annotation new" title="<?php echo $this->lang->line('common_new_annot');?>">
                <?php echo $this->lang->line('common_new_annot_instruction');?>
                <div class="annotSeparator"></div>
                <?php echo form_open('data_center/ajout_annotation/index/new') ?>
                    <input type="text" name="titre" placeholder="Titre annotation"/>
                    <textarea name="texte"></textarea>
                    <input type="hidden" name="type_target" value="<?php echo $typeRessource; ?>" />
                    <input type="hidden" name="target_id" value="<?php echo $ressource_id; ?>" />
                    <input type="submit" value="<?php echo $this->lang->line('common_new_annot_create');?>" />
                <?php echo form_close()?>
            </div>
        <?php } ?>
