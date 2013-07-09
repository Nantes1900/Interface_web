

<p>Bienvenue <?php echo $this->session->userdata('username'); ?></p>

<div class='menu'>
    <ul id='navigation'>
        <li>
            <?php echo img(array('src'=>'assets/utils/db_add.png','width'=>'4%')); ?>
            <?php echo anchor('data_center/data_center', 'Ajout de données'); ?>
        </li>
        <?php if($this->session->userdata('user_level') >= 5) { ?>
            <li>
                <?php echo img(array('src'=>'assets/utils/db_update.png','width'=>'4%')); ?>
                <?php echo anchor('moderation/moderation_center', 'Modération de données');?>
            </li>
        <?php } ?>
        <li>
            <?php echo img(array('src'=>'assets/utils/zoom-2.png','width'=>'4%')); ?>
            <?php echo anchor('view_data/select_data', 'Visualisation de données'); ?>
        </li>
        <li>
            <?php echo img(array('src'=>'assets/utils/edit-user.png','width'=>'4%')); ?>
            <?php echo anchor('profile_panel/profile_panel', 'Consulter profil personnel'); ?>
        </li>
        <?php if($this->session->userdata('user_level') >= 9) { ?>
                <li>
                    <?php echo img(array('src'=>'assets/utils/edit-group.png','width'=>'4%')); ?>
                    <?php echo anchor('admin_panel/admin_panel', 'Centre d\'administration');?>
                </li>
        <?php } ?>
        <li>
            <?php echo img(array('src'=>'assets/utils/contact.png','width'=>'4%')); ?>
            <?php echo anchor('profile_panel/contact_panel', 'Liste des autres membres'); ?>
        </li>
        <li>
            <?php echo img(array('src'=>'assets/utils/download.png','width'=>'4%')); ?>
            <?php echo anchor('download/download', 'Téléchargements'); ?>
        </li>
        <li>
            <?php echo img(array('src'=>'assets/utils/tuto.png','width'=>'4%')); ?>
            <?php echo anchor('tutorial/tutorial', 'Tutoriel'); ?>
        </li>
        <li>
            <?php echo img(array('src'=>'assets/utils/system-logout.png','width'=>'4%')); ?>
            <?php echo anchor('accueil/login/logout', 'D&eacute;connexion'); ?>
        </li>
    </ul>
</div>

