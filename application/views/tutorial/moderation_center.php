
<div id="tuto-arrow">
    <?php 
        echo anchor('tutorial/tutorial/previous/moderation_center', img(array('src'=>'assets/utils/arrow-left.png', 'alt'=>'Section précédente'))); 
        echo img(array('src'=>'assets/utils/arrow-up-double.png', 'alt'=>'Revenir au menu principal du tutorial', 'id'=>'arrow-up'));
        echo anchor('tutorial/tutorial/next/moderation_center', img(array('src'=>'assets/utils/arrow-right.png', 'alt'=>'Section suivante'))); 
    ?>
</div>

<h2>Modération de données</h2>

<p>
    Cette section n'est visible qu'à partir du statut de modérateur. 
</p>
<p>
    Ses principaux buts sont la validation, la modification et la suppression de données, 
    ainsi que la création de lien de type relation entre objets ou documentation d'une ressource vers un objet. 
</p>
<p>
    Les différents sous-menus sont les suivants :
</p>

<div class="subSection">
    <h3> Modifier un objet historique </h3>
    <div class="subText">
        <p>
            Ce menu se présente sous la forme d'une liste d'objets avec quelques 
            informations et un moteur de recherche pour réaliser un tri. 
        </p>
        <ul>
            <li>
                Le bouton <b>"supprimer cet objet"</b> a simplement pour effet de supprimer l'objet
            </li>
            <li>
                <b>"modifier cet objet"</b> mène vers un formulaire pré-rempli ressemblant à celui d'ajout d'objet.
                <ul>
                    <li>En bas se trouve la case  <b>"valider"</b> qu'il faut cocher pour valider l'objet. </li>
                    <li>Les messages d'erreur en rouge seront imprimés par défaut, ils sont juste là pour signaler 
                    qu'il faut faire attention à ces champs, vous pouvez quand même valider sans changer
                    les champs concernés (si ça ne fonctionne pas, c'est que le champ a vraiment un problème).</li>
                </ul>
            </li>
            <li>
                Il existe aussi un bouton de validation direct, mais il est déconseillé de l'utiliser 
                sans savoir exactement tout sur l'objet que vous validez 
                (la liste ne présente pas tous les détails de l'objet)
            </li>
        </ul>
    </div>
</div>

<div class="subSection">
    <h3> Gérer les relations entre objets historiques </h3>
    <div class="subText">
        <p>
            On retrouve notre liste d'objet et les options de tri. 
            Mais cette fois-ci, les boutons permettent de d'ajouter une relation à un objet ou de lui en retirer.
        </p>
        <p>
            Quand on clique sur ajouter une relation, on retrouve encore la liste des objets, 
            avec un bouton pour lier à l'objet précédent (dont le nom est affiché dans le titre) 
            qui mène à un formulaire d'information complémentaires.
            <br> Une fois ce formulaire complété, un message de validation confirmera votre ajout.
        </p>
        <p>
            Le bouton de suppression de relation mène à une liste des objets liés au précédent, 
            avec un bouton de suppression de relation. Pour ne pas vous perdre, lisez bien l'intitulé 
            de la liste, ainsi que le titre de la colonne au dessus du bouton sur lequel vous comptez cliquer.
        </p>
    </div>
</div>

<div class="subSection">
    <h3> Modifier une ressource textuelle </h3>
    <div class="subText">
        <p>
            Menu se rapprochant de la modification d'objet historique, cette fois-ci, c'est une liste de 
            <span class="hint">ressources textuelles<span>livres, lettres, articles de journaux 
                                                      (ou juste leur fiche technique) </span> </span>
            qui est disposée, avec quelques outils de filtrage.
        </p>
        <ul>
            <li>
                Le bouton <b>"supprimer cette ressource"</b> a simplement pour effet de supprimer la ressource concernée.
            </li>
            <li>
                <b>"modifier cette ressource"</b> mène vers un formulaire pré-rempli 
                ressemblant à celui d'ajout de ressource textuelle. En bas se trouve la case
                <b>"valider"</b> qu'il faut cocher pour valider la ressource. 
            </li>
            <li>
                Il existe aussi un bouton de validation direct, mais il est déconseillé de l'utiliser 
                sans savoir exactement tout sur la ressource que vous validez 
                (la liste ne présente pas tous les détails de l'objet)
            </li>
        </ul>
        
    </div>
</div>

<div class="subSection">
    <h3> Gérer la documentation textuelle vers un objet historique </h3>
    <div class="subText">
        <p>
            Dans le projet Nantes1900, la documentation représente le lien entre une ressource et un objet.
        </p>
        <p>
            Ce menu affiche donc une liste des ressources textuelles. Deux boutons s'offrent à vous :
        </p>
        <ul>
            <li>
                Le premier : <b>"lier cette ressource"</b>, vous permet de choisir dans une liste à quel objet vous souhaitez lier 
                la ressource sélectionnée (avec possibilité d'indiquer une page particulière de la ressource textuelle). 
            </li>
            <li>
                Le second : <b>"supprimer une documentation"</b>, affiche la liste des objets liés à la ressource sélectionnée, 
                avec la possibilité de supprimer les liens en question.
            </li>
        </ul>
    </div>
</div>

<div class="subSection">
    <h3> Modifier une ressource graphique </h3>
    <div class="subText">
        <p>
            Ce menu est basé sur le même modèle que la modification de ressource textuelle, 
            les options y sont les mêmes et la présentation est identique, à ceci près que 
            ce sont ici des <span class="hint">ressources graphiques<span>fiches techniques sur des photos, 
            des images, des peintures...</span></span> qui sont mises en jeu.
        </p>
    </div>
</div>

<div class="subSection">
    <h3> Gérer la documentation graphique vers un objet historique </h3>
    <div class="subText">
        <p>
            Idem, on retrouve les mêmes mécanismes que pour la documentation textuelle, mais appliquée aux
            <span class="hint">ressources graphiques<span>fiches techniques sur des photos, 
            des images, des peintures...</span></span>.
        </p>
    </div>
</div>

<div class="subSection">
    <h3> Les ressources vidéos </h3>
    <div class="subText">
        <p>
            On retrouve aussi les options précédentes appliquées aux <span class="hint">ressources vidéos
            <span>fiches techniques sur des vidéos internet, des films, des court-métrages...</span></span>. 
            Leur mécanisme est le même que pour les autres types de ressource.
        </p>
    </div>
</div>
