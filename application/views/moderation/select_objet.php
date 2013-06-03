<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

    <h1>Selection de données</h1>
    
    <h2>Liste des objets</h2>
<!--    sorting form-->
    <?php echo form_open('moderation/modify_objet') ?>
        <label for="orderBy">Trier par:</label>
        <select name="orderBy" id="orderBy">
            <option value="nom_objet">Nom de l'objet</option>
            <option value="username">Pseudo du créateur</option>
        </select>
        <select name="orderDirection">
            <option value="asc">Croissant</option>
            <option value="desc">Décroissant</option>
        </select>
        <br/>
        <label for="speAttribute">Rechercher un(e):</label>
        <select name="speAttribute" id="speAttribute">
            <option value="nom_objet">Nom de l'objet</option>
            <option value="username">Pseudo du créateur</option>
            <option value="mots_cles">Mot-clé</option>
            <option value="resume">Résumé</option>
            <option value="historique">Historique</option>
            <option value="description">Description</option>
            <option value="adresse_postale">Adresse</option>
        </select>
        <input type="text" name="speAttributeValue" maxlength="50"/>
        <br/>
        <input type="checkbox" name="validation" value="TRUE">Objets non validés uniquement
        <br/>
        <input type="submit" value="Trier" />


    </form>

<!--    list of objets-->

    <div class="classyTable">
    <table>
        <thead>
            <tr>
                <th>Objet</th><th>Créateur</th><th>Résumé</th><th>Mots-clés</th><th>Validation</th><th>Modifier/Valider</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listObjet as $objet) {        ?>
                <tr>
                    <td><?php echo $objet->get_nom_objet(); ?></td>
                    <td><?php echo $objet->get_username(); ?></td>
                    <td><?php echo $objet->get_resume(); ?></td>
                    <td><?php echo $objet->get_mots_cles(); ?></td>
                    <td><?php echo $objet->get_validation()=='t'?'validé':'non validé'; ?></td>
                    <td>
                        <?php echo form_open('moderation/modify_objet') ?>
                            <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                            <input type="submit" value="Modifier cet objet" />
                        </form>
                    </td>
                </tr>
            <?php }  ?>
        </tbody>
    </table>
    </div>
    
</html>
