
    <p><?php echo anchor('moderation/moderation_center', 'Revenir au centre de modération'); ?></p>
    
    <h1>Selection de données</h1>
    
    <h2>Liste des objets <?php if($goal=='add_relation'){ echo 'à lier à '.$objetSource->get_nom_objet();}
                                if($goal=='add_doc'){ echo 'à lier à la ressource '.$ressource->get_titre(); } ?></h2>
<!--    sorting form-->
    <?php if($goal=='modify' || $goal=='relation'){
              echo form_open('moderation/modify_objet/index/'.$goal);
          }elseif($goal=='add_relation'){
              $objet_id = $objetSource->get_objet_id();
              echo form_open('moderation/modify_objet/select_objet/'.$goal.'/'.$objet_id);
          }elseif($goal = 'add_doc'){
              if($typeRessource=='ressource_texte'){
                  $ressource_id = $ressource->get_ressource_textuelle_id();
              } else {
                  $getMethod='get_'.$typeRessource.'_id';
                  $ressource_id = $ressource->$getMethod(); 
              }
              echo form_open('moderation/modify_ressource/select_objet/add_doc/'.$ressource_id.'/'.$typeRessource);
          }         
    ?>
        <label for="orderBy">Trier par:</label>
        <select name="orderBy" id="orderBy">
            <option value="nom_objet">Nom de l'objet</option>
            <option value="username">Pseudo du créateur</option>
            <option value="date_creation">Date d'ajout de l'objet</option>
        </select>
        <select name="orderDirection">
            <option value="asc">Croissant</option>
            <option value="desc">Décroissant</option>
        </select>
        <br/>
        <label for="speAttribute">Rechercher un(e):</label>
        <select name="speAttribute" id="speAttribute">
            <option value="nom_objet">Nom de l'objet</option>
            <option value="username">Pseudo du créateur</option>
            <option value="mots_cles">Mot-clé</option>
            <option value="resume">Résumé</option>
            <option value="historique">Historique</option>
            <option value="description">Description</option>
            <option value="adresse_postale">Adresse</option>
        </select>
        <input type="text" name="speAttributeValue" maxlength="50"/>
        <br/>
        <input type="checkbox" name="validation" value="TRUE">Objets non validés uniquement
        <br/>
        <input type="submit" value="Trier" />


    </form>

<!--    list of objets-->

    <div class="classyTable">
    <table>
        <thead>
            <tr>
                <th>Objet</th><th>Créateur</th><th>Résumé</th><th>Mots-clés</th><th>Validation</th>
                <?php if($goal=='modify'){ ?>
                    <th>Modifier/Valider</th><th>Supprimer</th>
                <?php } ?>
                <?php if($goal=='relation'){ ?>
                    <th>Créer une relation avec un objet</th><th>Supprimer une relation</th>
                <?php } ?>
                <?php if($goal=='add_relation'){ ?>
                    <th>Lier à cet objet à <?php echo $objetSource->get_nom_objet();?></th>
                <?php } ?>
                <?php if($goal=='add_doc'){ ?>
                    <th>Lier à cet objet à <?php echo $ressource->get_titre();?></th>
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
                    <td><?php echo $objet->get_validation()=='t'?'validé':'non validé'; ?></td>
                    <?php if($goal=='modify'){ ?>
                        <td>
                            <?php echo form_open('moderation/modify_objet/index/'.$goal) ?>
                                <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                <input type="submit" value="Modifier cet objet" />
                            </form>
                            <?php echo form_open('moderation/modify_objet/validate') ?>
                                <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                <input type="submit" value="Valider cet objet" />
                            </form>
                        </td>
                        <td>
                            <?php echo form_open('moderation/modify_objet/delete_objet') ?>
                                <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                
                                <div class="message" style="left:15%; top:40%; display:none">
                                    <p>
                                        Vous vous apprêtez à supprimer définitivement <?php echo $objet->get_nom_objet(); ?>,
                                         les informations seront définitivement perdues, êtes vous certain de ne pas plutôt vouloir l'invalider?
                                    </p>
                                    <input type="submit" value="Supprimer cet objet" />
                                    <?php echo img(array('src'=>'assets/utils/close.png','alt'=>'fermer','width'=>'4%', 
                                                         'class'=>'removePopup')); ?>
                                </div>
                            </form>
                            <button class="removePopup"> Supprimer cet objet </button>
                        </td>
                    <?php } ?>
                    <?php if($goal=='relation'){ ?>
                        <td>
                            <?php echo form_open('moderation/modify_objet/add_relation') ?>
                                <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                <input type="submit" value="Ajouter une relation" />
                            </form>
                        </td>
                        <td>
                            <?php echo form_open('moderation/modify_objet/delete_relation') ?>
                                <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                <input type="submit" value="Supprimer une relation" />
                            </form>
                        </td>
                    <?php } ?>
                    <?php if($goal=='add_relation'){ ?>
                        <td>
                            <?php echo form_open('moderation/modify_objet/add_relation_form') ?>
                                <input type="hidden" name="objet1_id" value="<?php echo $objetSource->get_objet_id(); ?>" />
                                <input type="hidden" name="objet2_id" value="<?php echo $objet->get_objet_id(); ?>" />
                                <input type="submit" value="Relier" />
                            </form>
                        </td>
                    <?php } ?>
                    <?php if($goal=='add_doc'){ ?>
                        <td>
                            <?php echo form_open('moderation/modify_ressource/add_doc_form/'.$typeRessource) ?>
                                <?php if($typeRessource!='ressource_video'){ ?>
                                    Lier la page :<input type="texte" name="page" value="0" pattern="[0-9]*" size="4">
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
                                <input type="submit" value="Relier" />
                            </form>
                        </td>
                    <?php } ?>
                </tr>
            <?php }  ?>
        </tbody>
    </table>
    </div>
    

<script src="<?php echo base_url();?>assets/js/removepopup.js"></script>