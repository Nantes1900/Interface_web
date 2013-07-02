<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

    <p><?php echo anchor('view_data/select_data/index', 'Revenir à la selection de données'); ?></p>
    
    <h1>Selection de données</h1>
    
    <h2>
        Liste des objets 
        <?php if($goal=='add_doc'){ echo ' à relier à la ressource '.$ressource->get_titre(); } ?>
    </h2>
<!--    sorting form-->
    <?php if($goal!='addgeo'){
                echo form_open('view_data/select_data/index/objet/'.$goal);
          }else{
                echo form_open('data_center/ajout_objet/select_objet_geo/add_geo/'.$latitude.'/'.$longitude);
          }   ?>
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
    
</html>
