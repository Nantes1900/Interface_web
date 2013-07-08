<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

    <h1>Modification de la ressource graphique : <?php echo $ressource->get_titre(); ?></h1>
        
    <?php echo form_open_multipart('moderation/modify_ressource/index/ressource_graphique/modify'); ?>
        <input type="hidden" name="ressource_id" value="<?php echo $ressource->get_ressource_graphique_id(); ?>" />
        <table border=0>
            
            <tr><td>Créateur</td><td><?php echo $ressource->get_username(); ?></td></tr>
            <tr> 
                    <td> Titre </td> 
                    <td> <input type=text name=titre value="<?php echo $ressource->get_titre(); ?>" size="30"/> </td>
                    <td class="error_form"><?php echo form_error('titre'); ?></td>
            </tr>
            <tr>
                    <td> Description </td>
                    <td> <textarea name=description value="<?php echo $ressource->get_description(); ?>" rows="5" cols="75"><?php echo $ressource->get_description(); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('description'); ?></td>
            </tr>
            <tr>
                    <td> Référence </td>
                    <td> <input type=text name=reference_ressource value="<?php echo $ressource->get_reference_ressource(); ?>" size="30"/> </td>
                    <td class="error_form"><?php echo form_error('reference_ressource'); ?></td>
            </tr>
            <tr>
                    <td> Disponibilité </td>
                    <td> <input type="text" name=disponibilite value="<?php echo $ressource->get_disponibilite(); ?>" size="30"></textarea> </td>
                    <td class="error_form"><?php echo form_error('disponibilite'); ?></td>
            </tr>
            <tr>
                    <td> Auteur(s) </td>
                    <td> <input type="text" name=auteurs value="<?php echo $ressource->get_auteurs(); ?>" size="30"></textarea> </td>
                    <td class="error_form"><?php echo form_error('auteurs'); ?></td>
            </tr>
            <tr>
                    <td> Editeur </td>
                    <td> <input type="text" name=editeur value="<?php echo $ressource->get_editeur(); ?>" size="30"></textarea> </td>
                    <td class="error_form"><?php echo form_error('editeur'); ?></td>
            </tr>
            <tr>
                    <td> Ville d'édition </td>
                    <td> <input type="text" name=ville_edition value="<?php echo $ressource->get_ville_edition(); ?>" size="30"></textarea> </td>
                    <td class="error_form"><?php echo form_error('ville_edition'); ?></td>
            </tr>
            
        </table>
        <table>
            <tr>
                    <td> Date d'édition </td>
            </tr>
            <tr>
                <?php $arrayDate = break_date_Ymd($ressource->get_date_debut_ressource()); ?>
			<td> Jour </td>
			<td> <input type=text name=jour value="<?php echo $arrayDate['day']; ?>" size="3" maxlength="2"> </td>
			<td> Mois </td>
			<td> <input type=text name=mois value="<?php echo $arrayDate['month']; ?>" size="3" maxlength="2"> </td>
			<td> Année </td>
			<td> <input type=text name=annee value="<?php echo $arrayDate['year']; ?>" size="5" maxlength="4"> </td>
            </tr>
            <tr>
                <td class="error_form"><?php echo form_error('jour'); ?></td>
                <td class="error_form"><?php echo form_error('mois'); ?></td>
                <td class="error_form"><?php echo form_error('annee'); ?></td>
            </tr>
            <tr>
                <td> Date de prise de vue </td>
            </tr>
            <tr>
                <?php $arrayDate = break_date_Ymd($ressource->get_date_prise_vue()); ?>
		<td> Jour </td>
                <td> <input type=text name=jourPrise value="<?php echo $arrayDate['day']; ?>" size="3" maxlength="2"> </td>
		<td> Mois </td>
		<td> <input type=text name=moisPrise value="<?php echo $arrayDate['month']; ?>" size="3" maxlength="2"> </td>
		<td> Année </td>
		<td> <input type=text name=anneePrise value="<?php echo $arrayDate['year']; ?>" size="5" maxlength="4"> </td>
            </tr>
            <tr>
                <td class="error_form"><?php echo form_error('jourPrise'); ?></td>
                <td class="error_form"><?php echo form_error('moisPrise'); ?></td>
                <td class="error_form"><?php echo form_error('anneePrise'); ?></td>
            </tr>
        </table>    
        <table>
            
            <tr>
                    <td> Mots-clés </td>
                    <td> <textarea name=mots_cles value="<?php echo $ressource->get_mots_cles(); ?>" rows="2" cols="75"><?php echo $ressource->get_mots_cles(); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('mots_cles'); ?></td>
            </tr>
            <tr>
                <td> Légende </td>
                <td> <input type="text" name="legende" value="<?php echo $ressource->get_legende(); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('legende'); ?></td>
                <?php if($ressource->get_image()!=null){ echo '<td>Aperçu image</td>';} ?>
            </tr>
            <tr>
                <td> Lieu de la prise de vue </td>
                <td> <input type="text" name="localisation" value="<?php echo $ressource->get_localisation(); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('localisation'); ?></td>
                <td rowspan="7">
                    <?php if($ressource->get_image()!=null){
                        echo img(array('src'=>'assets/images/'.$ressource->get_image())); 
                    } ?>
                </td>
            </tr>
            <tr>
                <td> Technique utilisée </td>
                <td> <input type="text" name="technique" value="<?php echo $ressource->get_technique(); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('technique'); ?></td>
            </tr>
            <tr>
                <td> Support de la ressource </td>
                <td> <input type="text" name="type_support" value="<?php echo $ressource->get_type_support(); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('type_support'); ?></td>
            </tr>
            <tr>
                <td> Couleur </td>
                <td> 
                    <input type="radio" name="couleur" value="t" <?php if($ressource->get_couleur()=='t'){echo 'checked';} ?> >Couleur <br/>
                    <input type="radio" name="couleur" value="f" <?php if($ressource->get_couleur()=='f'){echo 'checked';} ?> >Noir et blanc
                </td>
                <td class="error_form"><?php echo form_error('couleur'); ?></td>
            </tr>
            <tr>
                <td> Télécharger une nouvelle image </td>
                <td> 
                    <input type="file" name="image">
                </td>                
            </tr>
            <tr>
                <td> URL image </td>
                <td> <input type="text" name="image_link" value="<?php echo $ressource->get_image_link(); ?>" size="30" maxlength="255"> </td>
                <td class="error_form"><?php echo form_error('image_link'); ?></td>              
            </tr>
            <tr>
                <td> Nombre de pages </td>
                <td> <input type="text" name="pagination" value="<?php echo $ressource->get_pagination(); ?>"> </td>
                <td class="error_form"><?php echo form_error('pagination'); ?></td>
            </tr>
            <tr>
                <td><input type="checkbox" name="validate" value="TRUE" <?php if($ressource->get_validation()=='t'){echo 'checked';} ?>>Valider</td>
            </tr>
            
            <tr><td><input type="submit" value="Enregistrer les modifications" /><tr><td>
                            
        </table>
    </form>
</html>