<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

    <p><?php echo anchor('view_data/select_data/index', 'Revenir à la selection de données'); ?></p>
    
    <h1>Selection de données</h1>
    
    <h2>
        Liste des ressources <?php if($typeRessource=='ressource_texte'){echo 'textuelles';} 
                                   if($typeRessource=='ressource_video'){echo 'vidéos';}
                                   if($typeRessource=='ressource_graphique'){echo 'graphiques';}?>
    </h2>
<!--    sorting form-->
    <?php echo form_open('view_data/select_data/index/'.$typeRessource.'/'.$goal) ?>
        <label for="orderBy">Trier par:</label>
        <select name="orderBy" id="orderBy">
            <option value="titre">Titre de la ressource</option>
            <option value="username">Pseudo du créateur</option>
            <option value="date_debut_ressource">Date de la ressource</option>
            <option value="date_creation">Date d'ajout de la ressource</option>
        </select>
        <select name="orderDirection">
            <option value="asc">Croissant</option>
            <option value="desc">Décroissant</option>
        </select>
        <br/>
        <label for="speAttribute">Rechercher un(e):</label>
        <select name="speAttribute" id="speAttribute">
            <option value="titre">Titre de la ressource</option>
            <option value="username">Pseudo du créateur</option>
            <option value="reference">Référence de la ressource</option>
            <option value="mots_cles">Mot-clé</option>
            <option value="description">Description</option>
            <option value="auteur">Auteur</option>
            <option value="editeur">Editeur</option>
        </select>
        <input type="text" name="speAttributeValue" maxlength="50"/>
        <br/>
        <input type="submit" value="Trier" />


    </form>

<!--    list of ressources-->

    <div class="classyTable">
    <table>
        <thead>
            <tr>
                <th>Ressource</th><th>Créateur</th><th>Auteur(s)</th><th>Référence</th><th>Mots-clés</th>
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
                    <td><?php echo $ressource->get_username(); ?></td>
                    <td><?php echo $ressource->get_auteurs(); ?></td>
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
    
</html>
