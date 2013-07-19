

	<h1>
            <?php echo $this->lang->line('common_add_ress_txt_form'); ?>
            <?php if(isset($linkedObjet)){
                echo $this->lang->line('common_add_ress_linked').$linkedObjet->get_nom_objet();
            } ?>
        </h1>
        
        <?php if(!isset($linkedObjet)){
                    echo form_open('data_center/ajout_ressource/formulaire_texte');
              }else{
                    echo form_open('data_center/ajout_ressource/formulaire_texte/'.$linkedObjet->get_objet_id());    
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
                    <td> <input type="text" name=disponibilite value="<?php echo set_value('disponibilite'); ?>" size="30"></textarea> </td>
                    <td class="error_form"><?php echo form_error('disponibilite'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_theme_ressource'); ?> </td>
                <td> <input type="text" name=theme_ressource value="<?php echo set_value('theme_ressource'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('theme_ressource'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_ress_author'); ?> </td>
                    <td> <input type="text" name=auteurs value="<?php echo set_value('auteurs'); ?>" size="30"></textarea> </td>
                    <td class="error_form"><?php echo form_error('auteurs'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_ress_editor'); ?> </td>
                    <td> <input type="text" name=editeur value="<?php echo set_value('editeur'); ?>" size="30"></textarea> </td>
                    <td class="error_form"><?php echo form_error('editeur'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_ress_edit_town'); ?> </td>
                    <td> <input type="text" name=ville_edition value="<?php echo set_value('ville_edition'); ?>" size="30"></textarea> </td>
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
         
        </table>    
        <table>
            
            <tr>
                    <td> <?php echo $this->lang->line('common_ress_keywords'); ?> </td>
                    <td> <textarea name=mots_cles value="<?php echo set_value('mots_cles'); ?>" rows="2" cols="75"><?php echo set_value('mots_cles'); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('mots_cles'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_ress_subcategory'); ?> </td>
                    <td> <input type="text" name="sous_categorie" value="<?php echo set_value('sous_categorie'); ?>" size="30"> </td>
                    <td class="error_form"><?php echo form_error('sous_categorie'); ?></td>
            </tr>  
            <tr>
                <td> <span class="hint"><?php echo $this->lang->line('common_ress_pagination'); ?>
                        <span>
                            <?php echo $this->lang->line('common_ress_page_hint'); ?>
                        </span>
                    </span>
                </td>
                    <td> <input type="text" name="pagination" value="<?php echo set_value('pagination'); ?>"> </td>
                    <td class="error_form"><?php echo form_error('pagination'); ?></td>
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
                    <tr>
                        <td>
                            <?php echo $this->lang->line('common_add_ress_link_doc'); ?>
                            <input type="texte" name="page" value="0" pattern="[0-9]*" size="4"> 
                            <?php echo $this->lang->line('common_add_ress_link_doc_end'); ?>
                        <td>
                    </tr>
            <?php }else{ ?>
                <tr>
                    <td>
                        <?php echo $this->lang->line('common_add_ress_link_doc'); ?>
                        <input type="texte" name="page" value="0" pattern="[0-9]*" size="4"> 
                        <?php echo $this->lang->line('common_add_ress_link_doc_end'); ?>
                        <input type="hidden" name="objet" value="<?php echo $linkedObjet->get_objet_id(); ?>" />
                    </td>
                </tr>
            <?php } ?>
            
            <tr><td><input type="submit" value="<?php echo $this->lang->line('common_add_ress_form_submit'); ?>" /><tr><td>
                            
        </table>
    </form>
