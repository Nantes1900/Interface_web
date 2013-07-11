
<div id="tuto-arrow">
    <?php 
        echo anchor('tutorial/tutorial/previous/download', img(array('src'=>'assets/utils/arrow-left.png', 'alt'=>'Section précédente'))); 
        echo img(array('src'=>'assets/utils/arrow-up-double.png', 'alt'=>'Revenir au menu principal du tutorial', 'id'=>'arrow-up'));
        echo img(array('src'=>'assets/utils/arrow-right.png', 'alt'=>'Section suivante', 'style'=>'visibility:hidden'));
    ?>
</div>

<h2>Téléchargements</h2>

<p>
    Cette section contient différents outils à télécharger pour faciliter votre 
    utilisation de la plateforme Nantes1900. 
</p>
<p>
    En particulier, vous pourrez trouver les modèles de tableur pour l'export en 
    fichier csv. Pour plus d'informations à ce sujet, allez voir la section 
    <b>Ajout</b>, sous-section <b>import d'un fichier csv</b>.
</p>

<script src="<?php echo base_url();?>assets/js/tuto_sub_section.js"></script>