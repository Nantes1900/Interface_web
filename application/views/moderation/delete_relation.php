<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

    <p><?php echo anchor('moderation/moderation_center', 'Revenir au centre de modération'); ?></p>
    
    <h1>Suppression de relation</h1>
    
    <h2>Liste des objets liés à <?php echo $objet->get_nom_objet(); ?></h2>
    
    <div class="classyTable">
    <table>
        <thead>
            <tr>
                <th>Nom de l'objet lié</th><th>créateur de la relation</th><th>Type de relation</th><th>Dates</th><th>Résumé de l'objet</th>
                <th>Supprimer relation</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($linkedObjetArray as $objetArray){ ?>
                <tr>
                    <td><?php echo $objetArray['nom_objet']; ?></td>
                    <td><?php echo $objetArray['username']; ?></td>
                    <td><?php echo $objetArray['type_relation']; ?></td>
                    <td><?php echo 'du '.to_date_dmy($objetArray['date_debut_relation']).' au '.to_date_dmy($objetArray['date_fin_relation']); ?></td>
                    <td><?php echo $objetArray['resume']; ?></td>
                    <td>
                        <?php echo form_open('moderation/modify_objet/delete_relation_form'); ?>
                            <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                            <input type="hidden" name="relation_id" value="<?php echo $objetArray['relation_id']; ?>" />
                            <input type="submit" value="Supprimer la relation" />
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    
</html>