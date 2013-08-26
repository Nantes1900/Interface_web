
	<h1><?php echo sprintf($this->lang->line('common_add_rel_form'), $objet1->get_nom_objet(), $objet2->get_nom_objet()); ?></h1>
        
        <?php echo form_open('data_center/ajout_relation/formulaire'); ?>
        <input type="hidden" name="objet_id_1" value="<?php echo $objet1->get_objet_id(); ?>" />
        <input type="hidden" name="objet_id_2" value="<?php echo $objet2->get_objet_id(); ?>" />
        <table>
            <tr>
                    <td><?php echo $this->lang->line('common_add_rel_sel_rel'); ?></td>
                    <td> <select name="type_relation">
                            <?php foreach($type_relation_list as $type_relation): 
                                    echo '<option value="'.$type_relation['type_relation_id'].'">'.$type_relation['type_relation'].'</option>'; 
                                  endforeach; ?>
                            
                         </select> </td>
            </tr>
            
        </table>
        <table>
            
            <tr>
                    <td><?php echo $this->lang->line('date_begin'); ?></td>
                    <td> <?php echo $this->lang->line('date_day'); ?> </td>
                    <td> <input type=text name=jour_debut value="<?php echo set_value('jour_debut'); ?>" size="3" maxlength="2"> </td>
                    <td> <?php echo $this->lang->line('date_month'); ?> </td>
                    <td> <input type=text name=mois_debut value="<?php echo set_value('mois_debut'); ?>" size="3" maxlength="2"> </td>
                    <td> <?php echo $this->lang->line('date_year'); ?> </td>
                    <td> <input type=text name=annee_debut value="<?php echo set_value('annee_debut'); ?>" size="5" maxlength="4"> </td>
            </tr>
            <tr>
                    <td class="error_form"><?php echo form_error('jour_debut'); ?></td>
                    <td class="error_form"><?php echo form_error('mois_debut'); ?></td>
                    <td class="error_form"><?php echo form_error('annee_debut'); ?></td>
            </tr>
            <tr>
                    <td><?php echo $this->lang->line('date_end'); ?></td>
                    <td> <?php echo $this->lang->line('date_day'); ?> </td>
                    <td> <input type=text name=jour_fin value="<?php echo set_value('jour_fin'); ?>" size="3" maxlength="2"> </td>
                    <td> <?php echo $this->lang->line('date_month'); ?> </td>
                    <td> <input type=text name=mois_fin value="<?php echo set_value('mois_fin'); ?>" size="3" maxlength="2"> </td>
                    <td> <?php echo $this->lang->line('date_year'); ?> </td>
                    <td> <input type=text name=annee_fin value="<?php echo set_value('annee_fin'); ?>" size="5" maxlength="4"> </td>
            </tr>
            <tr>
                    <td class="error_form"><?php echo form_error('jour_fin'); ?></td>
                    <td class="error_form"><?php echo form_error('mois_fin'); ?></td>
                    <td class="error_form"><?php echo form_error('annee_fin'); ?></td>
            </tr>
            
        </table>
        <table>
            
            <tr>
                    <td> <?php echo $this->lang->line('date_secondary_begin'); ?> </td>
                    <td> <input type=text size=30 name=datation_indication_debut value="<?php echo set_value('datation_indication_debut'); ?>"> </td>
                    <td class="error_form"><?php echo form_error('datation_indication_debut'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('date_secondary_end'); ?> </td>
                    <td> <input type=text size=30 name=datation_indication_fin value="<?php echo set_value('datation_indication_fin'); ?>"> </td>
                    <td class="error_form"><?php echo form_error('datation_indication_fin'); ?></td>
            </tr>
            <tr>
                    <td><?php echo $this->lang->line('common_add_rel_parent_rel'); ?></td>
                    <td><input type="checkbox" name=parent value=1 /></td>
            </tr>
            
            <tr><td><input type="submit" value="<?php echo $this->lang->line('common_add_rel_form_submit'); ?>" /><tr><td>
                        
        </table>