
<div id="tuto-arrow">
    <?php 
        echo anchor('tutorial/tutorial/previous/view_data', img(array('src'=>'assets/utils/arrow-left.png', 'alt'=>'Section précédente'))); 
        echo img(array('src'=>'assets/utils/arrow-up-double.png', 'alt'=>'Revenir au menu principal du tutorial', 'id'=>'arrow-up'));
        echo anchor('tutorial/tutorial/next/view_data', img(array('src'=>'assets/utils/arrow-right.png', 'alt'=>'Section suivante'))); 
    ?>
</div>

<h2>Visualisation de données</h2>

<p>
    Ce menu permet de naviguer dans la base de données du projet Nantes1900. 
</p>
<p>
    On peut accéder à des listes <span class="hint">d'objets
    <span>entité historique importante, représentant souvent un bâtiment ou une organisation</span></span>
    , de <span class="hint">ressources<span>fiche technique détaillée sur un document</span></span> 
    ou encore à une carte interactive. 
<p>
</p>
    En visualisation de données, seules les données validées par les modérateurs sont visibles, 
    elles sont donc considérées comme fiables par les participants au projet.
</p>

<div class="subSection">
    <h3> Visualisation d'objets </h3>
    <div class="subText">
        <p>
            Une liste d'objets s'ouvre, avec un bref aperçu des informations les concernant. 
            Un bouton permet d'avoir plus de détails. 
        </p>
        <p>
            Quand on est en vision détaillée d'un objet, on peut voir dans la barre latérale 
            droite les objets et ressources liés. Un clic sur la loupe permet d'obtenir 
            une vision détaillée de ces objets ou ressources.
        </p>
        <p>
            Selon l'objet et vos propres droits, vous aurez en bas de page la possibilité de:
            <ul>
                <li>Voir l'objet sur la carte</li>
                <li>Modifier l'objet</li>
                <li>Ajouter une ressource liée à cet objet</li>
            </ul>
        </p>
    </div>
</div>

<div class="subSection">
    <h3> Visualisation de ressources </h3>
    <div class="subText">
        <p>
            Un menu similaire à celui des objets s'ouvre, mais il contient des ressources de type spécifié.
        </p>
        <p>
            Un bouton mène à une vue détaillée de chaque ressource, avec une barre 
            latérale à droite contenant les objets liés à la ressource.
        </p>
        <p>
            Si vos droits le permettent, aurez en bas de page la possibilité de modifier cette ressource.
        </p>
    </div>
</div>

<div class="subSection">
    <h3> Carte interactive </h3>
    <div class="subText">
        <p>
            Il s'agit d'une carte avec des marqueurs correspondant aux différents objets qui possèdent des coordonnées.
        </p>
        <p>
            En cliquant sur un un marqueur, vous aurez accès à son nom, à un petit résumé, 
            ainsi qu'un lien vers une vue détaillée de l'objet.
        </p>
        <p>
            Si après une mise à jour théorique de la carte (l'ajout d'un marqueur correspondant à un objet validé, 
            la suppression d'un marqueur), la mise à jour ne semble pas effective, essayez de nettoyer le cache 
            de votre navigateur (ou changez temporairement de navigateur si vous voulez conserver le cache).
        </p>
        <?php if($this->session->userdata('user_level') >= 4){ ?>
            <p>
                A partir du statut de chercheur, vous pouvez double cliquer sur un emplacement de la carte 
                pour y poser un marqueur temporaire. Vous pouvez :
                <ul>
                    <li>Le déplacer si sa position ne vous convient pas</li>
                    <li>En créer un autre si à but comparatif</li>
                </ul>
                Une fois votre marqueur bien placé, des liens sur ce dernier vous permettent de :
                <ul>
                    <li>Créer un nouvel objet directement avec une référence géométrique sur ce point.</li>
                    <li>Sélectionner un objet déjà existant pour le lier à cette position.</li>
                </ul>
            </p>
        <?php } ?>
        <?php if($this->session->userdata('user_level') >= 5){ ?>
            <p>
                A partir du statut de modérateur, une seconde option est disponible sur les marqueurs existants. 
            </p>
            <p>
                Elle est utilisée pour supprimer la géométrie de cet objet, ce qui effacera 
                le marqueur de la base de données sans pour autant supprimer l'objet en question.
            </p>
        <?php } ?>
    </div>
</div>

<script src="<?php echo base_url();?>assets/js/tuto_sub_section.js"></script>