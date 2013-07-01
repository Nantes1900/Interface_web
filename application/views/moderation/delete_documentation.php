<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

    <p><?php echo anchor('moderation/moderation_center', 'Revenir au centre de modération'); ?></p>
    
    <h1>Suppression d'un lien de documentation</h1>
    
    <h2>Liste des objets liés à <?php echo $ressource->get_titre(); ?></h2>
    
    <div class="classyTable">
    <table>
        <thead>
            <tr>
                <th>Nom de l'objet lié</th><th>créateur de l'objet</th><th>Resumé de l'objet</th>
                <th>Supprimer relation</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($documentationArray as $objet){ ?>
                <tr>
                    <td><?php echo $objet['nom_objet']; ?></td>
                    <td><?php echo $objet['username']; ?></td>
                    <td><?php echo $objet['resume']; ?></td>
                    <td>
                        <?php echo form_open('moderation/modify_ressource/delete_documentation/'.$typeRessource); ?>
                            <input type="hidden" name="ressource_id" value="<?php if($typeRessource=='ressource_texte'){
                                                                                        echo $ressource->get_ressource_textuelle_id();
                                                                                    } else {
                                                                                        $getMethod='get_'.$typeRessource.'_id';
                                                                                        echo $ressource->$getMethod(); 
                                                                                    } ?>" />
                            <input type="hidden" name="documentation_id" value="<?php echo $objet['documentation_id']; ?>" />
                            <input type="hidden" name="nom_objet" value="<?php echo $objet['nom_objet']; ?>" />
                            <input type="hidden" name="ressource_titre" value="<?php echo $ressource->get_titre(); ?>" />
                            <input type="submit" value="Supprimer la relation" />
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    
</html>