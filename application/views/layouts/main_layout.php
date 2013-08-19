<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

    <head>

        <title><?php echo $title;?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset;?>" />
        <meta name="robots" content="index,follow"/>
        <meta name="keywords" content="château_des_ducs_de_bretagne, nantes, 1900, projet, maquette, port, chateau, numerisation, exposition, graphisme, conferences, publicitaire, " />
        <meta name="description" content="Site officiel. A travers la maquette du port de Nantes découvrez le projet Nantes 1900" />

        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/utils/ACL.jpg' ?>">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo css_url('style'); ?>" />
        
        <?php foreach ($css as $url): ?>
            <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url; ?>" />
        <?php endforeach; ?>

        <div class=banniere></div>
        <p><?php echo anchor('accueil', $this->lang->line('common_welcome_page_link')); ?></p>

    </head>
    
    <body>
    <?php if($this->session->userdata('username')){ ?>
        <div class='leftSidebar'>

            <h2>Menu</h2>
            <ul class='navigation'>
                <li>
                    <?php echo img(array('src'=>'assets/utils/go-home.png','width'=>'8%')); ?>
                    <?php echo anchor('accueil', $this->lang->line('common_lsidebar_welcome')); ?>
                </li>
                <li>
                    <?php echo img(array('src'=>'assets/utils/db_add.png','width'=>'8%')); ?>
                    <span class="cursorPointer"><?php echo $this->lang->line('common_lsidebar_addData'); ?></span>
                    <ul>
                        <?php if($this->session->userdata('user_level') >= 4){ ?>
                                <li><?php echo anchor('data_center/ajout_objet', $this->lang->line('common_lsidebar_objet')); ?></li>
                                <li><?php echo anchor('data_center/ajout_relation', $this->lang->line('common_lsidebar_relation')); ?></li>
                                <li><?php echo anchor('data_center/import_csv', $this->lang->line('common_lsidebar_csvImport')); ?></li>
                        <?php } ?>
                        <li><?php echo anchor('data_center/ajout_ressource', $this->lang->line('common_ressource')); ?></li>
                        <li><?php echo anchor('data_center/ajout_documentation', $this->lang->line('common_documentation')); ?></li>
                    </ul>
                </li>
                <?php if($this->session->userdata('user_level') >= 5) { ?>
                        <li>
                            <?php echo img(array('src'=>'assets/utils/db_update.png','width'=>'8%')); ?>
                            <span class="cursorPointer"><?php echo $this->lang->line('common_lsidebar_moderation');?></span>
                            <ul>
                                <li><?php echo anchor('moderation/modify_objet/index/modify', $this->lang->line('common_lsidebar_mod_objet')); ?></li>
                                <li><?php echo anchor('moderation/modify_objet/index/relation', $this->lang->line('common_lsidebar_mod_relation')); ?></li>
                                <li><?php echo anchor('moderation/modify_ressource/index/ressource_texte/modify', $this->lang->line('common_lsidebar_mod_ressTxt')); ?></li>
                                <li><?php echo anchor('moderation/modify_ressource/index/ressource_texte/documentation', $this->lang->line('common_lsidebar_mod_docTxt')); ?></li>
                                <li><?php echo anchor('moderation/modify_ressource/index/ressource_graphique/modify', $this->lang->line('common_lsidebar_mod_ressImg')); ?></li>
                                <li><?php echo anchor('moderation/modify_ressource/index/ressource_graphique/documentation', $this->lang->line('common_lsidebar_mod_docImg')); ?></li>
                                <li><?php echo anchor('moderation/modify_ressource/index/ressource_video/modify', $this->lang->line('common_lsidebar_mod_ressVid')); ?></li>
                                <li><?php echo anchor('moderation/modify_ressource/index/ressource_video/documentation', $this->lang->line('common_lsidebar_mod_docVid')); ?></li>
                            </ul>
                        </li>
                <?php } ?>
                <li>
                    <?php echo img(array('src'=>'assets/utils/zoom-2.png','width'=>'8%')); ?>
                    <span class="cursorPointer"><?php echo $this->lang->line('common_lsidebar_view_data'); ?></span>
                    <ul>
                        <li><?php echo anchor('view_data/select_data/index/objet', $this->lang->line('common_objets')); ?></li>
                        <li><?php echo anchor('view_data/select_data/index/ressource_texte', $this->lang->line('common_ressources_txt')); ?></li>
                        <li><?php echo anchor('view_data/select_data/index/ressource_graphique', $this->lang->line('common_ressources_img')); ?></li>
                        <li><?php echo anchor('view_data/select_data/index/ressource_video', $this->lang->line('common_ressources_vid')); ?></li>
                        <li><?php echo anchor('view_data/select_data/index/carte', $this->lang->line('common_lsidebar_view_map')); ?></li>
                    </ul>
                </li>
                <li>
                    <?php echo img(array('src'=>'assets/utils/edit-user.png','width'=>'8%')); ?>
                    <?php echo anchor('profile_panel/profile_panel', $this->lang->line('common_lsidebar_profile_panel')); ?>
                </li>
                <?php if($this->session->userdata('user_level') >= 9) { ?>
                        <li>
                            <?php echo img(array('src'=>'assets/utils/edit-group.png','width'=>'8%')); ?>
                            <?php echo anchor('admin_panel/admin_panel', $this->lang->line('common_lsidebar_admin_panel'));?>
                        </li>
                <?php } ?>
                <li>
                    <?php echo img(array('src'=>'assets/utils/contact.png','width'=>'8%')); ?>
                    <?php echo anchor('profile_panel/contact_panel', $this->lang->line('common_lsidebar_contact_panel')); ?>
                </li>
                <li>
                    <?php echo img(array('src'=>'assets/utils/download.png','width'=>'8%')); ?>
                    <?php echo anchor('download/download', $this->lang->line('common_lsidebar_downloads')); ?>
                </li>
                <li>
                    <?php echo img(array('src'=>'assets/utils/tuto.png','width'=>'8%')); ?>
                    <?php echo anchor('tutorial/tutorial', $this->lang->line('common_lsidebar_tutorial')); ?>
                </li>
                <li>
                    <?php echo img(array('src'=>'assets/utils/system-logout.png','width'=>'8%')); ?>
                    <?php echo anchor('accueil/login/logout', $this->lang->line('common_lsidebar_logout')); ?>
                </li>
            </ul>
        </div>
    <?php } ?>
        <div id="contenu">
            <?php echo $output; ?>
        </div>
    </body>
    <script src="<?php echo base_url();?>assets/js/jquery.js"></script>
    <?php if($this->session->userdata('username')){ ?>
        <script src="<?php echo base_url();?>assets/js/dropdownmenu.js"></script>
    <?php } ?>
    <?php foreach ($js as $url): ?>
        <script type="text/javascript" src="<?php echo $url; ?>"></script>
    <?php endforeach; ?>
        
    <foot>
        <br/>
            <div class="copyright">Copyright © 2011. Tous droits réservés.</div>  

    </foot>
</html>
