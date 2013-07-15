

    <p><?php echo anchor('view_data/select_data/index', 'Revenir à la selection de données'); ?></p>
    
    <h1>Selection de données</h1>
    
    <h2>
        Liste des objets 
        <?php if($goal=='add_doc'){ echo ' à relier à la ressource '.$ressource->get_titre(); } ?>
        <?php if($goal=='add_geo'){ echo ' à relier à la coordonnée sélectionnée '; } ?>
    </h2>
<!--    sorting form-->
    <?php if($goal!='add_geo'){
                echo form_open('view_data/select_data/sort_sel_obj/'.$goal);
          }else{
                echo form_open('data_center/ajout_objet/sort_sel_obj/add_geo/'.$latitude.'/'.$longitude);
          }   ?>
        <label for="orderBy">Trier par:</label>
        <select name="orderBy" id="orderBy">
            <option value="nom_objet" <?php if($this->session->userdata('sel_obj_orderBy') == 'nom_objet'){ 
                                                echo 'selected'; 
                                            } ?>>
                Nom de l'objet
            </option>
            <option value="username" <?php if($this->session->userdata('sel_obj_orderBy') == 'username'){ 
                                                echo 'selected'; 
                                            } ?>>
                Pseudo du créateur
            </option>
            <option value="date_creation" <?php if($this->session->userdata('sel_obj_orderBy') == 'date_creation'){ 
                                                echo 'selected'; 
                                            } ?>>
                Date d'ajout de l'objet
            </option>
        </select>
        <select name="orderDirection">
            <option value="asc" <?php if($this->session->userdata('sel_obj_orderDirection') == 'asc'){ 
                                          echo 'selected'; 
                                      } ?>>
                Croissant
            </option>
            <option value="desc" <?php if($this->session->userdata('sel_obj_orderDirection') == 'desc'){ 
                                          echo 'selected'; 
                                       } ?>>
                Décroissant
            </option>
        </select>
        <br/>
        <label for="speAttribute">Rechercher un(e):</label>
        <select name="speAttribute" id="speAttribute">
            <option value="nom_objet" <?php if($this->session->userdata('sel_obj_speAttribute') == 'nom_objet'){ 
                                          echo 'selected'; 
                                       } ?>>
                Nom de l'objet
            </option>
            <option value="username" <?php if($this->session->userdata('sel_obj_speAttribute') == 'username'){ 
                                          echo 'selected'; 
                                       } ?>>
                Pseudo du créateur
            </option>
            <option value="mots_cles" <?php if($this->session->userdata('sel_obj_speAttribute') == 'mots_cles'){ 
                                          echo 'selected'; 
                                       } ?>>
                Mot-clé
            </option>
            <option value="resume" <?php if($this->session->userdata('sel_obj_speAttribute') == 'resume'){ 
                                          echo 'selected'; 
                                       } ?>>
                Résumé
            </option>
            <option value="historique" <?php if($this->session->userdata('sel_obj_speAttribute') == 'historique'){ 
                                          echo 'selected'; 
                                       } ?>>
                Historique
            </option>
            <option value="description" <?php if($this->session->userdata('sel_obj_speAttribute') == 'description'){ 
                                          echo 'selected'; 
                                       } ?>>
                Description
            </option>
            <option value="adresse_postale" <?php if($this->session->userdata('sel_obj_speAttribute') == 'adresse_postale'){ 
                                          echo 'selected'; 
                                       } ?>>
                Adresse
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
        <input type="submit" value="Trier" />


    </form>

<!--    page navigation-->
<div style="text-align: right;">
    Page : 
    <?php
    if ($goal != 'add_doc' && $goal != 'add_geo') {
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
    }
    ?>
</div>
<br>
<!--    list of objets-->

    <div class="classyTable">
    <table>
        <thead>
            <tr>
                <th>Objet</th><th>Créateur</th><th>Résumé</th><th>Mots-clés</th>
                <?php if($goal=='view'){ ?>
                            <th>Visualiser</th>
                <?php }elseif($goal=='add_doc'){ ?>
                            <th>Validation</th>
                            <th>Lier cet objet à <?php echo $ressource->get_titre();?></th>
                <?php }elseif($goal=='add_geo'){ ?>
                            <th>Localiser l'objet</th>
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
                                    <input type="submit" value="Voir cet objet" />
                                </form>
                        </td>
                   <?php }  elseif ($goal=='add_doc') { ?>
                        <td><?php echo $objet->get_validation()=='t'?'validé':'non validé'; ?></td>
                        <td>
                             <?php echo form_open('data_center/ajout_documentation/add/'.$typeRessource) ?>
                                <?php if($typeRessource!='ressource_video'){ ?>
                                    Lier la page :<input type="texte" name="page" value="0" pattern="[0-9]*" size="4">
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
                                <input type="submit" value="Relier" />
                            </form>
                        </td>
                   <?php }  elseif ($goal=='add_geo') { ?>
                        <td>
                            <?php echo form_open('data_center/ajout_objet/geometry_form/'.$latitude.'/'.$longitude); ?>
                                 <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                 <input type="submit" value="Localiser à l'endroit sélectionné" />
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
    if ($goal != 'add_doc' && $goal != 'add_geo') {
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
    }
    ?>
</div>
    

