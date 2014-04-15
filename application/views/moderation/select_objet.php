
    <p><?php echo anchor('moderation/moderation_center', $this->lang->line('moderation_go_back_link')); ?></p>
    
    <h1><?php echo $this->lang->line('common_select_data'); ?></h1>
    
    <h2>
        <?php echo $this->lang->line('common_list_object'); ?>
        <?php if($goal=='add_relation'){ echo $this->lang->line('common_list_link_rel').$objetSource->get_nom_objet();}
              if($goal=='add_doc'){ echo $this->lang->line('common_list_link_doc').$ressource->get_titre(); } ?>
    </h2>
    
<!--    sorting form-->
    <?php if($goal=='modify' || $goal=='relation'){
              echo form_open('moderation/modify_objet/sort_sel_obj/'.$goal);
          }elseif($goal=='add_relation'){
              $objet_id = $objetSource->get_objet_id();
              echo form_open('moderation/modify_objet/sort_sel_obj/'.$goal.'/'.$objet_id);
          }elseif($goal = 'add_doc'){
              if($typeRessource=='ressource_texte'){
                  $ressource_id = $ressource->get_ressource_textuelle_id();
              } else {
                  $getMethod='get_'.$typeRessource.'_id';
                  $ressource_id = $ressource->$getMethod(); 
              }
              echo form_open('moderation/modify_ressource/sort_sel_obj/add_doc/'.$ressource_id.'/'.$typeRessource);
          }         
    ?>
        <label for="orderBy"><?php echo $this->lang->line('common_list_sort_by'); ?></label>
        <select name="orderBy" id="orderBy">
            <option value="nom_objet" <?php if($this->session->userdata('sel_obj_orderBy') == 'nom_objet'){ 
                                                echo 'selected'; 
                                            } ?>>
                <?php echo $this->lang->line('common_list_nom_objet'); ?>
            </option>
            <option value="username" <?php if($this->session->userdata('sel_obj_orderBy') == 'username'){ 
                                                echo 'selected'; 
                                            } ?>>
                <?php echo $this->lang->line('common_list_creator_obj'); ?>
            </option>
            <option value="date_creation" <?php if($this->session->userdata('sel_obj_orderBy') == 'date_creation'){ 
                                                echo 'selected'; 
                                            } ?>>
                <?php echo $this->lang->line('common_list_date_add_obj'); ?>
            </option>
        </select>
        <select name="orderDirection">
            <option value="asc" <?php if($this->session->userdata('sel_obj_orderDirection') == 'asc'){ 
                                          echo 'selected'; 
                                      } ?>>
                <?php echo $this->lang->line('common_list_sort_dir_asc'); ?>
            </option>
            <option value="desc" <?php if($this->session->userdata('sel_obj_orderDirection') == 'desc'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_list_sort_dir_desc'); ?>
            </option>
        </select>
        <br/>
        <label for="speAttribute"><?php echo $this->lang->line('common_list_select'); ?></label>
        <select name="speAttribute" id="speAttribute">
            <option value="nom_objet" <?php if($this->session->userdata('sel_obj_speAttribute') == 'nom_objet'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_list_nom_objet'); ?>
            </option>
            <option value="username" <?php if($this->session->userdata('sel_obj_speAttribute') == 'username'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_list_creator_obj'); ?>
            </option>
            <option value="mots_cles" <?php if($this->session->userdata('sel_obj_speAttribute') == 'mots_cles'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_obj_mots_cles'); ?>
            </option>
            <option value="historique" <?php if($this->session->userdata('sel_obj_speAttribute') == 'historique'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_obj_historique'); ?>
            </option>
            <option value="description" <?php if($this->session->userdata('sel_obj_speAttribute') == 'description'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_obj_description'); ?>
            </option>
            <option value="adresse_postale" <?php if($this->session->userdata('sel_obj_speAttribute') == 'adresse_postale'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_obj_adresse_postale'); ?>
            </option>
        </select>
        <input type="text" name="speAttributeValue" maxlength="50" 
               value="<?php if($this->session->userdata('sel_obj_speAttributeValue') != null){ 
                                echo $this->session->userdata('sel_obj_speAttributeValue'); 
                      } ?>" />
        <br/>
        <input type="checkbox" name="validation" value="TRUE" <?php if($this->session->userdata('sel_obj_valid') != null){ 
                                          echo 'checked'; 
                                       } ?>><?php echo $this->lang->line('common_list_filter_unvalid'); ?>
        <br/>
        <label for="valAttribute"><?php echo $this->lang->line('common_list_select_valid_service'); ?></label>
        <select name="valAttribute" id="valAttribute">
            <option value="conservation">
                <?php echo $this->lang->line('common_list_service_cons'); ?>
            </option>
            <option value="public">
                <?php echo $this->lang->line('common_list_service_pub'); ?>
            </option>
        </select>
        <br/>
        <input type="submit" value="<?php echo $this->lang->line('common_list_sort_button'); ?>" />


    </form>
    
<!--    page navigation-->
<div style="text-align: right;">
    Page : 
    <?php
    if ($goal=='modify' || $goal=='relation') {
        for ($i = 1; $i <= $numPage; $i++) {
            if($i != $currentPage){
                echo anchor('moderation/modify_objet/select_objet/' . $goal . '/' . $i, $i, array('class'=>'otherPage'));
                echo '&nbsp;';
            }else{
                echo anchor('moderation/modify_objet/select_objet/' . $goal . '/' . $i, $i, array('class'=>'currentPage'));
                echo '&nbsp;';
            }
        }
    } elseif($goal=='add_relation') {
        $objet_id = $objetSource->get_objet_id();
        for ($i = 1; $i <= $numPage; $i++) {
            if($i != $currentPage){
                echo anchor('moderation/modify_objet/select_objet/' . $goal . '/' . $i. '/' . $objet_id, $i, array('class'=>'otherPage'));
                echo '&nbsp;';
            }else{
                echo anchor('moderation/modify_objet/select_objet/' . $goal . '/' . $i. '/' . $objet_id, $i, array('class'=>'currentPage'));
                echo '&nbsp;';
            }
        }
    } elseif($goal = 'add_doc') {
          if($typeRessource=='ressource_texte'){
              $ressource_id = $ressource->get_ressource_textuelle_id();
          } else {
              $getMethod='get_'.$typeRessource.'_id';
              $ressource_id = $ressource->$getMethod(); 
          }
          for ($i = 1; $i <= $numPage; $i++) {
              if($i != $currentPage){
                  echo anchor('moderation/modify_ressource/select_objet/add_doc/' . $ressource_id.'/'.$typeRessource . '/' . $i, $i, array('class'=>'otherPage'));
                  echo '&nbsp;';
              }else{
                  echo anchor('moderation/modify_ressource/select_objet/add_doc/' . $ressource_id.'/'.$typeRessource . '/' . $i, $i, array('class'=>'currentPage'));
                  echo '&nbsp;';
              }
          }
    }
    ?>
</div>
<br>    
    
<!--    list of objets-->

    <div class="classyTable">
    <table>
        <thead>
            <tr>
                <th><?php echo $this->lang->line('common_objet'); ?></th>
                <th><?php echo $this->lang->line('common_obj_creator'); ?></th>
                <th><?php echo $this->lang->line('common_list_is_valid'); ?></th>
                <th><?php echo $this->lang->line('common_list_is_valid_conservation'); ?></th>
                <th><?php echo $this->lang->line('common_list_is_valid_public'); ?></th>
                <th><?php echo $this->lang->line('common_list_is_valid_edition'); ?></th>
                <?php if($goal=='modify'){ ?>
                        <th><?php echo $this->lang->line('moderation_list_modif_valid'); ?></th>
                        <th><?php echo $this->lang->line('moderation_list_lock_review'); ?></th>
                        <th><?php echo $this->lang->line('moderation_list_delete'); ?></th>
                <?php } ?>
                <?php if($goal=='relation'){ ?>
                        <th><?php echo $this->lang->line('moderation_list_create_rel'); ?></th>
                        <th><?php echo $this->lang->line('moderation_list_delete_rel'); ?></th>
                <?php } ?>
                <?php if($goal=='add_relation'){ ?>
                        <th><?php echo $this->lang->line('common_list_link_obj_to').$objetSource->get_nom_objet();?></th>
                <?php } ?>
                <?php if($goal=='add_doc'){ ?>
                        <th><?php echo $this->lang->line('common_list_link_obj_to').$ressource->get_titre();?></th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listObjet as $objet) {        ?>
                <tr>
                    <td><?php echo $objet->get_nom_objet(); ?></td>
                    <td><?php echo $objet->get_username(); ?></td>
                    <td><?php if($objet->get_validation()=='t'){
                                echo $this->lang->line('common_list_valid');
                              }else{
                                echo $this->lang->line('common_list_unvalid'); }
                        ?>
                    </td>
                    <td><?php if ($objet->get_validation_status('conservation') == True) {
                                echo $this->lang->line('common_list_valid');
                              } else {
                                echo $this->lang->line('common_list_unvalid'); }
                        ?></td>
                    <td><?php if ($objet->get_validation_status('public') == True) {
                                echo $this->lang->line('common_list_valid');
                              }else{
                                echo $this->lang->line('common_list_unvalid'); }
                        ?></td>
                    <td><?php if ($objet->get_validation_status('edition') == True) {
                                echo $this->lang->line('common_list_valid');
                              }else{
                                echo $this->lang->line('common_list_unvalid'); }
                        ?></td>
                    <?php if($goal=='modify'){ ?>
                        <td>
                            <?php echo form_open('moderation/modify_objet/index/'.$goal) ?>
                                <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                <?php if ($objet->get_review_status() == $this->session->userdata('username') || !$objet->get_review_status()) { echo '<input type="submit" value="'; echo $this->lang->line('moderation_list_modify_obj'); echo '" />';} ?>
                            </form>
                            <?php 
                                if ($objet->get_validation_status('conservation') && $objet->get_validation_status('public') && $objet->get_validation_status('edition')) {
                                    echo form_open('moderation/modify_objet/validate');
                                    echo '<input type="hidden" name="objet_id" value="'; echo $objet->get_objet_id(); echo '" />';
                                    echo '<input type="submit" value="'; echo $this->lang->line('moderation_list_validate_obj'); echo '" />';
                                    echo '</form>';
                                } ?>
                        </td>
                        <td>
                            <?php 
                                if (!$objet->get_review_status()) {
                                    echo form_open('moderation/modify_objet/lock_review');
                                    echo '<input type="hidden" name="objet_id" value="'; echo $objet->get_objet_id(); echo '" />';
                                    echo '<input type="submit" value="'; echo $this->lang->line('moderation_list_review_obj'); echo '" />';
                                    echo '</form>';
                                } else echo $objet->get_review_status(); ?>
                        </td>
                        <td>
                            <?php echo form_open('moderation/modify_objet/delete_objet') ?>
                                <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                
                                <div class="message" style="left:15%; top:40%; display:none">
                                    <p>
                                        <?php echo sprintf($this->lang->line('moderation_del_obj_warning'),$objet->get_nom_objet()); ?>
                                    </p>
                                    <input type="submit" value="<?php echo $this->lang->line('moderation_list_delete_obj'); ?>" />
                                    <button type="reset" class="closePopup"><?php echo $this->lang->line('common_cancel'); ?></button>
                                    <?php echo img(array('src'=>'assets/utils/close.png','alt'=>'fermer','width'=>'4%', 
                                                         'class'=>'removePopup')); ?>
                                </div>
                            </form>
                            <button class="removePopup"> <?php echo $this->lang->line('moderation_list_delete_obj'); ?> </button>
                        </td>
                    <?php } ?>
                    <?php if($goal=='relation'){ ?>
                        <td>
                            <?php echo form_open('moderation/modify_objet/add_relation') ?>
                                <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                <input type="submit" value="<?php echo $this->lang->line('moderation_list_addRel'); ?>" />
                            </form>
                        </td>
                        <td>
                            <?php echo form_open('moderation/modify_objet/delete_relation') ?>
                                <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                <input type="submit" value="<?php echo $this->lang->line('moderation_list_delRel'); ?>" />
                            </form>
                        </td>
                    <?php } ?>
                    <?php if($goal=='add_relation'){ ?>
                        <td>
                            <?php echo form_open('moderation/modify_objet/add_relation_form') ?>
                                <input type="hidden" name="objet1_id" value="<?php echo $objetSource->get_objet_id(); ?>" />
                                <input type="hidden" name="objet2_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                <input type="submit" value="<?php echo $this->lang->line('common_list_do_link'); ?>" />
                            </form>
                        </td>
                    <?php } ?>
                    <?php if($goal=='add_doc'){ ?>
                        <td>
                            <?php echo form_open('moderation/modify_ressource/add_doc_form/'.$typeRessource) ?>
                                <?php if($typeRessource!='ressource_video'){ ?>
                                        <?php echo $this->lang->line('common_add_ress_link_doc'); ?>
                                        <input type="texte" name="page" value="0" pattern="[0-9]*" size="4">
                                <?php } ?>
                                <input type="hidden" name="ressource_id" value="<?php if($typeRessource=='ressource_texte'){
                                                                                        echo $ressource->get_ressource_textuelle_id();
                                                                                    } else {
                                                                                        $getMethod='get_'.$typeRessource.'_id';
                                                                                        echo $ressource->$getMethod(); 
                                                                                    } ?>" />
                                <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                <input type="hidden" name="nom_objet" value="<?php echo $objet->get_nom_objet(); ?>" />
                                <input type="hidden" name="ressource_titre" value="<?php echo $ressource->get_titre(); ?>" />
                                <input type="submit" value="<?php echo $this->lang->line('common_list_do_link'); ?>" />
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
    if ($goal=='modify' || $goal=='relation') {
        for ($i = 1; $i <= $numPage; $i++) {
            if($i != $currentPage){
                echo anchor('moderation/modify_objet/select_objet/' . $goal . '/' . $i, $i, array('class'=>'otherPage'));
                echo '&nbsp;';
            }else{
                echo anchor('moderation/modify_objet/select_objet/' . $goal . '/' . $i, $i, array('class'=>'currentPage'));
                echo '&nbsp;';
            }
        }
    } elseif($goal=='add_relation') {
        $objet_id = $objetSource->get_objet_id();
        for ($i = 1; $i <= $numPage; $i++) {
            if($i != $currentPage){
                echo anchor('moderation/modify_objet/select_objet/' . $goal . '/' . $i. '/' . $objet_id, $i, array('class'=>'otherPage'));
                echo '&nbsp;';
            }else{
                echo anchor('moderation/modify_objet/select_objet/' . $goal . '/' . $i. '/' . $objet_id, $i, array('class'=>'currentPage'));
                echo '&nbsp;';
            }
        }
    } elseif($goal = 'add_doc') {
          if($typeRessource=='ressource_texte'){
              $ressource_id = $ressource->get_ressource_textuelle_id();
          } else {
              $getMethod='get_'.$typeRessource.'_id';
              $ressource_id = $ressource->$getMethod(); 
          }
          for ($i = 1; $i <= $numPage; $i++) {
              if($i != $currentPage){
                  echo anchor('moderation/modify_ressource/select_objet/add_doc/' . $ressource_id.'/'.$typeRessource . '/' . $i, $i, array('class'=>'otherPage'));
                  echo '&nbsp;';
              }else{
                  echo anchor('moderation/modify_ressource/select_objet/add_doc/' . $ressource_id.'/'.$typeRessource . '/' . $i, $i, array('class'=>'currentPage'));
                  echo '&nbsp;';
              }
          }
    }
    ?>
</div>

