

    <p><?php echo anchor('moderation/moderation_center', 'Revenir au centre de modération'); ?></p>
    
    <h1>Selection de données</h1>
    
    <h2>
        Liste des ressources <?php if($typeRessource=='ressource_texte'){echo 'textuelles';} 
                                   if($typeRessource=='ressource_video'){echo 'vidéos';}
                                   if($typeRessource=='ressource_graphique'){echo 'graphiques';}?>
    </h2>
<!--    sorting form-->
    <?php echo form_open('moderation/modify_ressource/sort_sel_ress/'.$typeRessource.'/'.$goal) ?>
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
        <input type="checkbox" name="validation" value="TRUE" <?php if($this->session->userdata('sel_ress_valid') != null){ 
                                          echo 'checked'; 
                                       } ?>>Ressources non validés uniquement
        <br/>
        <input type="submit" value="Trier" />


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
                <th>Ressource</th><th>Créateur</th><th>Auteur(s)</th><th>Référence</th><th>Mots-clés</th><th>Validation</th>
                <?php if($goal=='modify'){ ?>
                    <th>Modifier/Valider</th><th>Supprimer</th>
                <?php } ?>
                <?php if($goal=='documentation'){ ?>
                    <th>Documenter un objet avec cette ressource</th><th>Supprimer un lien de documentation</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listRessource as $ressource) {        ?>
                <tr>
                    <td><?php echo $ressource->get_titre(); ?></td>
                    <td><?php echo $ressource->get_username(); ?></td>
                    <td><?php echo $ressource->get_auteurs(); ?></td>
                    <td><?php echo $ressource->get_reference_ressource(); ?></td>
                    <td><?php echo $ressource->get_mots_cles(); ?></td>
                    <td><?php echo $ressource->get_validation()=='t'?'validé':'non validé'; ?></td>
                    <?php if($goal=='modify'){ ?>
                        <td>
                            <?php echo form_open('moderation/modify_ressource/index/'.$typeRessource.'/modify') ?>
                                <input type="hidden" name="ressource_id" value="<?php if($typeRessource=='ressource_texte'){
                                                                                        echo $ressource->get_ressource_textuelle_id();
                                                                                    } else {
                                                                                        $getMethod='get_'.$typeRessource.'_id';
                                                                                        echo $ressource->$getMethod(); 
                                                                                    } ?>" />
                                <input type="submit" value="Modifier cette ressource" />
                            </form>
                            <?php echo form_open('moderation/modify_ressource/validate_ressource/'.$typeRessource) ?>
                                <input type="hidden" name="ressource_id" value="<?php if($typeRessource=='ressource_texte'){
                                                                                        echo $ressource->get_ressource_textuelle_id();
                                                                                    } else {
                                                                                        $getMethod='get_'.$typeRessource.'_id';
                                                                                        echo $ressource->$getMethod(); 
                                                                                    } ?>" />
                                <input type="submit" value="Valider cette ressource" />
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
                                        Vous vous apprêtez à supprimer définitivement <em><?php echo $ressource->get_titre(); ?></em>,
                                         les informations seront définitivement perdues, êtes vous certain de ne pas plutôt vouloir l'invalider?
                                    </p>
                                    <input type="submit" value="Supprimer cette ressource" />
                                    <button type="reset" class="closePopup">Annuler</button>
                                    <?php echo img(array('src'=>'assets/utils/close.png','alt'=>'fermer','width'=>'4%', 
                                                         'class'=>'removePopup')); ?>
                                </div>
                            </form>
                            <button class="removePopup"> Supprimer cette ressource </button>
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
                                <input type="submit" value="Lier cette ressource" />
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
                                <input type="submit" value="Supprimer une documentation" />
                            </form>
                        </td>
                    <?php } ?>
                </tr>
            <?php }  ?>
        </tbody>
    </table>
    </div>
    
<script src="<?php echo base_url();?>assets/js/removepopup.js"></script>
