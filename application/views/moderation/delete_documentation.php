

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
                            <div class="message" style="left:15%; top:40%; display:none">
                                <p>
                                    Vous vous apprêtez à supprimer définitivement la documentation de <em><?php echo $ressource->get_titre(); ?></em>
                                     à <em><?php echo $objet['nom_objet']; ?></em> les informations de lien documentaire seront perdues, 
                                     êtes vous certain de bien vouloir faire cela?
                                </p>
                                <input type="submit" value="Supprimer la relation" />
                                <button type="reset" class="closePopup">Annuler</button>
                                <?php echo img(array('src'=>'assets/utils/close.png','alt'=>'fermer','width'=>'4%', 
                                                         'class'=>'removePopup')); ?>
                            </div>
                        </form>
                        <button class="removePopup"> Supprimer cette documentation</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    
<script src="<?php echo base_url();?>assets/js/removepopup.js"></script>