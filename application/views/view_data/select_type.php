
    <h1>Selection de données</h1>
    
    <p>Visualiser les :</p>
    <div class='menu'>
        <ul id='navigation'>
            <li>
                <?php echo img(array('src'=>'assets/utils/objet1.png','width'=>'5%', 'alt'=>'icone objet')); ?>
                <?php echo anchor('view_data/select_data/index/objet','Objets'); ?>
            </li>
            <li>
                <?php echo img(array('src'=>'assets/utils/ress-text.png','width'=>'4%', 'alt'=>'icone ressource textuelle')); ?>
                <?php echo anchor('view_data/select_data/index/ressource_texte','Ressources textuelles'); ?>
            </li>
            <li>
                <?php echo img(array('src'=>'assets/utils/ress-graph.png','width'=>'4%', 'alt'=>'icone ressource graphique')); ?>
                <?php echo anchor('view_data/select_data/index/ressource_graphique','Ressources graphiques'); ?>
            </li>
            <li>
                <?php echo img(array('src'=>'assets/utils/ress-video.png','width'=>'4%', 'alt'=>'icone ressource video')); ?>
                <?php echo anchor('view_data/select_data/index/ressource_video','Ressources vidéos'); ?>
            </li>
        </ul>
    </div>
    
    