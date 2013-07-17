

<p>Bienvenue <?php echo $this->session->userdata('username'); ?></p>

<div class='menu'>
    <ul id='navigation'>
        <li>
            <?php echo img(array('src'=>'assets/utils/db_add.png','width'=>'4%')); ?>
            <?php echo anchor('data_center/data_center', $this->lang->line('common_lsidebar_addData')); ?>
        </li>
        <?php if($this->session->userdata('user_level') >= 5) { ?>
            <li>
                <?php echo img(array('src'=>'assets/utils/db_update.png','width'=>'4%')); ?>
                <?php echo anchor('moderation/moderation_center', $this->lang->line('common_lsidebar_moderation'));?>
            </li>
        <?php } ?>
        <li>
            <?php echo img(array('src'=>'assets/utils/zoom-2.png','width'=>'4%')); ?>
            <?php echo anchor('view_data/select_data', $this->lang->line('common_lsidebar_view_data')); ?>
        </li>
        <li>
            <?php echo img(array('src'=>'assets/utils/edit-user.png','width'=>'4%')); ?>
            <?php echo anchor('profile_panel/profile_panel', $this->lang->line('common_menu_profile_panel')); ?>
        </li>
        <?php if($this->session->userdata('user_level') >= 9) { ?>
                <li>
                    <?php echo img(array('src'=>'assets/utils/edit-group.png','width'=>'4%')); ?>
                    <?php echo anchor('admin_panel/admin_panel', $this->lang->line('common_lsidebar_admin_panel'));?>
                </li>
        <?php } ?>
        <li>
            <?php echo img(array('src'=>'assets/utils/contact.png','width'=>'4%')); ?>
            <?php echo anchor('profile_panel/contact_panel', $this->lang->line('common_menu_contact_panel')); ?>
        </li>
        <li>
            <?php echo img(array('src'=>'assets/utils/download.png','width'=>'4%')); ?>
            <?php echo anchor('download/download', $this->lang->line('common_lsidebar_downloads')); ?>
        </li>
        <li>
            <?php echo img(array('src'=>'assets/utils/tuto.png','width'=>'4%')); ?>
            <?php echo anchor('tutorial/tutorial', $this->lang->line('common_lsidebar_tutorial')); ?>
        </li>
        <li>
            <?php echo img(array('src'=>'assets/utils/system-logout.png','width'=>'4%')); ?>
            <?php echo anchor('accueil/login/logout', $this->lang->line('common_lsidebar_logout')); ?>
        </li>
    </ul>
</div>

