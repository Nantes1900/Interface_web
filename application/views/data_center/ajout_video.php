<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

    <h1>Formulaire d'ajout d'une ressource video </h1>
    
   
    <div style="color : red;"><?php echo $error;?></div>    
    
    <?php echo form_open_multipart('data_center/ajout_ressource/formulaire_video'); ?>
    
        <table border=0>
		
            <tr> 
                <td> Titre </td> 
                <td> <input type=text name=titre value="<?php echo set_value('titre'); ?>" size="30"/> </td>
                <td class="error_form"><?php echo form_error('titre'); ?></td>
            </tr>
            <tr>
                <td> Description </td>
                <td> <textarea name=description value="<?php echo set_value('description'); ?>" rows="5" cols="75"><?php echo set_value('description'); ?></textarea> </td>
                <td class="error_form"><?php echo form_error('description'); ?></td>
            </tr>
            <tr>
                <td> Référence </td>
                <td> <input type=text name=reference_ressource value="<?php echo set_value('reference_ressource'); ?>" size="30"/> </td>
                <td class="error_form"><?php echo form_error('reference_ressource'); ?></td>
            </tr>
            <tr>
                <td> Disponibilité </td>
                <td> <input type="text" name=disponibilite value="<?php echo set_value('disponibilite'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('disponibilite'); ?></td>
            </tr>
            <tr>
                <td> Thème de la ressource </td>
                <td> <input type="text" name=theme_ressource value="<?php echo set_value('theme_ressource'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('theme_ressource'); ?></td>
            </tr>
            <tr>
                <td> Auteur(s) </td>
                <td> <input type="text" name=auteurs value="<?php echo set_value('auteurs'); ?>" size="30"></td>
                <td class="error_form"><?php echo form_error('auteurs'); ?></td>
            </tr>
            <tr>
                <td> Editeur </td>
                <td> <input type="text" name=editeur value="<?php echo set_value('editeur'); ?>" size="30"></td>
                <td class="error_form"><?php echo form_error('editeur'); ?></td>
            </tr>
            <tr>
                <td> Ville d'édition </td>
                <td> <input type="text" name=ville_edition value="<?php echo set_value('ville_edition'); ?>" size="30"></td>
                <td class="error_form"><?php echo form_error('ville_edition'); ?></td>
            </tr>
            
        </table>
        <table>
        
            <tr>
                <td> Date d'édition </td>
            </tr>
            <tr>
		<td> Jour </td>
                <td> <input type=text name=jour value="<?php echo set_value('jour'); ?>" size="3" maxlength="2"> </td>
		<td> Mois </td>
		<td> <input type=text name=mois value="<?php echo set_value('mois'); ?>" size="3" maxlength="2"> </td>
		<td> Année </td>
		<td> <input type=text name=annee value="<?php echo set_value('annee'); ?>" size="5" maxlength="4"> </td>
            </tr>
            <tr>
                <td class="error_form"><?php echo form_error('jour'); ?></td>
                <td class="error_form"><?php echo form_error('mois'); ?></td>
                <td class="error_form"><?php echo form_error('annee'); ?></td>
            </tr>
         
        </table>
    <table>
        
            <tr>
                <td> Date de production </td>
            </tr>
            <tr>
		<td> Jour </td>
                <td> <input type=text name=jourProd value="<?php echo set_value('jourProd'); ?>" size="3" maxlength="2"> </td>
		<td> Mois </td>
		<td> <input type=text name=moisProd value="<?php echo set_value('moisProd'); ?>" size="3" maxlength="2"> </td>
		<td> Année </td>
		<td> <input type=text name=anneeProd value="<?php echo set_value('anneeProd'); ?>" size="5" maxlength="4"> </td>
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
                <td> <textarea name=mots_cles value="<?php echo set_value('mots_cles'); ?>" rows="2" cols="75"></textarea> </td>
                <td class="error_form"><?php echo form_error('mots_cles'); ?></td>
            </tr>
            <tr>
                <td> Durée (en minutes)</td>
                <td> <input type="text" name="duree" value="<?php echo set_value('duree'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('duree'); ?></td>
            </tr>
            <tr>
                <td> Diffusion </td>
                <td> <input type="text" name="diffusion" value="<?php echo set_value('diffusion'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('diffusion'); ?></td>
            </tr>
            <tr>
                <td> Version de la vidéo </td>
                <td> <input type="text" name="versionvideo" value="<?php echo set_value('versionvideo'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('versionvideo'); ?></td>
            </tr>
            <tr>
                <td> Distribution </td>
                <td> <input type="text" name="distribution" value="<?php echo set_value('distribution'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('distribution'); ?></td>
            </tr>
            <tr>
                <td> Production </td>
                <td> <input type="text" name="production" value="<?php echo set_value('production'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('production'); ?></td>
            </tr>
            <tr>
                <td> Télécharger vidéo </td>
                <td> 
                    <input type="file" name="video">
                </td>                
            </tr>
            <tr><td><input type="submit" value="Ajouter cette ressource" /><tr><td>
        </table>
    </form>
</html>