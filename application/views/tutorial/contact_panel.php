
<div id="tuto-arrow">
    <?php 
        echo anchor('tutorial/tutorial/previous/contact_panel', img(array('src'=>'assets/utils/arrow-left.png', 'alt'=>'Section précédente'))); 
        echo img(array('src'=>'assets/utils/arrow-up-double.png', 'alt'=>'Revenir au menu principal du tutorial', 'id'=>'arrow-up'));
        echo anchor('tutorial/tutorial/next/contact_panel', img(array('src'=>'assets/utils/arrow-right.png', 'alt'=>'Section suivante'))); 
    ?>
</div>

<h2>Liste des autres membres</h2>
<p>
    Ce menu public affiche les informations à propos des différents utilisateurs. 
</p>
<p>
    Vous pouvez effectuer un tri, en particulier sur les niveaux d'utilisateur, 
    pour contacter plus facilement les modérateurs.
</p>
