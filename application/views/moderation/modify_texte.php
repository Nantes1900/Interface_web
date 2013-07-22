

	<h1><?php echo $this->lang->line('common_mod_ress_txt').$ressource->get_titre(); ?></h1>
        
        <?php echo form_open('moderation/modify_ressource/index/ressource_texte/modify'); ?>
        <input type="hidden" name="ressource_id" value="<?php echo $ressource->get_ressource_textuelle_id(); ?>" />
        <table border=0>
		
            <tr>
                <td><?php echo $this->lang->line('common_obj_creator');?></td>
                <td><?php echo $ressource->get_username(); ?></td></tr>
            <tr> 
                    <td> <?php echo $this->lang->line('common_ress_title');?> </td> 
                    <td> <input type=text name=titre value="<?php echo $ressource->get_titre(); ?>" size="30"/> </td>
                    <td class="error_form"><?php echo form_error('titre'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_ress_description');?> </td>
                    <td> <textarea name=description value="<?php echo $ressource->get_description(); ?>" rows="5" cols="75"><?php echo $ressource->get_description(); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('description'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_ress_reference');?> </td>
                    <td> <input type=text name=reference_ressource value="<?php echo $ressource->get_reference_ressource(); ?>" size="30"/> </td>
                    <td class="error_form"><?php echo form_error('reference_ressource'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_ress_theme_ressource');?> </td>
                    <td> <input type="text" name=theme_ressource value="<?php echo $ressource->get_theme_ressource(); ?>" size="30"></textarea> </td>
                    <td class="error_form"><?php echo form_error('theme_ressource'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_ress_disponibilite');?> </td>
                    <td> <input type="text" name=disponibilite value="<?php echo $ressource->get_disponibilite(); ?>" size="30"></textarea> </td>
                    <td class="error_form"><?php echo form_error('disponibilite'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_ress_author');?> </td>
                    <td> <input type="text" name=auteurs value="<?php echo $ressource->get_auteurs(); ?>" size="30"></textarea> </td>
                    <td class="error_form"><?php echo form_error('auteurs'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_ress_editor');?> </td>
                    <td> <input type="text" name=editeur value="<?php echo $ressource->get_editeur(); ?>" size="30"></textarea> </td>
                    <td class="error_form"><?php echo form_error('editeur'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_ress_edit_town');?> </td>
                    <td> <input type="text" name=ville_edition value="<?php echo $ressource->get_ville_edition(); ?>" size="30"></textarea> </td>
                    <td class="error_form"><?php echo form_error('ville_edition'); ?></td>
            </tr>
            
        </table>
        <table>
        
            <tr>
                    <td> <?php echo $this->lang->line('date_edit');?> </td>
            </tr>
            <tr>
                <?php $arrayDate = break_date_Ymd($ressource->get_date_debut_ressource()); ?>
			<td> <?php echo $this->lang->line('date_day');?> </td>
			<td> <input type=text name=jour value="<?php echo $arrayDate['day']; ?>" size="3" maxlength="2"> </td>
			<td> <?php echo $this->lang->line('date_month');?> </td>
			<td> <input type=text name=mois value="<?php echo $arrayDate['month']; ?>" size="3" maxlength="2"> </td>
			<td> <?php echo $this->lang->line('date_year');?> </td>
			<td> <input type=text name=annee value="<?php echo $arrayDate['year']; ?>" size="5" maxlength="4"> </td>
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
                    <td> <textarea name=mots_cles value="<?php echo $ressource->get_mots_cles(); ?>" rows="2" cols="75"><?php echo $ressource->get_mots_cles(); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('mots_cles'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_ress_subcategory'); ?> </td>
                    <td> <input type="text" name="sous_categorie" value="<?php echo $ressource->get_sous_categorie(); ?>" size="30"> </td>
                    <td class="error_form"><?php echo form_error('sous_categorie'); ?></td>
            </tr>  
            <tr>
                    <td> <?php echo $this->lang->line('common_ress_pagination'); ?> </td>
                    <td> <input type="text" name="pagination" value="<?php echo $ressource->get_pagination(); ?>"> </td>
                    <td class="error_form"><?php echo form_error('pagination'); ?></td>
            </tr>
            
           <tr>
                <td>
                    <input type="checkbox" name="validate" value="TRUE" <?php if($ressource->get_validation()=='t'){echo 'checked';} ?>>
                    <?php echo $this->lang->line('moderation_validate_box'); ?>
                </td>
            </tr>
            
            <tr><td><input type="submit" value="<?php echo $this->lang->line('moderation_validate_button'); ?>" /><tr><td>
                            
        </table>
    </form>
