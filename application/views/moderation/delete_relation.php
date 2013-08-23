

    <p><?php echo anchor('moderation/moderation_center', 'Revenir au centre de modération'); ?></p>
    
    <h1><?php echo $this->lang->line('moderation_delRel_title'); ?></h1>
    
    <h2><?php echo $this->lang->line('moderation_delDoc_list').$objet->get_nom_objet(); ?></h2>
    
    <div class="classyTable">
    <table>
        <thead>
            <tr>
                <th><?php echo $this->lang->line('moderation_delDoc_obj_name'); ?></th>
                <th><?php echo $this->lang->line('moderation_relation_creator'); ?></th>
                <th><?php echo $this->lang->line('moderation_relation_type'); ?></th>
                <th><?php echo $this->lang->line('date_dates'); ?></th>
                <th><?php echo $this->lang->line('common_obj_resume'); ?></th>
                <th><?php echo $this->lang->line('moderation_delRel_remove'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($linkedObjetArray as $objetArray){ ?>
                <tr>
                    <td><?php echo $objetArray['nom_objet']; ?></td>
                    <td><?php echo $objetArray['relcreator']; ?></td>
                    <td><?php echo $objetArray['type_relation']; ?></td>
                    <td><?php echo 'du '.to_date_dmy($objetArray['date_debut_relation']).' au '.to_date_dmy($objetArray['date_fin_relation']); ?></td>
                    <td><?php echo $objetArray['resume']; ?></td>
                    <td>
                        <?php echo form_open('moderation/modify_objet/delete_relation_form'); ?>
                            <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                            <input type="hidden" name="relation_id" value="<?php echo $objetArray['relation_id']; ?>" />
                            <input type="hidden" name="nom_objet_source" value="<?php echo $objet->get_nom_objet(); ?>" />
                            <input type="hidden" name="nom_objet_target" value="<?php echo $objetArray['nom_objet']; ?>" />
                            <div class="message" style="left:15%; top:40%; display:none">
                                <p>
                                    <?php echo sprintf($this->lang->line('moderation_delRel_warning_msg'), 
                                            $objet->get_nom_objet(), $objetArray['nom_objet']); ?>
                                </p>
                                <input type="submit" value="<?php echo $this->lang->line('moderation_delRel_remove_this'); ?>" />
                                <button type="reset" class="closePopup"><?php echo $this->lang->line('common_cancel'); ?></button>
                                <?php echo img(array('src'=>'assets/utils/close.png','alt'=>'fermer','width'=>'4%', 
                                                         'class'=>'removePopup')); ?>
                           </div>
                        </form>
                        <button class="removePopup"> <?php echo $this->lang->line('moderation_delRel_remove_this'); ?> </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    
<script src="<?php echo base_url();?>assets/js/removepopup.js"></script>