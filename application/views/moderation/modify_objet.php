

	<h1><?php echo $this->lang->line('common_mod_obj').$objet->get_nom_objet(); ?></h1>
        
        <?php echo form_open('moderation/modify_objet/index/modify'); ?>
        <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
        <table border=0>
		
            <tr><td><?php echo $this->lang->line('common_obj_creator'); ?></td><td><?php echo $objet->get_username(); ?></td></tr>
            <tr> 
                    <td> <?php echo $this->lang->line('common_obj_nom_objet'); ?> </td> 
                    <td> <input type=text name=nom_objet value="<?php echo $objet->get_nom_objet(); ?>" size="30"/> </td>
                    <td class="error_form"><?php echo form_error('nom_objet'); ?></td>
            </tr>
            <tr> 
                    <td> <?php echo $this->lang->line('common_obj_resume'); ?> </td>
                    <td> <textarea name=resume value="<?php echo $objet->get_resume(); ?>" rows="10" cols="75"><?php echo $objet->get_resume(); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('resume'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_obj_historique'); ?> </td>
                    <td> <textarea name=historique value="<?php echo $objet->get_historique(); ?>" rows="10" cols="75"><?php echo $objet->get_historique(); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('historique'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_obj_description'); ?> </td>
                    <td> <textarea name=description value="<?php echo $objet->get_description(); ?>" rows="5" cols="75"><?php echo $objet->get_description(); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('description'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_obj_adresse_postale'); ?> </td>
                    <td> <input type=text name=adresse_postale value="<?php echo $objet->get_adresse_postale(); ?>" size="30"/> </td>
                    <td class="error_form"><?php echo form_error('adresse_postale'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_obj_mots_cles'); ?> </td>
                    <td> <textarea name=mots_cles value="<?php echo $objet->get_mots_cles(); ?>" rows="2" cols="75"><?php echo $objet->get_mots_cles(); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('mots_cles'); ?></td>
            </tr>
            
            <tr>
                <td>
                    <input type="checkbox" name="validate" value="conservation" <?php if($objet->get_validation_status('conservation')==True){echo 'checked';} ?>><?php echo $this->lang->line('common_list_is_valid_conservation');?><br>
                    <input type="checkbox" name="validate" value="public" <?php if($objet->get_validation_status('public')==True){echo 'checked';} ?>><?php echo $this->lang->line('common_list_is_valid_public');?><br>
                    <input type="checkbox" name="validate" value="edition" <?php if($objet->get_validation_status('edition')==True){echo 'checked';} ?>><?php echo $this->lang->line('common_list_is_valid_edition');?>
                </td>
            </tr>
            
            <tr><td><input type="submit" value="<?php echo $this->lang->line('moderation_validate_button'); ?>" /><tr><td>
                            
        </table>
</form>


