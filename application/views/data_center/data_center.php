<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

	<h1>Ajout de données</h1>
        <p>Vous souhaitez ajouter à la base :</p>
        <div class='menu'>
            <ul id='navigation'>
                <?php if ( $this->session->userdata('user_level') >= 4 ) {?>
                    <li><?php echo anchor('data_center/ajout_objet', 'Un objet historique'); ?></li>
                    <li><?php echo anchor('data_center/ajout_relation', 'Une relation entre deux objets historiques'); ?></li>
                    <li><?php echo anchor('data_center/import_csv', 'Plusieurs éléments à partir d\'un fichier CSV'); ?></li>
                <?php } ?>
                <li>
                    <?php echo anchor('data_center/ajout_ressource', 'Une ressource :'); ?>
                    <ul>
                        <li><?php echo anchor('data_center/ajout_ressource/formulaire_image', 'graphique (photo, image...)'); ?></li>
                        <li><?php echo anchor('data_center/ajout_ressource/formulaire_video', 'vidéo (film, clip...)'); ?></li>
                        <li><?php echo anchor('data_center/ajout_ressource/formulaire_texte', 'textuelle (livre, lettre,...)'); ?></li>
                    </ul>
                </li>
            </ul>
        </div>
</html>