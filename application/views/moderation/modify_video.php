

    <h1><?php echo $this->lang->line('common_mod_ress_vid').$ressource->get_titre(); ?></h1>
        
    <?php echo form_open_multipart('moderation/modify_ressource/index/ressource_video/modify'); ?>
        <input type="hidden" name="ressource_id" value="<?php echo $ressource->get_ressource_video_id(); ?>" />
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
            <tr>
                <td> <?php echo $this->lang->line('date_prod');?> </td>
            </tr>
            <tr>
                <?php $arrayDate = break_date_Ymd($ressource->get_date_production()); ?>
		<td> <?php echo $this->lang->line('date_day');?> </td>
                <td> <input type=text name=jourProd value="<?php echo $arrayDate['day']; ?>" size="3" maxlength="2"> </td>
		<td> <?php echo $this->lang->line('date_month');?> </td>
		<td> <input type=text name=moisProd value="<?php echo $arrayDate['month']; ?>" size="3" maxlength="2"> </td>
		<td> <?php echo $this->lang->line('date_year');?> </td>
		<td> <input type=text name=anneeProd value="<?php echo $arrayDate['year']; ?>" size="5" maxlength="4"> </td>
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
                <td> <textarea name=mots_cles value="<?php echo $ressource->get_mots_cles(); ?>" rows="2" cols="75"><?php echo $ressource->get_mots_cles(); ?></textarea> </td>
                <td class="error_form"><?php echo form_error('mots_cles'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_length'); ?> </td>
                <td> <input type="text" name="duree" value="<?php echo $ressource->get_duree(); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('duree'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_broadcast'); ?> </td>
                <td> <input type="text" name="diffusion" value="<?php echo $ressource->get_diffusion(); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('diffusion'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_version'); ?> </td>
                <td> <input type="text" name="versionvideo" value="<?php echo $ressource->get_versionvideo(); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('versionvideo'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_distrib'); ?> </td>
                <td> <input type="text" name="distribution" value="<?php echo $ressource->get_distribution(); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('distribution'); ?></td>
            </tr>
            <tr>
                <td> <?php echo $this->lang->line('common_ress_prod'); ?> </td>
                <td> <input type="text" name="production" value="<?php echo $ressource->get_production(); ?>" size="30"> </td>
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
                <td> <input type="text" name="video_link" value="<?php echo $ressource->get_video_link(); ?>" size="30" maxlength="255"> </td>
                <td class="error_form"><?php echo form_error('video_link'); ?></td>              
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
