
<p><?php echo anchor('view_data/select_data/index', 'Revenir à la selection de données'); ?></p>

<h1>Selection de données</h1>

<h2>
    Liste des ressources <?php
    if ($typeRessource == 'ressource_texte') {
        echo 'textuelles';
    }
    if ($typeRessource == 'ressource_video') {
        echo 'vidéos';
    }
    if ($typeRessource == 'ressource_graphique') {
        echo 'graphiques';
    }
    ?>
</h2>
<!--    sorting form-->
<?php echo form_open('view_data/select_data/sort_sel_ress/' . $typeRessource . '/' . $goal) ?>
<label for="orderBy">Trier par:</label>
<select name="orderBy" id="orderBy">
    <option value="titre" <?php if($this->session->userdata('sel_ress_orderBy') == 'titre'){ 
                                    echo 'selected'; 
                          } ?>>
        Titre de la ressource
    </option>
    <option value="username" <?php if($this->session->userdata('sel_ress_orderBy') == 'username'){ 
                                    echo 'selected'; 
                          } ?>>
        Pseudo du créateur
    </option>
    <option value="theme_ressource" <?php if($this->session->userdata('sel_ress_orderBy') == 'theme_ressource'){ 
                                        echo 'selected'; 
                                    } ?>>
        Thème de la ressource
    </option>
    <option value="date_debut_ressource" <?php if($this->session->userdata('sel_ress_orderBy') == 'date_debut_ressource'){ 
                                                echo 'selected'; 
                                         } ?>>
        Date de la ressource
    </option>
    <option value="date_creation" <?php if($this->session->userdata('sel_ress_orderBy') == 'date_creation'){ 
                                        echo 'selected'; 
                                  } ?>>
        Date d'ajout de la ressource
    </option>
</select>
<select name="orderDirection">
    <option value="asc" <?php if($this->session->userdata('sel_ress_orderDirection') == 'asc'){ 
                                echo 'selected'; 
                         } ?>>
        Croissant
    </option>
    <option value="desc" <?php if($this->session->userdata('sel_ress_orderDirection') == 'desc'){ 
                                echo 'selected'; 
                         } ?>>
        Décroissant
    </option>
</select>
<br/>
<label for="speAttribute">Rechercher un(e):</label>
<select name="speAttribute" id="speAttribute">
    <option value="titre" <?php if($this->session->userdata('sel_ress_speAttribute') == 'titre'){ 
                                    echo 'selected'; 
                                } ?>>
        Titre de la ressource
    </option>
    <option value="username" <?php if($this->session->userdata('sel_ress_speAttribute') == 'username'){ 
                                        echo 'selected'; 
                                   } ?>>
        Pseudo du créateur
    </option>
    <option value="theme_ressource" <?php if($this->session->userdata('sel_ress_speAttribute') == 'theme_ressource'){ 
                                        echo 'selected'; 
                                    } ?>>
        Thème de la ressource
    </option>
    <option value="reference" <?php if($this->session->userdata('sel_ress_speAttribute') == 'reference'){ 
                                        echo 'selected'; 
                                    } ?>>
        Référence de la ressource
    </option>
    <option value="mots_cles" <?php if($this->session->userdata('sel_ress_speAttribute') == 'mots_cles'){ 
                                        echo 'selected'; 
                                    } ?>>
        Mot-clé
    </option>
    <option value="description" <?php if($this->session->userdata('sel_ress_speAttribute') == 'description'){ 
                                            echo 'selected'; 
                                      } ?>>
        Description
    </option>
    <option value="auteur" <?php if($this->session->userdata('sel_ress_speAttribute') == 'auteur'){ 
                                        echo 'selected'; 
                                 } ?>>
        Auteur
    </option>
    <option value="editeur" <?php if($this->session->userdata('sel_ress_speAttribute') == 'editeur'){ 
                                        echo 'selected'; 
                                  } ?>>
        Editeur
    </option>
</select>
<input type="text" name="speAttributeValue" maxlength="50" 
       value="<?php if($this->session->userdata('sel_ress_speAttributeValue') != null){ 
                        echo $this->session->userdata('sel_ress_speAttributeValue'); 
                    } ?>" />
<br/>
<input type="submit" value="Trier" />


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
                <th>Ressource</th><th>Auteur(s)</th><th>Thème</th><th>Référence</th><th>Mots-clés</th>
                <?php if($goal=='view'){ ?>
                    <th>Visualiser</th>
                <?php } ?>
                <?php if($goal=='add_doc'){ ?>
                    <th>Validation</th>
                    <th>Documenter un objet avec cette ressource</th>
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
                                <input type="submit" value="Voir cette ressource" />
                            </form>
                            
                    <?php } ?>
                    <?php if($goal=='add_doc'){ ?>
                        <td><?php echo $ressource->get_validation()=='t'?'validé':'non validé'; ?></td>
                        <td>
                            <?php echo form_open('view_data/select_data/select_objet/add_doc') ?>
                                <input type="hidden" name="ressource_id" value="<?php if($typeRessource=='ressource_texte'){
                                                                                        echo $ressource->get_ressource_textuelle_id();
                                                                                    } else {
                                                                                        $getMethod='get_'.$typeRessource.'_id';
                                                                                        echo $ressource->$getMethod(); 
                                                                                    } ?>" />
                                <input type="hidden" name="typeRessource" value="<?php echo $typeRessource; ?>">
                                <input type="submit" value="Lier cette ressource" />
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