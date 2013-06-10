<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

	<h1>Modération de données</h1>
        
        <p>Vous souhaitez :</p>
        <div class='menu'>
            <ul id='navigation'>
                <li><?php echo anchor('moderation/modify_objet/index/modify', 'Modifier, valider ou supprimer un objet historique'); ?></li>
            
                <li><?php echo anchor('moderation/modify_objet/index/relation', 'Gérer les relations entre objet historique'); ?></li>
            
                <li><?php echo anchor('moderation/modify_ressource/index/ressource_texte/modify', 'Modifier, valider ou supprimer une ressource textuelle'); ?></tli>
            
                <li><?php echo anchor('moderation/modify_ressource/index/ressource_texte/documentation', 'Gérer la documentation textuelle vers un objet historique'); ?></li>
            
                <li><?php echo anchor('moderation/modify_ressource/index/ressource_graphique/modify', 'Modifier, valider ou supprimer une ressource graphique'); ?></li>
            
                <li><?php echo anchor('moderation/modify_ressource/index/ressource_graphique/documentation', 'Gérer la documentation graphique vers un objet historique'); ?></li>
            
                <li><?php echo anchor('moderation/modify_ressource/index/ressource_video/modify', 'Modifier, valider ou supprimer une ressource video'); ?></li>
            
                <li><?php echo anchor('moderation/modify_ressource/index/ressource_video/documentation', 'Gérer la documentation video vers un objet historique'); ?></li>
            </ul>
        </div>

</html>