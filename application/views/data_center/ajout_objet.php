

<h1><?php echo $this->lang->line('common_add_obj_form'); ?></h1>
        
<?php echo form_open('data_center/ajout_objet'); ?>
        
    <table border=0>
		
        <tr> 
            <td> <?php echo $this->lang->line('common_obj_nom_objet'); ?> </td> 
            <td> <input type=text name=nom_objet value="<?php echo set_value('nom_objet'); ?>" size="30"/> </td>
            <td class="error_form"><?php echo form_error('nom_objet'); ?></td>
        </tr>
        <tr> 
            <td> <?php echo $this->lang->line('common_obj_resume'); ?> </td>
            <td> <textarea name=resume value="<?php echo set_value('resume'); ?>" rows="10" cols="75"><?php echo set_value('resume'); ?></textarea> </td>
            <td class="error_form"><?php echo form_error('resume'); ?></td>
        </tr>
        <tr>
            <td> <?php echo $this->lang->line('common_obj_historique'); ?> </td>
            <td> <textarea name=historique value="<?php echo set_value('historique'); ?>" rows="10" cols="75"><?php echo set_value('historique'); ?></textarea> </td>
            <td class="error_form"><?php echo form_error('historique'); ?></td>
        </tr>
        <tr>
            <td> <?php echo $this->lang->line('common_obj_description'); ?> </td>
            <td> <textarea name=description value="<?php echo set_value('description'); ?>" rows="5" cols="75"><?php echo set_value('description'); ?></textarea> </td>
            <td class="error_form"><?php echo form_error('description'); ?></td>
        </tr>
        <tr>
            <td> <?php echo $this->lang->line('common_obj_adresse_postale'); ?> </td>
            <td> <input type=text name=adresse_postale value="<?php echo set_value('adresse_postale'); ?>" size="30"/> </td>
            <td class="error_form"><?php echo form_error('adresse_postale'); ?></td>
        </tr>
        <tr>
            <td> <?php echo $this->lang->line('common_obj_mots_cles'); ?> </td>
            <td> <textarea name=mots_cles value="<?php echo set_value('mots_cles'); ?>" rows="2" cols="75"><?php echo set_value('mots_cles'); ?></textarea> </td>
            <td class="error_form"><?php echo form_error('mots_cles'); ?></td>
        </tr>

        <tr><td><input type="submit" value="<?php echo $this->lang->line('common_add_obj_form_submit'); ?>" /><tr><td>

    </table>
</form>


