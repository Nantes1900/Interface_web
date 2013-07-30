

        <h1> <?php echo $this->lang->line('common_view_detail_obj').$objet->get_nom_objet(); ?> </h1>
        
        <h2> <?php echo $this->lang->line('common_obj_resume');?> </h2>
        <p> <?php echo $objet->get_resume(); ?> </p>
        
        <h2> <?php echo $this->lang->line('common_obj_description');?> </h2>
        <p> <?php echo $objet->get_description(); ?> </p> 
        
        <h2> <?php echo $this->lang->line('common_obj_historique');?> </h2>
        <p> <?php echo $objet->get_historique(); ?> </p>
        
        <h3> <?php echo $this->lang->line('common_obj_adresse_postale');?> </h3>
        <p> <?php echo $objet->get_adresse_postale(); ?> </p>
        
        <h3> <?php echo $this->lang->line('common_obj_mots_cles');?> </h3>
        <p> <?php echo $objet->get_mots_cles(); ?> </p>
        
        <h3> <?php echo $this->lang->line('common_view_author');?> </h3>
        <p> <?php echo $objet->get_username(); ?> </p>
        
        
        <?php if($objet->get_geom()!=null){ ?>
            <?php echo form_open('view_data/select_data/index/carte') ?>
                <?php $latlng = $objet->get_geom(); ?>
                <input type="hidden" name="longitude" value="<?php echo $latlng['longitude']; ?>" />
                <input type="hidden" name="latitude" value="<?php echo $latlng['latitude']; ?>" />
                <input type="submit" value="<?php echo $this->lang->line('common_view_see_on_map');?>" />
            </form>
        <?php } ?>
        
        
        <?php if($this->session->userdata('user_level') >= 5){ ?>
                <?php echo form_open('moderation/modify_objet/index/modify') ?>
                            <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                            <input type="submit" value="<?php echo $this->lang->line('common_view_modify_obj');?>" />
                </form>
        <?php } ?>
        <?php echo form_open('data_center/ajout_ressource/add_on_the_fly')?>
            <p>
                <?php echo $this->lang->line('common_view_add_ress');?>
                <select name="typeFormulaire">
                       <option value="formulaire_texte"> <?php echo $this->lang->line('common_ressource_txt');?> </option>
                       <option value="formulaire_image"> <?php echo $this->lang->line('common_ressource_img');?> </option>
                       <option value="formulaire_video"> <?php echo $this->lang->line('common_ressource_vid');?> </option>
                </select>
                <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                <input type="submit" value="<?php echo $this->lang->line('common_view_do_add_ress');?>" />
            </p>
        </form>
        
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
                                            <input type="hidden" name="type_target" value="objet" />
                                            <input type="hidden" name="target_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                            <input type="hidden" name="annot_id" value="<?php echo $answer->get_annotation_id(); ?>" />
                                            <button type="submit" class="invisible" title="Supprimer ce commentaire"> 
                                                   <?php echo img(array('src'=>'assets/utils/delete.png','alt'=>'delete',
                                                        'width'=>'50%')); ?>
                                           </button>
                                        <?php echo form_close();
                                         } ?>
                                <div class="annotSeparator"></div>
                            <?php } 
                            echo form_open('data_center/ajout_annotation/index/answer')?>
                                <textarea name="texte" rows="4" cols="33"></textarea>
                                <input type="hidden" name="type_target" value="objet" />
                                <input type="hidden" name="target_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                <input type="hidden" name="parent_id" value="<?php echo $annotations['father']->get_annotation_id(); ?>" />
                                <input type="submit" value="Répondre" />
                            <?php echo form_close() ?>
                                <?php if($this->session->userdata('username')==$annotations['father']->get_username()
                                         || $this->session->userdata('user_level')>=5){
                                          echo form_open('data_center/ajout_annotation/index/delete');?>
                                             <input type="hidden" name="type_target" value="objet" />
                                             <input type="hidden" name="target_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                             <input type="hidden" name="annot_id" 
                                                   value="<?php echo $annotations['father']->get_annotation_id(); ?>" />
                                             <div class="message" style="left:15%; top:40%; display:none">
                                                 <p>Etes vous certain de vouloir supprimer l'annotation entière?</p>
                                                <button type="submit" > Supprimer l'annotation </button>
                                                 <button type="reset" class="closePopup"><?php echo $this->lang->line('common_cancel'); ?></button>
                                                 <?php echo img(array('src'=>'assets/utils/close.png','alt'=>'fermer','width'=>'4%', 
                                                         'class'=>'removePopup')); ?>
                                             </div>
                                <?php    echo form_close(); ?>
                                             <button class="removePopup invisible" title="Supprimer cette annotation"> 
                                                      <?php echo img(array('src'=>'assets/utils/delete.png','alt'=>'delete',
                                                           'width'=>'50%')); ?>
                                             </button>
                                <?php      } ?>
                        </div>
        <?php        }
            }?>
           
        <?php if ($this->session->userdata('user_level') >= 4){ ?>
            <button id="newAnnot">Nouvelle annotation</button>
            <div class="newAnnot"></div>
            <div class="annotation new" title="Nouvelle annotation">
                Entrez ici votre nouvelle annotation
                <div class="annotSeparator"></div>
                <?php echo form_open('data_center/ajout_annotation/index/new') ?>
                    <input type="text" name="titre" placeholder="Titre annotation"/>
                    <textarea name="texte"></textarea>
                    <input type="hidden" name="type_target" value="objet" />
                    <input type="hidden" name="target_id" value="<?php echo $objet->get_objet_id(); ?>" />
                    <input type="submit" value="Créer" />
                <?php echo form_close()?>
            </div>
        <?php } ?>