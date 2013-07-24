
    <h1><?php echo $this->lang->line('common_select_data'); ?></h1>
    
    <p><?php echo $this->lang->line('common_view_select_type'); ?></p>
    <div class='menu'>
        <ul id='navigation'>
            <li>
                <?php echo img(array('src'=>'assets/utils/objet1.png','width'=>'5%', 'alt'=>'icone objet')); ?>
                <?php echo anchor('view_data/select_data/index/objet',$this->lang->line('common_objets')); ?>
            </li>
            <li>
                <?php echo img(array('src'=>'assets/utils/ress-text.png','width'=>'4%', 'alt'=>'icone ressource textuelle')); ?>
                <?php echo anchor('view_data/select_data/index/ressource_texte',$this->lang->line('common_ressources_txt')); ?>
            </li>
            <li>
                <?php echo img(array('src'=>'assets/utils/ress-graph.png','width'=>'4%', 'alt'=>'icone ressource graphique')); ?>
                <?php echo anchor('view_data/select_data/index/ressource_graphique',$this->lang->line('common_ressources_img')); ?>
            </li>
            <li>
                <?php echo img(array('src'=>'assets/utils/ress-video.png','width'=>'4%', 'alt'=>'icone ressource video')); ?>
                <?php echo anchor('view_data/select_data/index/ressource_video',$this->lang->line('common_ressources_vid')); ?>
            </li>
            <li>
                <?php echo img(array('src'=>'assets/utils/carte.png','width'=>'4%', 'alt'=>'icone carte')); ?>
                <?php echo anchor('view_data/select_data/index/carte',$this->lang->line('common_lsidebar_view_map')); ?>
            </li>
        </ul>
    </div>
    
    