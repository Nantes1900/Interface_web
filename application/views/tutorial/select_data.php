
<div id="tuto-arrow">
    <?php 
        echo anchor('tutorial/tutorial/previous/select_data', img(array('src'=>'assets/utils/arrow-left.png', 'alt'=>'Section précédente'))); 
        echo img(array('src'=>'assets/utils/arrow-up-double.png', 'alt'=>'Revenir au menu principal du tutorial', 'id'=>'arrow-up'));
        echo anchor('tutorial/tutorial/next/select_data', img(array('src'=>'assets/utils/arrow-right.png', 'alt'=>'Section suivante'))); 
    ?>
</div>

<h2>Visualisation de données</h2>