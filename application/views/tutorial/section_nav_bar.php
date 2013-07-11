

<div id='tuto-nav'>
        <span  <?php if($section=='data_center'){echo 'class="focus"';} ?>>
            <?php echo img(array('src'=>'assets/utils/db_add.png','width'=>'2%')); ?>
            <?php echo anchor('tutorial/tutorial/data_center', 'Ajout'); ?>
        </span>
        <?php if($this->session->userdata('user_level') >= 5) { ?>
            <span  <?php if($section=='moderation_center'){echo 'class="focus"';} ?>>
                <?php echo img(array('src'=>'assets/utils/db_update.png','width'=>'2%')); ?>
                <?php echo anchor('tutorial/tutorial/moderation_center', 'Modération');?>
            </span>
        <?php } ?>
        <span  <?php if($section=='view_data'){echo 'class="focus"';} ?>>
            <?php echo img(array('src'=>'assets/utils/zoom-2.png','width'=>'2%')); ?>
            <?php echo anchor('tutorial/tutorial/view_data', 'Visualisation'); ?>
        </span>
        <span  <?php if($section=='profile_panel'){echo 'class="focus"';} ?>>
            <?php echo img(array('src'=>'assets/utils/edit-user.png','width'=>'2%')); ?>
            <?php echo anchor('tutorial/tutorial/profile_panel', 'Profil'); ?>
        </span>
        <?php if($this->session->userdata('user_level') >= 9) { ?>
                <span  <?php if($section=='admin_panel'){echo 'class="focus"';} ?>>
                    <?php echo img(array('src'=>'assets/utils/edit-group.png','width'=>'2%')); ?>
                    <?php echo anchor('tutorial/tutorial/admin_panel', 'Administration');?>
                </span>
        <?php } ?>
        <span  <?php if($section=='contact_panel'){echo 'class="focus"';} ?>>
            <?php echo img(array('src'=>'assets/utils/contact.png','width'=>'2%')); ?>
            <?php echo anchor('tutorial/tutorial/contact_panel', 'Autres membres'); ?>
        </span>
        <span  <?php if($section=='download'){echo 'class="focus"';} ?>>
            <?php echo img(array('src'=>'assets/utils/download.png','width'=>'2%')); ?>
            <?php echo anchor('tutorial/tutorial/download', 'Téléchargements'); ?>
        </span>
</div>
<br>