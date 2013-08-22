
    <h1>
        <?php echo $this->lang->line('common_add_ress_vid_form'); ?>
        <?php if(isset($linkedObjet)){
                echo $this->lang->line('common_add_ress_linked').$linkedObjet->get_nom_objet();
              } ?>
    </h1>
    
   
    <div style="color : red;"><?php echo $error;?></div>    
    
    <?php if(!isset($linkedObjet)){
                    echo form_open_multipart('data_center/ajout_ressource/formulaire_video');
              }else{
                    echo form_open_multipart('data_center/ajout_ressource/formulaire_video/'.$linkedObjet->get_objet_id());    
              }
    ?>
        <table border=0>
		
            <tr> 
                <td> <?php echo $this->lang->line('common_ress_title'); ?> </td> 
                <td> <input type=text name=titre value="<?php echo set_value('titre'); ?>" size="30"/> </td>
                <td class="error_form"><?php echo form_error('titre'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_description'); ?> </td>
                <td> <textarea name=description value="<?php echo set_value('description'); ?>" rows="5" cols="75"><?php echo set_value('description'); ?></textarea> </td>
                <td class="error_form"><?php echo form_error('description'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_reference'); ?> </td>
                <td> <input type=text name=reference_ressource value="<?php echo set_value('reference_ressource'); ?>" size="30"/> </td>
                <td class="error_form"><?php echo form_error('reference_ressource'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_disponibilite'); ?> </td>
                <td> <input type="text" name=disponibilite value="<?php echo set_value('disponibilite'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('disponibilite'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_theme_ressource'); ?> </td>
                <td> <input type="text" name=theme_ressource value="<?php echo set_value('theme_ressource'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('theme_ressource'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_author'); ?> </td>
                <td> <input type="text" name=auteurs value="<?php echo set_value('auteurs'); ?>" size="30"></td>
                <td class="error_form"><?php echo form_error('auteurs'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_editor'); ?> </td>
                <td> <input type="text" name=editeur value="<?php echo set_value('editeur'); ?>" size="30"></td>
                <td class="error_form"><?php echo form_error('editeur'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_edit_town'); ?> </td>
                <td> <input type="text" name=ville_edition value="<?php echo set_value('ville_edition'); ?>" size="30"></td>
                <td class="error_form"><?php echo form_error('ville_edition'); ?></td>
            </tr>
            
        </table>
        <table>
        
            <tr>
                <td> <?php echo $this->lang->line('date_edit'); ?> </td>
            </tr>
            <tr>
		<td> <?php echo $this->lang->line('date_day'); ?> </td>
                <td> <input type=text name=jour value="<?php echo set_value('jour'); ?>" size="3" maxlength="2"> </td>
		<td> <?php echo $this->lang->line('date_month'); ?> </td>
		<td> <input type=text name=mois value="<?php echo set_value('mois'); ?>" size="3" maxlength="2"> </td>
		<td> <?php echo $this->lang->line('date_year'); ?> </td>
		<td> <input type=text name=annee value="<?php echo set_value('annee'); ?>" size="5" maxlength="4"> </td>
            </tr>
            <tr>
                <td class="error_form"><?php echo form_error('jour'); ?></td>
                <td class="error_form"><?php echo form_error('mois'); ?></td>
                <td class="error_form"><?php echo form_error('annee'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('date_prod'); ?> </td>
            </tr>
            <tr>
		<td> <?php echo $this->lang->line('date_day'); ?> </td>
                <td> <input type=text name=jourProd value="<?php echo set_value('jourProd'); ?>" size="3" maxlength="2"> </td>
		<td> <?php echo $this->lang->line('date_month'); ?> </td>
		<td> <input type=text name=moisProd value="<?php echo set_value('moisProd'); ?>" size="3" maxlength="2"> </td>
		<td> <?php echo $this->lang->line('date_year'); ?> </td>
		<td> <input type=text name=anneeProd value="<?php echo set_value('anneeProd'); ?>" size="5" maxlength="4"> </td>
            </tr>
            <tr>
                <td class="error_form"><?php echo form_error('jourProd'); ?></td>
                <td class="error_form"><?php echo form_error('moisProd'); ?></td>
                <td class="error_form"><?php echo form_error('anneeProd'); ?></td>
            </tr>
         
        </table> 
        <table>
            
            <tr>
                <td> <?php echo $this->lang->line('common_ress_keywords'); ?> </td>
                <td> <textarea name=mots_cles value="<?php echo set_value('mots_cles'); ?>" rows="2" cols="75"><?php echo set_value('mots_cles'); ?></textarea> </td>
                <td class="error_form"><?php echo form_error('mots_cles'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_length'); ?> </td>
                <td> <input type="text" name="duree" value="<?php echo set_value('duree'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('duree'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_broadcast'); ?> </td>
                <td> <input type="text" name="diffusion" value="<?php echo set_value('diffusion'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('diffusion'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_version'); ?> </td>
                <td> <input type="text" name="versionvideo" value="<?php echo set_value('versionvideo'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('versionvideo'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_distrib'); ?> </td>
                <td> <input type="text" name="distribution" value="<?php echo set_value('distribution'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('distribution'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_prod'); ?> </td>
                <td> <input type="text" name="production" value="<?php echo set_value('production'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('production'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_vid_upload'); ?> </td>
                <td> 
                    <input type="file" name="video">
                </td>                
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_vid_url'); ?> </td>
                <td> <input type="text" name="video_link" value="<?php echo set_value('video_link'); ?>" size="30" maxlength="255"> </td>
                <td class="error_form"><?php echo form_error('video_link'); ?></td>              
            </tr>
             <?php if(!isset($linkedObjet)){ ?>
                    <tr>
                        <td> <?php echo $this->lang->line('common_add_ress_create_doc'); ?> </td>
                        <td>
                            <select name="objet">
                                <option value=""> <?php echo $this->lang->line('common_add_ress_create_doc_none'); ?> </option>
                                <?php foreach($objet_list as $objet): 
                                        echo '<option value="'.$objet->get_objet_id().'">'.$objet->get_nom_objet().'</option>'; 
                                      endforeach; ?>
                            
                            </select>
                        </td>
                    </tr>
            <?php }else{ ?>
                <tr>
                    <td>
                        <input type="hidden" name="objet" value="<?php echo $linkedObjet->get_objet_id(); ?>" />
                    </td>
                </tr>
            <?php } ?>
            <tr><td><input type="submit" value="<?php echo $this->lang->line('common_add_ress_form_submit'); ?>" /><tr><td>
        </table>
    </form>
