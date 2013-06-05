<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

	<h1>Modération de données</h1>
        
        <table>
            <tr><td>Vous souhaitez :</td></tr>
           
            <tr><td><?php echo anchor('moderation/modify_objet', 'modifier et/ou valider un objet historique'); ?></td></tr>
            
            <tr><td><?php echo anchor('moderation/modify_ressource/index/ressource_texte', 'modifier et/ou valider une ressource textuelle'); ?></td></tr>
            
            <tr><td><?php echo anchor('moderation/modify_ressource/index/ressource_graphique', 'modifier et/ou valider une ressource graphique'); ?></td></tr>
            
            <tr><td><?php echo anchor('moderation/modify_ressource/index/ressource_video', 'modifier et/ou valider une ressource video'); ?></td></tr>
        </table>
	

</html>