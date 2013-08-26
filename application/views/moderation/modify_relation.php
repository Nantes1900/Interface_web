
    <h1><?php echo sprintf($this->lang->line('moderation_modRel_title'), $objet_source_name, $objet_target_name); ?></h1>
        
    <?php echo form_open('moderation/modify_objet/modify_relation_form'); ?>
        <input type="hidden" name="relation_id" value="<?php echo $relation_id; ?>" />
        <input type="hidden" name="objet_id" value="<?php echo $objet_source_id; ?>" />
        <input type="hidden" name="nom_objet_source" value="<?php echo $objet_source_name; ?>" />
        <input type="hidden" name="nom_objet_target" value="<?php echo $objet_target_name; ?>" />

        <table>
            <tr>
                    <td><?php echo $this->lang->line('common_add_rel_sel_rel'); ?></td>
                    <td> <select name="type_relation">
                            <?php foreach($type_relation_list as $type_relation): 
                                    if ($type_relation['type_relation']!=$relation_info['type_relation']){
                                        echo '<option value="'.$type_relation['type_relation_id'].'">'.$type_relation['type_relation'].'</option>'; 
                                    }else{
                                        echo '<option value="'.$type_relation['type_relation_id'].'" selected>'.$type_relation['type_relation'].'</option>'; 
                                    }
                                  endforeach; ?>
                            
                         </select> </td>
            </tr>
            
        </table>
        <table>
            
            <tr>
                <?php $arrayDate = break_date_Ymd($relation_info['date_debut_relation']); ?>
                    <td><?php echo $this->lang->line('date_begin'); ?></td>
                    <td> <?php echo $this->lang->line('date_day'); ?> </td>
                    <td> <input type=text name=jour_debut value="<?php echo $arrayDate['day']; ?>" size="3" maxlength="2"> </td>
                    <td> <?php echo $this->lang->line('date_month'); ?> </td>
                    <td> <input type=text name=mois_debut value="<?php echo $arrayDate['month']; ?>" size="3" maxlength="2"> </td>
                    <td> <?php echo $this->lang->line('date_year'); ?> </td>
                    <td> <input type=text name=annee_debut value="<?php echo $arrayDate['year']; ?>" size="5" maxlength="4"> </td>
            </tr>
            <tr>
                    <td class="error_form"><?php echo form_error('jour_debut'); ?></td>
                    <td class="error_form"><?php echo form_error('mois_debut'); ?></td>
                    <td class="error_form"><?php echo form_error('annee_debut'); ?></td>
            </tr>
            <tr>
                <?php $arrayDate = break_date_Ymd($relation_info['date_fin_relation']); ?>
                    <td><?php echo $this->lang->line('date_end'); ?></td>
                    <td> <?php echo $this->lang->line('date_day'); ?> </td>
                    <td> <input type=text name=jour_fin value="<?php echo $arrayDate['day']; ?>" size="3" maxlength="2"> </td>
                    <td> <?php echo $this->lang->line('date_month'); ?> </td>
                    <td> <input type=text name=mois_fin value="<?php echo $arrayDate['month']; ?>" size="3" maxlength="2"> </td>
                    <td> <?php echo $this->lang->line('date_year'); ?> </td>
                    <td> <input type=text name=annee_fin value="<?php echo $arrayDate['year']; ?>" size="5" maxlength="4"> </td>
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
                    <td> <input type=text size=30 name=datation_indication_debut value="<?php echo $relation_info['datation_indication_debut']; ?>"> </td>
                    <td class="error_form"><?php echo form_error('datation_indication_debut'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('date_secondary_end'); ?> </td>
                    <td> <input type=text size=30 name=datation_indication_fin value="<?php echo $relation_info['datation_indication_fin']; ?>"> </td>
                    <td class="error_form"><?php echo form_error('datation_indication_fin'); ?></td>
            </tr>
            <tr>
                    <td><?php echo $this->lang->line('common_add_rel_parent_rel'); ?></td>
                    <td>
                        <input type="checkbox" name=parent value=1 
                          <?php if ($relation_info['parent']=='t') echo 'checked';?> />
                    </td>
            </tr>
            
            <tr><td><input type="submit" value="<?php echo $this->lang->line('common_add_rel_form_submit'); ?>" /><tr><td>
                        
        </table>
    <?php echo form_close(); ?>