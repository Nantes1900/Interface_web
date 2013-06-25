
<h1>Section de téléchargement</h1>

<p>Ici, divers outils sont mis à votre disposition pour faciliter l'utilisation du site de ce projet.</p>

<h2>Modèles de tableurs</h2>

<p>
    Si vous souhaitez utiliser des importations csv, il faut que le nom des colonnes respecte un certain formalisme, et certaines
    cellules ont aussi un format particulier. Pour vous aider, voici en téléchargement les modèles à utiliser.
</p>

<?php echo form_open('download/download/do_download'); ?>
            Modèle au format ods :
            <select name="fileName">
                <option value="template-objet.ods">Objet</option>
                <option value="template-relation.ods">Relation entre objets</option>
                <option value="template-ressource-texte.ods">Ressource textuelle</option>
                <option value="template-ressource-graphique.ods">Ressource graphique</option>
                <option value="template-ressource-video.ods">Ressource vidéo</option>
            </select>
            <input type="submit" value="Télécharger le fichier" />
</form>