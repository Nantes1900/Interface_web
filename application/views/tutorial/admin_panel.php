
<div id="tuto-arrow">
    <?php 
        echo anchor('tutorial/tutorial/previous/admin_panel', img(array('src'=>'assets/utils/arrow-left.png', 'alt'=>'Section précédente'))); 
        echo img(array('src'=>'assets/utils/arrow-up-double.png', 'alt'=>'Revenir au menu principal du tutorial', 'id'=>'arrow-up'));
        echo anchor('tutorial/tutorial/next/admin_panel', img(array('src'=>'assets/utils/arrow-right.png', 'alt'=>'Section suivante'))); 
    ?>
</div>

<h2>Centre d'administration</h2>

<p>
    Ce menu disponible uniquement pour les administrateurs permet d'afficher une liste des membres du site. 
</p>
<p>
    Vous pouvez alors changer le niveau de chaque utilisateur dans la colonne <b>"Niveau utilisateur"</b> 
    puis cliquer sur le bouton "changer le niveau d'utilisateur" pour valider ce choix (validez les choix 
    un par un, l'application n'enregistrera pas plusieurs changements sur différents utilisateurs).
</p>
<p>
    Seul le super administrateur peut promouvoir les administrateurs et les destituer.
</p>
<br>
<p>
    Il est également possible de supprimer les utilisateurs qui n'ont jamais contribué au site 
    (aucun ajout d'objet ou de ressource), mais cela devrait rester exceptionnel, vous pouvez en 
    effet toujours bannir l'utilisateur (il ne pourra plus se connecter). 
</p>
<p>
    Si un utilisateur "pollueur" a rajouté des ressources dénuées de sens, vous devez aussi 
    supprimer ces ressources avant de supprimer son compte.
</p>