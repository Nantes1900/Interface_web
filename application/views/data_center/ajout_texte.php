<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

	<h1>Formulaire d'ajout d'une ressource textuelle (livre, lettre, etc.)</h1>
        
        <?php echo form_open('data_center/ajout_ressource/formulaire_texte'); ?>
        
        <table border=0>
		
            <tr> 
                    <td> Titre </td> 
                    <td> <input type=text name=titre value="<?php echo set_value('titre'); ?>" size="30"/> </td>
                    <td class="error_form"><?php echo form_error('titre'); ?></td>
            </tr>
            <tr>
                    <td> Description </td>
                    <td> <textarea name=description value="<?php echo set_value('description'); ?>" rows="5" cols="75"></textarea> </td>
                    <td class="error_form"><?php echo form_error('description'); ?></td>
            </tr>
            <tr>
                    <td> Référence </td>
                    <td> <input type=text name=reference_ressource value="<?php echo set_value('reference_ressource'); ?>" size="30"/> </td>
                    <td class="error_form"><?php echo form_error('reference_ressource'); ?></td>
            </tr>
            <tr>
                    <td> Disponibilité </td>
                    <td> <input type="text" name=disponibilite value="<?php echo set_value('disponibilite'); ?>" size="30"></textarea> </td>
                    <td class="error_form"><?php echo form_error('disponibilite'); ?></td>
            </tr>
            <tr>
                    <td> Auteur(s) </td>
                    <td> <input type="text" name=auteurs value="<?php echo set_value('auteurs'); ?>" size="30"></textarea> </td>
                    <td class="error_form"><?php echo form_error('auteurs'); ?></td>
            </tr>
            <tr>
                    <td> Editeur </td>
                    <td> <input type="text" name=editeur value="<?php echo set_value('editeur'); ?>" size="30"></textarea> </td>
                    <td class="error_form"><?php echo form_error('editeur'); ?></td>
            </tr>
            <tr>
                    <td> Ville d'édition </td>
                    <td> <input type="text" name=ville_edition value="<?php echo set_value('ville_edition'); ?>" size="30"></textarea> </td>
                    <td class="error_form"><?php echo form_error('ville_edition'); ?></td>
            </tr>
            
        </table>
        <table>
        
            <tr>
                    <td> Date d'édition </td>
            </tr>
            <tr>
			<td> Jour </td>
			<td> <input type=text name=jour value="<?php echo set_value('jour'); ?>" size="3"> </td>
			<td> Mois </td>
			<td> <input type=text name=mois value="<?php echo set_value('mois'); ?>" size="3"> </td>
			<td> Année </td>
			<td> <input type=text name=annee value="<?php echo set_value('annee'); ?>" size="5"> </td>
            </tr>
            <tr>
                <td class="error_form"><?php echo form_error('jour'); ?></td>
                <td class="error_form"><?php echo form_error('mois'); ?></td>
                <td class="error_form"><?php echo form_error('annee'); ?></td>
            </tr>
         
        </table>    
        <table>
            
            <tr>
                    <td> Mots-clés </td>
                    <td> <textarea name=mots_cles value="<?php echo set_value('mots_cles'); ?>" rows="2" cols="75"></textarea> </td>
                    <td class="error_form"><?php echo form_error('mots_cles'); ?></td>
            </tr>
            <tr>
                    <td> Sous-catégorie </td>
                    <td> <input type="text" name="sous_categorie" value="<?php echo set_value('sous_categorie'); ?>" size="30"> </td>
                    <td class="error_form"><?php echo form_error('sous_categorie'); ?></td>
            </tr>  
            <tr>
                    <td> Pagination </td>
                    <td> <input type="text" name="pagination" value="<?php echo set_value('pagination'); ?>"> </td>
                    <td class="error_form"><?php echo form_error('pagination'); ?></td>
            </tr>
            
            <tr><td><input type="submit" value="Ajouter cette ressource" /><tr><td>
                            
        </table>
