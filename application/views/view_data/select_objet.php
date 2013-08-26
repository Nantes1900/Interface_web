
    <p><?php echo anchor('view_data/select_data/index', $this->lang->line('common_view_go_back_link')); ?></p>
    
    <h1><?php echo $this->lang->line('common_select_data'); ?></h1>
    
    <h2>
        <?php echo $this->lang->line('common_list_object'); ?>
        <?php if($goal=='add_doc'){ echo $this->lang->line('common_list_link_doc').$ressource->get_titre(); } ?>
        <?php if($goal=='add_geo'){ echo $this->lang->line('common_list_link_geo'); } ?>
        <?php if($goal=='add_rel'){ echo ' à relier'; } ?>
        <?php if($goal=='add_rel' && isset($targetObjet)){ echo ' à <em>'.$targetObjet->get_nom_objet().'</em>'; } ?>
    </h2>
<!--    sorting form-->
    <?php if($goal!='add_geo'){
                echo form_open('view_data/select_data/sort_sel_obj/'.$goal);
          }else{
                echo form_open('data_center/ajout_objet/sort_sel_obj/add_geo/'.$latitude.'/'.$longitude);
          }   ?>
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
            <option value="resume" <?php if($this->session->userdata('sel_obj_speAttribute') == 'resume'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('common_obj_resume'); ?>
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
        <?php if($goal=='add_doc'){ ?>
            <input type="hidden" name="ressource_id" value="<?php if($typeRessource=='ressource_texte'){
                                                                    echo $ressource->get_ressource_textuelle_id();
                                                                  } else {
                                                                    $getMethod='get_'.$typeRessource.'_id';
                                                                    echo $ressource->$getMethod(); 
                                                                  } ?>" />
            <input type="hidden" name="typeRessource" value="<?php echo $typeRessource; ?>">
        <?php } ?>
        <?php if($goal=='add_rel' && isset($targetObjet)){ ?>
            <input type="hidden" name="ressource_id" value="<?php echo $targetObjet->get_objet_id(); ?>" />
        <?php } ?>
        <input type="submit" value="<?php echo $this->lang->line('common_list_sort_button'); ?>" />


    </form>

