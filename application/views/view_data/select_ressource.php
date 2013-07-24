
<p><?php echo anchor('view_data/select_data/index', $this->lang->line('common_view_go_back_link')); ?></p>

<h1><?php echo $this->lang->line('common_select_data'); ?></h1>

<h2>
    <?php if($typeRessource=='ressource_texte'){echo $this->lang->line('common_list_ress_txt');} 
          if($typeRessource=='ressource_video'){echo $this->lang->line('common_list_ress_img');}
          if($typeRessource=='ressource_graphique'){echo $this->lang->line('common_list_ress_vid');}?>
</h2>
<!--    sorting form-->
<?php echo form_open('view_data/select_data/sort_sel_ress/' . $typeRessource . '/' . $goal) ?>
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
<input type="submit" value="<?php echo $this->lang->line('common_list_sort_button'); ?>" />


</form>

<!--    page navigation-->
<div style="text-align: right;">
    Page : 
    <?php
        for ($i = 1; $i <= $numPage; $i++) {
            if ($i != $currentPage) {
                echo anchor('view_data/select_data/select_ressource/' . $typeRessource . '/' . $goal . '/' . $i, $i, array('class' => 'otherPage'));
                echo '&nbsp;';
            } else {
                echo anchor('view_data/select_data/select_ressource/' . $typeRessource . '/' . $goal . '/' . $i, $i, array('class' => 'currentPage'));
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
                <?php if($goal=='view'){ ?>
                    <th><?php echo $this->lang->line('common_list_view'); ?></th>
                <?php } ?>
                <?php if($goal=='add_doc'){ ?>
                    <th><?php echo $this->lang->line('common_list_is_valid'); ?></th>
                    <th><?php echo $this->lang->line('common_list_add_doc'); ?></th>
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
                    <?php if($goal=='view'){ ?>
                        <td>
                            <?php echo form_open('view_data/view_data') ?>
                                <input type="hidden" name="data_id" value="<?php if($typeRessource=='ressource_texte'){
                                                                                        echo $ressource->get_ressource_textuelle_id();
                                                                                    } else {
                                                                                        $getMethod='get_'.$typeRessource.'_id';
                                                                                        echo $ressource->$getMethod(); 
                                                                                    } ?>" />
                                <input type="hidden" name="type" value="<?php echo $typeRessource; ?>">
                                <input type="submit" value="<?php echo $this->lang->line('common_list_view_ress'); ?>" />
                            </form>
                            
                    <?php } ?>
                    <?php if($goal=='add_doc'){ ?>
                        <td><?php if($ressource->get_validation()=='t'){
                                echo $this->lang->line('common_list_valid');
                              }else{
                                echo $this->lang->line('common_list_unvalid');
                              } ?>
                        </td>
                        <td>
                            <?php echo form_open('view_data/select_data/select_objet/add_doc') ?>
                                <input type="hidden" name="ressource_id" value="<?php if($typeRessource=='ressource_texte'){
                                                                                        echo $ressource->get_ressource_textuelle_id();
                                                                                    } else {
                                                                                        $getMethod='get_'.$typeRessource.'_id';
                                                                                        echo $ressource->$getMethod(); 
                                                                                    } ?>" />
                                <input type="hidden" name="typeRessource" value="<?php echo $typeRessource; ?>">
                                <input type="submit" value="<?php echo $this->lang->line('common_list_link_ress'); ?>" />
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
            if ($i != $currentPage) {
                echo anchor('view_data/select_data/select_ressource/' . $typeRessource . '/' . $goal . '/' . $i, $i, array('class' => 'otherPage'));
                echo '&nbsp;';
            } else {
                echo anchor('view_data/select_data/select_ressource/' . $typeRessource . '/' . $goal . '/' . $i, $i, array('class' => 'currentPage'));
                echo '&nbsp;';
            }
        }
    ?>
</div>