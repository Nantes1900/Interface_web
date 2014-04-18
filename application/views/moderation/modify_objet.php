
        <p><?php echo anchor('moderation/modify_objet/index/modify', $this->lang->line('moderation_list_go_back_link')); ?></p>
	<h1><?php echo $this->lang->line('common_mod_obj').$objet->get_nom_objet(); ?></h1>
        <button name="print" onclick="window.print(); return false;"><?php echo $this->lang->line('moderation_print_sheet'); ?></button>
        
        <?php echo form_open('moderation/modify_objet/index/modify'); ?>
        <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
        
        <table border=0>
            <tr><td><?php echo $this->lang->line('common_obj_creator'); ?></td><td><?php echo $objet->get_username(); ?></td></tr>
            <tr> 
                    <td> <?php echo $this->lang->line('common_obj_nom_objet'); ?> </td> 
                    <td class="printable"> <input type=text name=nom_objet value="<?php if (set_value('nom_objet',$objet->get_nom_objet()) != '') { echo set_value('nom_objet',$objet->get_nom_objet()); } else { echo $this->session->flashdata('nom_objet'); } ; ?>" size="30"/> </td>
                    <td class="error_form"><?php echo form_error('nom_objet'); ?></td>
            </tr>
            <tr> 
                    <td> <?php echo $this->lang->line('common_obj_resume'); ?> </td>
                    <td class="printable"> <textarea name="resume" rows="10" cols="75"><?php if (set_value('resume',$objet->get_resume()) != '') { echo set_value('resume',$objet->get_resume()); } else { echo $this->session->flashdata('resume'); } ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('resume'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_obj_historique'); ?> </td>
                    <td class="printable"> <textarea name=historique rows="10" cols="75"><?php if (set_value('historique',$objet->get_historique()) != '') { echo set_value('historique',$objet->get_historique()); } else { echo $this->session->flashdata('historique'); } ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('historique'); ?></td>
            </tr>
            <tr>
                    <td class="printable"> <?php echo $this->lang->line('common_obj_adresse_postale'); ?> </td>
                    <td> <input type=text name=adresse_postale value="<?php if (set_value('adresse_postale',$objet->get_adresse_postale()) != '') { echo set_value('adresse_postale',$objet->get_adresse_postale()); } else { echo $this->session->flashdata('adresse_postale'); } ?>" size="30"/> </td>
                    <td class="error_form"><?php echo form_error('adresse_postale'); ?></td>
            </tr>
            <tr>
                    <td> <?php echo $this->lang->line('common_obj_mots_cles'); ?> </td>
                    <td class="printable"> <textarea name=mots_cles rows="2" cols="75"><?php if (set_value('mots_cles',$objet->get_mots_cles()) != '') { echo set_value('mots_cles',$objet->get_mots_cles()); } else { echo $this->session->flashdata('mots_cles'); } ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('mots_cles'); ?></td>
            </tr>
            
            <tr>
                <td>
                    <input type="checkbox" name="validate" value="conservation" <?php if($objet->get_validation_status('conservation')==True){echo 'checked="checked"'; echo 'disabled="disabled"';} ?>><?php echo $this->lang->line('common_list_is_valid_conservation');?><br>
                    <?php
                        //Display further validation checkboxes only if previous is ok
                        if($objet->get_validation_status('conservation')==True) {
                            echo '<input type="checkbox" name="validate" value="public"';
                            if($objet->get_validation_status('public')==True) { 
                                echo 'checked="checked"'; echo 'disabled="disabled"';
                            }
                            echo '>';
                            echo $this->lang->line('common_list_is_valid_public');
                        } ?><br>
                    <?php
                        //Display further validation checkboxes only if previous is ok
                        if($objet->get_validation_status('public')==True) {
                            echo '<input type="checkbox" name="validate" value="edition"';
                            if($objet->get_validation_status('edition')==True) {
                                echo 'checked="checked"'; echo 'disabled="disabled"';
                            }
                            echo '>';
                            echo $this->lang->line('common_list_is_valid_edition');
                        } ?>
                </td>
            </tr>
            <tr><td><?php
                    echo $this->lang->line('moderation_statute'); 
                    if ($objet->get_statut() != null) {   
                        echo $objet->get_statut();
                    } else {
                        ?>
                    <select name="statut">
                        <option value=""></option>
                        <option value="ebauche"><?php echo $this->lang->line('common_list_statut_ebauche'); ?></option>
                        <option value="a_revoir"><?php echo $this->lang->line('common_list_statut_revoir'); ?></option>
                    </select>
                    <?php }
            ?></td></tr>
            <tr><td><input type="submit" value="<?php echo $this->lang->line('moderation_validate_button'); ?>" /><tr><td>
                            
        </table>
</form>

<!-- printing existing annotation-->
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
                                            <button type="submit" class="invisible" title="<?php echo $this->lang->line('common_annot_delete_com');?>"> 
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
                                <input type="submit" value="<?php echo $this->lang->line('common_annot_answer');?>" />
                            <?php echo form_close() ?>
                                <?php if($this->session->userdata('username')==$annotations['father']->get_username()
                                         || $this->session->userdata('user_level')>=5){
                                          echo form_open('data_center/ajout_annotation/index/delete');?>
                                             <input type="hidden" name="type_target" value="objet" />
                                             <input type="hidden" name="target_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                             <input type="hidden" name="annot_id" 
                                                   value="<?php echo $annotations['father']->get_annotation_id(); ?>" />
                                             <div class="message" style="left:15%; top:40%; display:none">
                                                 <p><?php echo $this->lang->line('common_annot_delete_warning');?></p>
                                                <button type="submit" > <?php echo $this->lang->line('common_annot_delete');?> </button>
                                                 <button type="reset" class="closePopup"><?php echo $this->lang->line('common_cancel'); ?></button>
                                                 <?php echo img(array('src'=>'assets/utils/close.png','alt'=>'fermer', 
                                                         'class'=>'removePopup')); ?>
                                             </div>
                                <?php    echo form_close(); ?>
                                             <button class="removePopup invisible" title="<?php echo $this->lang->line('common_annot_delete');?>" style="margin-left:90%;"> 
                                                      <?php echo img(array('src'=>'assets/utils/delete.png','alt'=>'delete')); ?>
                                             </button>
                                <?php      } ?>
                        </div>
        <?php        }
            }?>
         
<!-- new annotation form-->
        <?php if ($this->session->userdata('user_level') >= 4){ ?>
            <button id="newAnnot"><?php echo $this->lang->line('common_new_annot');?></button>
            <div class="newAnnot"></div>
            <div class="annotation new" title="<?php echo $this->lang->line('common_new_annot');?>">
                <?php echo $this->lang->line('common_new_annot_instruction');?>
                <div class="annotSeparator"></div>
                <?php echo form_open('data_center/ajout_annotation/index/new') ?>
                    <input type="text" name="titre" placeholder="Titre annotation"/>
                    <textarea name="texte"></textarea>
                    <?php $this->session->set_flashdata('redir',$this->uri->uri_string());?>
                    <input type="hidden" name="type_target" value="objet" />
                    <input type="hidden" name="target_id" value="<?php echo $objet->get_objet_id(); ?>" />
                    <input type="submit" action="" value="<?php echo $this->lang->line('common_new_annot_create');?>" />
                <?php echo form_close()?>
            </div>
        <?php } ?>
