

    <p><?php echo anchor('moderation/moderation_center', 'Revenir au centre de modération'); ?></p>
    
    <h1><?php echo $this->lang->line('moderation_delDoc_title'); ?></h1>
    
    <h2><?php echo $this->lang->line('moderation_delDoc_list').$ressource->get_titre(); ?></h2>
    
    <div class="classyTable">
    <table>
        <thead>
            <tr>
                <th><?php echo $this->lang->line('moderation_delDoc_obj_name'); ?></th>
                <th><?php echo $this->lang->line('common_obj_creator'); ?></th>
                <th><?php echo $this->lang->line('common_obj_resume'); ?></th>
                <th><?php echo $this->lang->line('moderation_delDoc_remove'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($documentationArray as $objet){ ?>
                <tr>
                    <td><?php echo $objet['nom_objet']; ?></td>
                    <td><?php echo $objet['username']; ?></td>
                    <td><?php echo $objet['resume']; ?></td>
                    <td>
                        <?php echo form_open('moderation/modify_ressource/delete_documentation/'.$typeRessource); ?>
                            <input type="hidden" name="ressource_id" value="<?php if($typeRessource=='ressource_texte'){
                                                                                        echo $ressource->get_ressource_textuelle_id();
                                                                                    } else {
                                                                                        $getMethod='get_'.$typeRessource.'_id';
                                                                                        echo $ressource->$getMethod(); 
                                                                                    } ?>" />
                            <input type="hidden" name="documentation_id" value="<?php echo $objet['documentation_id']; ?>" />
                            <input type="hidden" name="nom_objet" value="<?php echo $objet['nom_objet']; ?>" />
                            <input type="hidden" name="ressource_titre" value="<?php echo $ressource->get_titre(); ?>" />
                            <div class="message" style="left:15%; top:40%; display:none">
                                <p>
                                    <?php echo sprintf($this->lang->line('moderation_delDoc_warning_msg'), 
                                            $ressource->get_titre(), $objet['nom_objet']); ?>
                                </p>
                                <input type="submit" value="<?php echo $this->lang->line('moderation_delDoc_remove_this'); ?>" />
                                <button type="reset" class="closePopup"><?php echo $this->lang->line('common_cancel'); ?></button>
                                <?php echo img(array('src'=>'assets/utils/close.png','alt'=>'fermer','width'=>'4%', 
                                                         'class'=>'removePopup')); ?>
                            </div>
                        </form>
                        <button class="removePopup"><?php echo $this->lang->line('moderation_delDoc_remove_this'); ?></button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    
<script src="<?php echo base_url();?>assets/js/removepopup.js"></script>