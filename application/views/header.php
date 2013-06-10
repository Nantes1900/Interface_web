<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 
    
<head>

   	<title>Projet Nantes 1900 - Rework</title>
   	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    	<meta name="robots" content="index,follow"/>
        <meta name="keywords" content="château_des_ducs_de_bretagne, nantes, 1900, projet, maquette, port, chateau, numerisation, exposition, graphisme, conferences, publicitaire, " />
	<meta name="description" content="Site officiel. A travers la maquette du port de Nantes découvrez le projet Nantes 1900" />
	
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo css_url('style'); ?>" />
	<div class=banniere></div>
	<p><?php echo anchor('accueil', 'Revenir à la page d&rsquo;accueil'); ?></p>


</head>
    
<body>
    <?php if($this->session->userdata('username')){ ?>
    <div class='leftSidebar'>

        <h2>Menu</h2>
        <ul id='navigation'>
            <li>
                <?php echo img(array('src'=>'assets/utils/go-home.png','width'=>'8%')); ?>
                <?php echo anchor('accueil', 'Accueil'); ?>
            </li>
            <li>
                <?php echo img(array('src'=>'assets/utils/db_add.png','width'=>'8%')); ?>
                <?php echo anchor('data_center/data_center', 'Ajout de données'); ?>
                <ul>
                    <?php if($this->session->userdata('user_level') == 4 || $this->session->userdata('user_level') == 5){ ?>
                            <li><?php echo anchor('data_center/ajout_objet', 'un objet historique'); ?></li>
                            <li><?php echo anchor('data_center/ajout_relation', 'un relation entre deux objets historiques'); ?></li>
                            <li><?php echo anchor('data_center/import_csv', 'plusieurs éléments à partir d\'un fichier CSV'); ?></li>
                    <?php } ?>
                    <li><?php echo anchor('data_center/ajout_ressource', 'une ressource'); ?></li>
                </ul>
            </li>
            <?php if($this->session->userdata('user_level') == 4) { ?>
                    <li>
                        <?php echo img(array('src'=>'assets/utils/db_update.png','width'=>'8%')); ?>
                        <?php echo anchor('moderation/moderation_center', 'Modération de données');?>
                        <ul>
                            <li><?php echo anchor('moderation/modify_objet/index/modify', 'Modifier un objet historique'); ?></li>
                            <li><?php echo anchor('moderation/modify_objet/index/relation', 'Relier des objets'); ?></li>
                            <li><?php echo anchor('moderation/modify_ressource/index/ressource_texte/modify', 'Modifier une ressource textuelle'); ?></li>
                            <li><?php echo anchor('moderation/modify_ressource/index/ressource_texte/documentation', 'Documenter (texte) un objet'); ?></li>
                            <li><?php echo anchor('moderation/modify_ressource/index/ressource_graphique/modify', 'Modifier une ressource graphique'); ?></li>
                            <li><?php echo anchor('moderation/modify_ressource/index/ressource_graphique/documentation', 'Documenter (image) un objet'); ?></li>
                            <li><?php echo anchor('moderation/modify_ressource/index/ressource_video/modify', 'Modifier une ressource video'); ?></li>
                            <li><?php echo anchor('moderation/modify_ressource/index/ressource_video/documentation', 'Documenter (video) un objet'); ?></li>
                        </ul>
                    </li>
            <?php } ?>
            <li>
                <?php echo img(array('src'=>'assets/utils/zoom-2.png','width'=>'8%')); ?>
                <?php echo anchor('view_data/select_data', 'Visualisation de données'); ?>
            </li>
            <li>
                <?php echo img(array('src'=>'assets/utils/edit-user.png','width'=>'8%')); ?>
                <?php echo anchor('profile_panel/profile_panel', 'Consulter profil personnel'); ?>
            </li>
            <?php if($this->session->userdata('user_level') == 9) { ?>
                    <li>
                        <?php echo img(array('src'=>'assets/utils/edit-group.png','width'=>'8%')); ?>
                        <?php echo anchor('admin_panel/admin_panel', 'Centre d\'administration');?>
                    </li>
            <?php } ?>
            <li>
                <?php echo img(array('src'=>'assets/utils/system-logout.png','width'=>'8%')); ?>
                <?php echo anchor('accueil/login/logout', 'D&eacute;connexion'); ?>
            </li>
        </ul>
    </div>
    <?php } ?>
</html>

