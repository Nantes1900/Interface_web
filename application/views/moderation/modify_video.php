<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

    <h1>Modification de la ressource vidéo : <?php echo $ressource->get_titre(); ?></h1>
        
    <?php echo form_open_multipart('moderation/modify_ressource/index/ressource_video'); ?>
        <input type="hidden" name="ressource_id" value="<?php echo $ressource->get_ressource_video_id(); ?>" />
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
                <td> Date de production </td>
            </tr>
            <tr>
                <?php $arrayDate = break_date_Ymd($ressource->get_date_production()); ?>
		<td> Jour </td>
                <td> <input type=text name=jourProd value="<?php echo $arrayDate['day']; ?>" size="3" maxlength="2"> </td>
		<td> Mois </td>
		<td> <input type=text name=moisProd value="<?php echo $arrayDate['month']; ?>" size="3" maxlength="2"> </td>
		<td> Année </td>
		<td> <input type=text name=anneeProd value="<?php echo $arrayDate['year']; ?>" size="5" maxlength="4"> </td>
            </tr>
            <tr>
                <td class="error_form"><?php echo form_error('jourProd'); ?></td>
                <td class="error_form"><?php echo form_error('moisProd'); ?></td>
                <td class="error_form"><?php echo form_error('anneeProd'); ?></td>
            </tr>
        </table>    
        <table>
            
            <tr>
                <td> Mots-clés </td>
                <td> <textarea name=mots_cles value="<?php echo $ressource->get_mots_cles(); ?>" rows="2" cols="75"><?php echo $ressource->get_mots_cles(); ?></textarea> </td>
                <td class="error_form"><?php echo form_error('mots_cles'); ?></td>
            </tr>
            <tr>
                <td> Durée (en minutes)</td>
                <td> <input type="text" name="duree" value="<?php echo $ressource->get_duree(); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('duree'); ?></td>
            </tr>
            <tr>
                <td> Diffusion </td>
                <td> <input type="text" name="diffusion" value="<?php echo $ressource->get_diffusion(); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('diffusion'); ?></td>
            </tr>
            <tr>
                <td> Version de la vidéo </td>
                <td> <input type="text" name="versionvideo" value="<?php echo $ressource->get_versionvideo(); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('versionvideo'); ?></td>
            </tr>
            <tr>
                <td> Distribution </td>
                <td> <input type="text" name="distribution" value="<?php echo $ressource->get_distribution(); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('distribution'); ?></td>
            </tr>
            <tr>
                <td> Production </td>
                <td> <input type="text" name="production" value="<?php echo $ressource->get_production(); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('production'); ?></td>
            </tr>
            <tr>
                <td> Télécharger vidéo </td>
                <td> 
                    <input type="file" name="video">
                </td>                
            </tr>
            <tr>
                <td> Lien vers la page hébergeant vidéo </td>
                <td> <input type="text" name="video_link" value="<?php echo $ressource->get_video_link(); ?>" size="30" maxlength="255"> </td>
                <td class="error_form"><?php echo form_error('video_link'); ?></td>              
            </tr>
            <tr>
                <td><input type="checkbox" name="validation" value="TRUE" <?php if($ressource->get_validation()=='t'){echo 'checked';} ?>>Valider</td>
            </tr>
            
            <tr><td><input type="submit" value="Enregistrer les modifications" /><tr><td>
                            
        </table>
    </form>
</html>