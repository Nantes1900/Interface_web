<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

	<h1>Data Center</h1>
        
        <table>
            <tr><td>Vous souhaitez ajouter à la base :</td></tr>
            <tr><td><?php echo anchor('data_center/ajout_objet', 'un objet historique'); ?></td></tr>
            <tr><td><?php echo anchor('data_center/ajout_relation', 'un relation entre deux objets historiques'); ?></td></tr>
            <tr><td><?php echo anchor('data_center/ajout_ressource', 'une ressource'); ?></td></tr>
            <tr><td><?php echo anchor('data_center/import_csv', 'plusieurs éléments à partir d\'un fichier CSV'); ?></td></tr>
        </table>
	

</html>