<!--    page navigation-->
<div style="text-align: right;">
    Page : 
    <?php
    if ($goal != 'add_doc' && $goal != 'add_geo' && !isset($targetObjet)) {
        for ($i = 1; $i <= $numPage; $i++) {
            if($i != $currentPage){
                echo anchor('view_data/select_data/select_objet/' . $goal . '/' . $i, $i, array('class'=>'otherPage'));
                echo '&nbsp;';
            }else{
                echo anchor('view_data/select_data/select_objet/' . $goal . '/' . $i, $i, array('class'=>'currentPage'));
                echo '&nbsp;';
            }
        }
    } elseif($goal == 'add_doc') {
        if ($typeRessource == 'ressource_texte') {
            $ressource_id = $ressource->get_ressource_textuelle_id();
        } else {
            $getMethod = 'get_' . $typeRessource . '_id';
            $ressource_id = $ressource->$getMethod();
        }
        for ($i = 1; $i <= $numPage; $i++) {
            if($i != $currentPage){
                echo anchor('view_data/select_data/select_objet/' . $goal . '/' . 
                            $i . '/' . $typeRessource . '/' . $ressource_id, $i, array('class'=>'otherPage'));
                echo '&nbsp;';
            }else{
                echo anchor('view_data/select_data/select_objet/' . $goal . '/' . $i . '/' . 
                            $typeRessource . '/' . $ressource_id, $i, array('class'=>'currentPage'));
                echo '&nbsp;';
            }
        }
    } elseif($goal == 'add_geo'){
        for ($i = 1; $i <= $numPage; $i++) {
            if($i != $currentPage){
                echo anchor('data_center/ajout_objet/select_objet_geo/' . $goal . '/' . $latitude . '/' . $longitude . '/' . $i, $i, array('class'=>'otherPage'));
                echo '&nbsp;';
            }else{
                echo anchor('data_center/ajout_objet/select_objet_geo/' . $goal . '/' . $latitude . '/' . $longitude . '/' . $i, $i, array('class'=>'currentPage'));
                echo '&nbsp;';
            }
        }
    } elseif($goal == 'add_rel' && isset ($targetObjet)){
        for ($i = 1; $i <= $numPage; $i++) {
            if($i != $currentPage){
                echo anchor('view_data/select_data/select_objet/' . $goal . '/' . 
                            $i . '/null/' . $targetObjet->get_objet_id(), $i, array('class'=>'otherPage'));
                echo '&nbsp;';
            }else{
                echo anchor('view_data/select_data/select_objet/' . $goal . '/' . 
                            $i . '/null/' . $targetObjet->get_objet_id(), $i, array('class'=>'currentPage'));
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
                <th><?php echo $this->lang->line('common_obj_resume'); ?></th>
                <th><?php echo $this->lang->line('common_obj_mots_cles'); ?></th>
                <?php if($goal=='view'){ ?>
                            <th><?php echo $this->lang->line('common_list_view'); ?></th>
                <?php }elseif($goal=='add_doc'){ ?>
                            <th><?php echo $this->lang->line('common_list_is_valid'); ?></th>
                            <th><?php echo $this->lang->line('common_list_link_obj_to').$ressource->get_titre();?></th>
                <?php }elseif($goal=='add_rel'){ ?>
                            <th><?php echo $this->lang->line('common_list_is_valid'); ?></th>
                            <th>
                                <?php echo 'Relier';
                                if(isset($targetObjet)){
                                    echo ' à '.$targetObjet->get_nom_objet();
                                }
                            ?>
                            </th>
                <?php }elseif($goal=='add_geo'){ ?>
                            <th><span class="hint"><?php echo $this->lang->line('common_list_is_valid'); ?><span>
                                        Un objet non validé n'apparaîtra sur la carte qu'une fois validé
                                    </span></span></th>
                            <th><?php echo $this->lang->line('common_list_localize'); ?></th>
                <?php } ?>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listObjet as $objet) {        ?>
                <tr>
                    <td><?php echo $objet->get_nom_objet(); ?></td>
                    <td><?php echo $objet->get_username(); ?></td>
                    <td><?php echo $objet->get_resume(); ?></td>
                    <td><?php echo $objet->get_mots_cles(); ?></td>
                    
                    <?php if($goal=='view'){ ?>
                        <td>
                                <?php echo form_open('view_data/view_data') ?>
                                    <input type="hidden" name="data_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                    <input type="hidden" name="type" value="objet" />
                                    <input type="submit" value="<?php echo $this->lang->line('common_list_view_obj'); ?>" />
                                </form>
                        </td>
                   <?php }  elseif ($goal=='add_doc') { ?>
                        <td><?php if($objet->get_validation()=='t'){
                                echo $this->lang->line('common_list_valid');
                              }else{
                                echo $this->lang->line('common_list_unvalid'); 
                                
                              }?>
                        </td>
                        <td>
                             <?php echo form_open('data_center/ajout_documentation/add/'.$typeRessource) ?>
                                <?php if($typeRessource!='ressource_video'){ ?>
                                    <?php echo $this->lang->line('common_add_ress_link_doc'); ?>
                                    <input type="texte" name="page" value="0" pattern="[0-9]*" size="4">
                                <?php } ?>
                                <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                <input type="hidden" name="ressource_id" value="<?php if($typeRessource=='ressource_texte'){
                                                                                        echo $ressource->get_ressource_textuelle_id();
                                                                                      } else {
                                                                                        $getMethod='get_'.$typeRessource.'_id';
                                                                                        echo $ressource->$getMethod(); 
                                                                                      } ?>" />
                                <input type="hidden" name="nom_objet" value="<?php echo $objet->get_nom_objet(); ?>" />
                                <input type="hidden" name="titre_ressource" value="<?php echo $ressource->get_titre(); ?>" />
                                <input type="submit" value="<?php echo $this->lang->line('common_list_do_link'); ?>" />
                            </form>
                        </td>
                   <?php }  elseif ($goal=='add_rel') { ?>
                        <td><?php if($objet->get_validation()=='t'){
                                echo $this->lang->line('common_list_valid');
                              }else{
                                echo $this->lang->line('common_list_unvalid'); 
                                
                              }?>
                        </td>
                        <td>
                             <?php if(!isset($targetObjet)){
                                    echo form_open('view_data/select_data/select_objet/add_rel') ?>
                                    <input type="hidden" name="ressource_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                    <input type="submit" value="<?php echo 'Relier cet objet'; ?>" />
                            <?php  echo form_close();
                             } else {
                                    echo form_open('data_center/ajout_relation/'); ?>
                                    <input type="hidden" name="objet_id_1" value="<?php echo $targetObjet->get_objet_id(); ?>" />
                                    <input type="hidden" name="objet_id_2" value="<?php echo $objet->get_objet_id(); ?>" />
                                    <input type="submit" value="<?php echo 'Relier ces objet'; ?>" />
                                    <?php echo form_close();
                             } ?>
                        </td>
                   <?php }  elseif ($goal=='add_geo') { ?>
                        <td><?php if($objet->get_validation()=='t'){
                                echo $this->lang->line('common_list_valid');
                              }else{
                                echo $this->lang->line('common_list_unvalid'); 
                                
                              }?>
                        </td>
                        <td>
                            <?php echo form_open('data_center/ajout_objet/geometry_form/'.$latitude.'/'.$longitude); ?>
                                 <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                 <input type="submit" value="<?php echo $this->lang->line('common_list_localize'); ?>" />
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
    if ($goal != 'add_doc' && $goal != 'add_geo' && !isset($targetObjet)) {
        for ($i = 1; $i <= $numPage; $i++) {
            if($i != $currentPage){
                echo anchor('view_data/select_data/select_objet/' . $goal . '/' . $i, $i, array('class'=>'otherPage'));
                echo '&nbsp;';
            }else{
                echo anchor('view_data/select_data/select_objet/' . $goal . '/' . $i, $i, array('class'=>'currentPage'));
                echo '&nbsp;';
            }
        }
    } elseif($goal == 'add_doc') {
        if ($typeRessource == 'ressource_texte') {
            $ressource_id = $ressource->get_ressource_textuelle_id();
        } else {
            $getMethod = 'get_' . $typeRessource . '_id';
            $ressource_id = $ressource->$getMethod();
        }
        for ($i = 1; $i <= $numPage; $i++) {
            if($i != $currentPage){
                echo anchor('view_data/select_data/select_objet/' . $goal . '/' . 
                            $i . '/' . $typeRessource . '/' . $ressource_id, $i, array('class'=>'otherPage'));
                echo '&nbsp;';
            }else{
                echo anchor('view_data/select_data/select_objet/' . $goal . '/' . $i . '/' . 
                            $typeRessource . '/' . $ressource_id, $i, array('class'=>'currentPage'));
                echo '&nbsp;';
            }
        }
    } elseif($goal == 'add_geo'){
        for ($i = 1; $i <= $numPage; $i++) {
            if($i != $currentPage){
                echo anchor('data_center/ajout_objet/select_objet_geo/' . $goal . '/' . $latitude . '/' . $longitude . '/' . $i, $i, array('class'=>'otherPage'));
                echo '&nbsp;';
            }else{
                echo anchor('data_center/ajout_objet/select_objet_geo/' . $goal . '/' . $latitude . '/' . $longitude . '/' . $i, $i, array('class'=>'currentPage'));
                echo '&nbsp;';
            }
        }
    } elseif($goal == 'add_rel' && isset ($targetObjet)){
        for ($i = 1; $i <= $numPage; $i++) {
            if($i != $currentPage){
                echo anchor('view_data/select_data/select_objet/' . $goal . '/' . 
                            $i . '/null/' . $targetObjet->get_objet_id(), $i, array('class'=>'otherPage'));
                echo '&nbsp;';
            }else{
                echo anchor('view_data/select_data/select_objet/' . $goal . '/' . 
                            $i . '/null/' . $targetObjet->get_objet_id(), $i, array('class'=>'currentPage'));
                echo '&nbsp;';
            }
        }
    }
    ?>
</div>
    

