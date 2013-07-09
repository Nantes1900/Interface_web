

<div style="text-align:center;">
    <?php echo img(array('src'=>'assets/utils/arrow-left.png', 'alt'=>'Section précédente', 'style'=>'visibility:hidden')); ?>
    <?php echo anchor('tutorial/tutorial', img(array('src'=>'assets/utils/arrow-up-double.png', 'alt'=>'Revenir au menu principal du tutorial'))); ?>
    <?php 
        echo anchor('tutorial/tutorial/next/data_center', img(array('src'=>'assets/utils/arrow-right.png', 'alt'=>'Section suivante'))); 
    ?>
</div>

<h2>Ajout de données</h2>

<p>Cette section est dédiée à l'ajout de données concernant la ville de Nantes. </p>

<p>Ces ajouts se font par le biais de formulaires qu'il convient de remplir jusqu'au bout avant de valider. </p>

<p>
    Essayez de fournir le maximum d'informations possibles, certains champs sont d'ailleurs obligatoires et si 
    vous tentez de valider sans les remplir, on vous le signalera en rouge. 
</p>
<p>
    Les ajouts doivent passer par une validation de la part des modérateurs, il est donc normal 
    que vous ne puissiez pas voir votre ajout directement après avoir validé le formulaire. 
</p>
<p>
    Si le délai d'attente vous paraît anormalement long ou que vous souhaitez revenir sur votre décision, 
    contactez un modérateur par e-mail (plus de précisions dans la section <b>autres membres</b>). 
</p>

<div class="subSection">
    <h3> Ajout de ressource </h3>
    <div class="subText">
        <p>
            Tous les utilisateurs ont la possibilité d'ajouter des ressources. 
            Il s'agit de divers documents se rapportant généralement a un objet historique 
            (entité historique importante, représentant souvent un bâtiment ou une organisation). 
        </p>
        <p>
            Ces ressources sont une sorte de fiche technique détaillée (comprenant titre, 
            référence, description, auteur, date de parution...) sur un document 
            (quel que soit son support) avec éventuellement un extrait voir tout le document, 
            ou encore un lien vers celui-ci. 
        </p>
        <p>
            On les divise en trois catégories : les ressources textuelles, 
            graphiques et vidéo. 
        </p>
        <p>
            Pour ajouter une ressource, cliquez sur "Une ressource" puis sélectionnez le type de ressource qui vous intéresse dans le menu déroulant.
        </p>
        <ul>
            <li>
                Les ressources textuelles sont en général des livres, des lettres, 
                des articles de journaux (ou juste leur fiche technique) 
                mais peuvent aussi être de simples liens détaillés vers des pages web hébergeant des informations sur le sujet traité.
            </li>
            <li>
                Les ressources graphiques sont des fiches techniques sur des photos, 
                des images, des peintures... <br> Il est possible de charger l'image sur le site 
                pour qu'elle soit visible à la consultation (dans ce cas, elle ne devra pas dépasser les 2Mo) 
                ou encore de fournir une url, mais dans tous les cas ce n'est pas obligatoire, 
                on peut juste se contenter d'indiquer par exemple une photo dont on ne possède pas les droits.
            </li>
            <li>
                Les ressources vidéos sont des fiches techniques sur des vidéos internet, 
                des films, des court-métrages...<br> Il est possible de charger les vidéos sur le site pour 
                les rendre visibles à la consultation (100Mo maximum, selon le format, tous les navigateurs 
                internet ne permettront pas sa lecture, par exemple firefox ne lit pas le mp4), 
                il est aussi possible de donner une url correspondant à un site hébergeant la vidéo.
             </li>

        </ul>
        <p>
            Enfin, dans tous les cas, vous pouvez choisir un objet auquel sera lié la ressource dès sa création.
        </p>
    </div>
</div>

<div class="subSection">
    <h3> Ajout d'objet historiques </h3>
    <div class="subText">
        <p>
            A partir du statut de chercheur, on peut aussi ajouter des objets historiques 
            (entité historique importante, représentant souvent un bâtiment ou une organisation). 
        </p>
        <p>
            Il suffit pour cela de choisir l'option "objet historique", de remplire le formulaire 
            qui s'affiche alors et de valider en cliquant sur "Ajouter cet objet". Quel que soit votre statut, 
            l'objet ainsi créé ne sera pas automatiquement validé, il faudra contacter un modérateur ou 
            le valider vous-même (si vous êtes modérateur).
        </p>
    </div>
</div>

<script src="<?php echo base_url();?>assets/js/tuto_sub_section.js"></script>