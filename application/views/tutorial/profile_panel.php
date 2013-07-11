
<div id="tuto-arrow">
    <?php 
        echo anchor('tutorial/tutorial/previous/profile_panel', img(array('src'=>'assets/utils/arrow-left.png', 'alt'=>'Section précédente'))); 
        echo img(array('src'=>'assets/utils/arrow-up-double.png', 'alt'=>'Revenir au menu principal du tutorial', 'id'=>'arrow-up'));
        echo anchor('tutorial/tutorial/next/profile_panel', img(array('src'=>'assets/utils/arrow-right.png', 'alt'=>'Section suivante'))); 
    ?>
</div>

<h2>Profil personnel</h2>

<p>
    Ce menu vous permet de gérer les informations que verront les autres utilisateurs. 
    Pour valider les modifications, vous devez entrer votre mot de passe. Si aucun message d'erreur 
    ne s'affiche quand vous validez, votre modification a été prise en compte.
</p>
