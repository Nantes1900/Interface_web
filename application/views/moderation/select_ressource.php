
    <p><?php echo anchor('moderation/moderation_center', $this->lang->line('moderation_go_back_link')); ?></p>
    
    <h1><?php echo $this->lang->line('common_select_data'); ?></h1>
    
    <h2>
        <?php if($typeRessource=='ressource_texte'){echo $this->lang->line('common_list_ress_txt');} 
              if($typeRessource=='ressource_video'){echo $this->lang->line('common_list_ress_img');}
              if($typeRessource=='ressource_graphique'){echo $this->lang->line('common_list_ress_vid');}?>
    </h2>
<!--    sorting form-->
    <?php echo form_open('moderation/modify_ressource/sort_sel_ress/'.$typeRessource.'/'.$goal) ?>
        <label for="orderBy"><?php echo $this->lang->line('common_list_sort_by'); ?></label>
        <select name="orderBy" id="orderBy">
            <option value="titre" <?php if($this->session->userdata('sel_ress_orderBy') == 'titre'){ 
                                                echo 'selected'; 
                                            } ?>>
                <?php echo $this->lang->line('common_list_title_ress'); ?>
            </option>
            <option value="username" <?php if($this->session->userdata('sel_ress_orderBy') == 'username'){ 
                                                echo 'selected'; 
                                            } ?>>
                <?php echo $this->lang->line('common_list_creator_obj'); ?>
            </option>
            <option value="theme_ressource" <?php if($this->session->userdata('sel_ress_orderBy') == 'theme_ressource'){ 
                                                echo 'selected'; 
                                            } ?>>
                <?php echo $this->lang->line('common_ress_theme_ressource'); ?>
            </option>
            <option value="date_debut_ressource" <?php if($this->session->userdata('sel_ress_orderBy') == 'date_debut_ressource'){ 
                                                echo 'selected'; 
                                            } ?>>
                <?php echo $this->lang->line('date_begin'); ?>
            </option>
            <option value="date_creation" <?php if($this->session->userdata('sel_ress_orderBy') == 'date_creation'){ 
                                                echo 'selected'; 
                                            } ?>>
                <?php echo $this->lang->line('common_list_date_add_ress'); ?>
            </option>
        </select>
        <select name="orderDirection">
            <option value="asc" <?php if($this->session->userdata('sel_ress_orderDirection') == 'asc'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_list_sort_dir_asc'); ?>
            </option>
            <option value="desc" <?php if($this->session->userdata('sel_ress_orderDirection') == 'desc'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_list_sort_dir_desc'); ?>
            </option>
        </select>
        <br/>
        <label for="speAttribute"><?php echo $this->lang->line('common_list_select'); ?></label>
        <select name="speAttribute" id="speAttribute">
            <option value="titre" <?php if($this->session->userdata('sel_ress_speAttribute') == 'titre'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_list_title_ress'); ?>
            </option>
            <option value="username" <?php if($this->session->userdata('sel_ress_speAttribute') == 'username'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_list_creator_obj'); ?>
            </option>
            <option value="theme_ressource" <?php if($this->session->userdata('sel_ress_speAttribute') == 'theme_ressource'){ 
                                                echo 'selected'; 
                                            } ?>>
                <?php echo $this->lang->line('common_ress_theme_ressource'); ?>
            </option>
            <option value="reference" <?php if($this->session->userdata('sel_ress_speAttribute') == 'reference'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_ress_reference'); ?>
            </option>
            <option value="mots_cles" <?php if($this->session->userdata('sel_ress_speAttribute') == 'mots_cles'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_ress_keywords'); ?>
            </option>
            <option value="description" <?php if($this->session->userdata('sel_ress_speAttribute') == 'description'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_ress_description'); ?>
            </option>
            <option value="auteur" <?php if($this->session->userdata('sel_ress_speAttribute') == 'auteur'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_ress_author'); ?>
            </option>
            <option value="editeur" <?php if($this->session->userdata('sel_ress_speAttribute') == 'editeur'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_ress_editor'); ?>
            </option>
        </select>
        <input type="text" name="speAttributeValue" maxlength="50" 
               value="<?php if($this->session->userdata('sel_ress_speAttributeValue') != null){ 
                                echo $this->session->userdata('sel_ress_speAttributeValue'); 
                      } ?>" />
        <br/>
        <input type="checkbox" name="validation" value="TRUE" <?php if($this->session->userdata('sel_ress_valid') != null){ 
                                          echo 'checked'; 
                                       } ?>><?php echo $this->lang->line('common_list_filter_unvalid_ress'); ?>
        <br/>
        <input type="submit" value="<?php echo $this->lang->line('common_list_sort_button'); ?>" />


    </form>

<!--    page navigation-->
<div style="text-align: right;">
    Page : 
    <?php
        for ($i = 1; $i <= $numPage; $i++) {
            if($i != $currentPage){
                echo anchor('moderation/modify_ressource/select_ressource/' . $typeRessource . '/' .$goal . '/' . $i, $i, array('class'=>'otherPage'));
                echo '&nbsp;';
            }else{
                echo anchor('moderation/modify_ressource/select_ressource/' . $typeRessource . '/' . $goal . '/' . $i, $i, array('class'=>'currentPage'));
                echo '&nbsp;';
            }
        }
    ?>
</div>
<br>        
    
<!--    list of ressources-->

    <div class="classyTable">
    <table>
        <thead>
            <tr>
                <th><?php echo $this->lang->line('common_ressource'); ?></th>
                <th><?php echo $this->lang->line('common_ress_author'); ?></th>
                <th><?php echo $this->lang->line('common_ress_theme_ressource'); ?></th>
                <th><?php echo $this->lang->line('common_ress_reference'); ?></th>
                <th><?php echo $this->lang->line('common_ress_keywords'); ?></th>
                <th><?php echo $this->lang->line('common_list_is_valid'); ?></th>
                <?php if($goal=='modify'){ ?>
                        <th><?php echo $this->lang->line('moderation_list_modif_valid'); ?></th>
                        <th><?php echo $this->lang->line('moderation_list_delete'); ?></th>
                <?php } ?>
                <?php if($goal=='documentation'){ ?>
                    <th><?php echo $this->lang->line('moderation_list_create_doc'); ?></th>
                    <th><?php echo $this->lang->line('moderation_list_delete_doc'); ?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listRessource as $ressource) {        ?>
                <tr>
                    <td><?php echo $ressource->get_titre(); ?></td>
                    <td><?php echo $ressource->get_auteurs(); ?></td>
                    <td><?php echo $ressource->get_theme_ressource(); ?></td>
                    <td><?php echo $ressource->get_reference_ressource(); ?></td>
                    <td><?php echo $ressource->get_mots_cles(); ?></td>
                    <td><?php if($ressource->get_validation()=='t'){
                                echo $this->lang->line('common_list_valid');
                              }else{
                                echo $this->lang->line('common_list_unvalid'); }
                        ?>
                    </td>
                    <?php if($goal=='modify'){ ?>
                        <td>
                            <?php echo form_open('moderation/modify_ressource/index/'.$typeRessource.'/modify') ?>
                                <input type="hidden" name="ressource_id" value="<?php if($typeRessource=='ressource_texte'){
                                                                                        echo $ressource->get_ressource_textuelle_id();
                                                                                    } else {
                                                                                        $getMethod='get_'.$typeRessource.'_id';
                                                                                        echo $ressource->$getMethod(); 
                                                                                    } ?>" />
                                <input type="submit" value="<?php echo $this->lang->line('moderation_list_modify_ress'); ?>" />
                            </form>
                            <?php echo form_open('moderation/modify_ressource/validate_ressource/'.$typeRessource) ?>
                                <input type="hidden" name="ressource_id" value="<?php if($typeRessource=='ressource_texte'){
                                                                                        echo $ressource->get_ressource_textuelle_id();
                                                                                    } else {
                                                                                        $getMethod='get_'.$typeRessource.'_id';
                                                                                        echo $ressource->$getMethod(); 
                                                                                    } ?>" />
                                <input type="submit" value="<?php echo $this->lang->line('moderation_list_validate_ress'); ?>" />
                            </form>
                        </td>
                        <td>
                            <?php echo form_open('moderation/modify_ressource/delete_ressource/'.$typeRessource) ?>
                                <input type="hidden" name="ressource_id" value="<?php if($typeRessource=='ressource_texte'){
                                                                                        echo $ressource->get_ressource_textuelle_id();
                                                                                    } else {
                                                                                        $getMethod='get_'.$typeRessource.'_id';
                                                                                        echo $ressource->$getMethod(); 
                                                                                    } ?>" />
                                <input type="hidden" name="titre" value="<?php echo $ressource->get_titre(); ?>">
                                <div class="message" style="left:15%; top:40%; display:none">
                                    <p>
                                        <?php echo sprintf($this->lang->line('moderation_del_ress_warning'),$ressource->get_titre()); ?>
                                    </p>
                                    <input type="submit" value="<?php echo $this->lang->line('moderation_list_delete_ress'); ?>" />
                                    <button type="reset" class="closePopup"><?php echo $this->lang->line('common_cancel'); ?></button>
                                    <?php echo img(array('src'=>'assets/utils/close.png','alt'=>'fermer','width'=>'4%', 
                                                         'class'=>'removePopup')); ?>
                                </div>
                            </form>
                            <button class="removePopup"> <?php echo $this->lang->line('moderation_list_delete_ress'); ?> </button>
                        </td>
                    <?php } ?>
                    <?php if($goal=='documentation'){ ?>
                        <td>
                            <?php echo form_open('moderation/modify_ressource/add_doc/'.$typeRessource) ?>
                                <input type="hidden" name="ressource_id" value="<?php if($typeRessource=='ressource_texte'){
                                                                                        echo $ressource->get_ressource_textuelle_id();
                                                                                    } else {
                                                                                        $getMethod='get_'.$typeRessource.'_id';
                                                                                        echo $ressource->$getMethod(); 
                                                                                    } ?>" />
                                <input type="submit" value="<?php echo $this->lang->line('common_list_link_ress'); ?>" />
                            </form>
                        </td>
                        <td>
                            <?php echo form_open('moderation/modify_ressource/delete_doc/'.$typeRessource) ?>
                                <input type="hidden" name="ressource_id" value="<?php if($typeRessource=='ressource_texte'){
                                                                                        echo $ressource->get_ressource_textuelle_id();
                                                                                    } else {
                                                                                        $getMethod='get_'.$typeRessource.'_id';
                                                                                        echo $ressource->$getMethod(); 
                                                                                    } ?>" />
                                <input type="submit" value="<?php echo $this->lang->line('common_list_del_doc'); ?>" />
                            </form>
                        </td>
                    <?php } ?>
                </tr>
            <?php }  ?>
        </tbody>
    </table>
    </div>
    
<!--    page navigation-->
<br>
<div style="text-align: right;">
    Page : 
    <?php
        for ($i = 1; $i <= $numPage; $i++) {
            if($i != $currentPage){
                echo anchor('moderation/modify_ressource/select_ressource/' . $typeRessource . '/' .$goal . '/' . $i, $i, array('class'=>'otherPage'));
                echo '&nbsp;';
            }else{
                echo anchor('moderation/modify_ressource/select_ressource/' . $typeRessource . '/' . $goal . '/' . $i, $i, array('class'=>'currentPage'));
                echo '&nbsp;';
            }
        }
    ?>
</div>


