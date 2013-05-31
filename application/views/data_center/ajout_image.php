<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

    <h1>Formulaire d'ajout d'une ressource graphique (image, photo, etc.)</h1>
    
   
    <div style="color : red;"><?php echo $error;?></div>    
    
    <?php echo form_open_multipart('data_center/ajout_ressource/formulaire_image'); ?>
    
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
                <td> Date de prise de vue </td>
            </tr>
            <tr>
		<td> Jour </td>
                <td> <input type=text name=jourPrise value="<?php echo set_value('jourPrise'); ?>" size="3" maxlength="2"> </td>
		<td> Mois </td>
		<td> <input type=text name=moisPrise value="<?php echo set_value('moisPrise'); ?>" size="3" maxlength="2"> </td>
		<td> Année </td>
		<td> <input type=text name=anneePrise value="<?php echo set_value('anneePrise'); ?>" size="5" maxlength="4"> </td>
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
                <td> <textarea name=mots_cles value="<?php echo set_value('mots_cles'); ?>" rows="2" cols="75"></textarea> </td>
                <td class="error_form"><?php echo form_error('mots_cles'); ?></td>
            </tr>
            <tr>
                <td> Légende </td>
                <td> <input type="text" name="legende" value="<?php echo set_value('legende'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('legende'); ?></td>
            </tr>
            <tr>
                <td> Lieu de la prise de vue </td>
                <td> <input type="text" name="localisation" value="<?php echo set_value('localisation'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('localisation'); ?></td>
            </tr>
            <tr>
                <td> Technique utilisée </td>
                <td> <input type="text" name="technique" value="<?php echo set_value('technique'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('technique'); ?></td>
            </tr>
            <tr>
                <td> Support de la ressource </td>
                <td> <input type="text" name="type_support" value="<?php echo set_value('type_support'); ?>" size="30"> </td>
                <td class="error_form"><?php echo form_error('type_support'); ?></td>
            </tr>
            <tr>
                <td> Couleur </td>
                <td> 
                    <input type="radio" name="couleur" value="TRUE" <?php echo set_select('couleur', 'TRUE'); ?> >Couleur <br/>
                    <input type="radio" name="couleur" value="FALSE" <?php echo set_select('couleur', 'FALSE'); ?> >Noir et blanc
                </td>
                <td class="error_form"><?php echo form_error('couleur'); ?></td>
            </tr>
            <tr>
                <td> Télécharger image </td>
                <td> 
                    <input type="file" name="image">
                </td>                
            </tr>
            <tr>
                <td> URL image </td>
                <td> <input type="text" name="image_link" value="<?php echo set_value('image_link'); ?>" size="30" maxlength="255"> </td>
                <td class="error_form"><?php echo form_error('image_link'); ?></td>              
            </tr>
            <tr>
                <td> Pagination </td>
                <td> <input type="text" name="pagination" value="<?php echo set_value('pagination'); ?>"> </td>
                <td class="error_form"><?php echo form_error('pagination'); ?></td>
            </tr>
            <tr>
                    <td> Créer un lien de documentation vers un objet </td>
                    <td>
                        <select name="objet">
                            <option value=""> Aucun </option>
                            <?php foreach($objet_list as $objet): 
                                    echo '<option value="'.$objet->get_objet_id().'">'.$objet->get_nom_objet().'</option>'; 
                                  endforeach; ?>
                            
                        </select>
                    </td>
            </tr>
            <tr><td><input type="submit" value="Ajouter cette ressource" /><tr><td>
                            
        </table>
    </form>
</html>
        