
<h1><?php echo $this->lang->line('common_lsidebar_addData'); ?></h1>
<p><?php echo $this->lang->line('common_add_data_instruction'); ?></p>
<div class='menu'>
    <ul class='navigation'>
        <?php if ( $this->session->userdata('user_level') >= 4 ) {?>
              <li><?php echo anchor('data_center/ajout_objet', $this->lang->line('common_lsidebar_objet')); ?></li>
              <li><?php echo anchor('data_center/ajout_relation', $this->lang->line('common_lsidebar_relation')); ?></li>
              <li><?php echo anchor('data_center/import_csv', $this->lang->line('common_add_data_csv_import')); ?></li>
        <?php } ?>
        <li>
            <span class="cursorPointer"><?php echo $this->lang->line('common_ressources'); ?></span>
            <ul>
                <li><?php echo anchor('data_center/ajout_ressource/formulaire_texte', $this->lang->line('common_ress_txt_detail')); ?></li>
                <li><?php echo anchor('data_center/ajout_ressource/formulaire_image', $this->lang->line('common_ress_img_detail')); ?></li>
                <li><?php echo anchor('data_center/ajout_ressource/formulaire_video', $this->lang->line('common_ress_vid_detail')); ?></li>
            </ul>
        </li>
        <li>
            <span class="cursorPointer"><?php echo $this->lang->line('common_documentation'); ?></span>
            <ul>
                <li><?php echo anchor('view_data/select_data/index/ressource_texte/add_doc', $this->lang->line('common_doc_txt')); ?></li>
                <li><?php echo anchor('view_data/select_data/index/ressource_graphique/add_doc', $this->lang->line('common_doc_img')); ?></li>
                <li><?php echo anchor('view_data/select_data/index/ressource_video/add_doc', $this->lang->line('common_doc_vid')); ?></li>
            </ul>
        </li>
    </ul>
</div>
