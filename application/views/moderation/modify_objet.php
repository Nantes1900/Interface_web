<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

	<h1>Modification de l'objet : <?php echo $objet->get_nom_objet(); ?></h1>
        
        <?php echo form_open('moderation/modifiy_objet'); ?>
        
        <table border=0>
		
            <tr> 
                    <td> Nom </td> 
                    <td> <input type=text name=nom_objet value="<?php $objet->get_nom_objet(); ?>" size="30"/> </td>
                    <td class="error_form"><?php echo form_error('nom_objet'); ?></td>
            </tr>
            <tr> 
                    <td> Résumé </td>
                    <td> <textarea name=resume value="<?php echo $objet->get_resume(); ?>" rows="10" cols="75"><?php echo $objet->get_resume(); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('resume'); ?></td>
            </tr>
            <tr>
                    <td> Historique </td>
                    <td> <textarea name=historique value="<?php echo $objet->get_historique(); ?>" rows="10" cols="75"><?php echo $objet->get_resume(); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('historique'); ?></td>
            </tr>
            <tr>
                    <td> Description </td>
                    <td> <textarea name=description value="<?php echo $objet->get_description(); ?>" rows="5" cols="75"><?php echo $objet->get_description(); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('description'); ?></td>
            </tr>
            <tr>
                    <td> Adresse Postale </td>
                    <td> <input type=text name=adresse_postale value="<?php echo $objet->get_adresse_postale(); ?>" size="30"/> </td>
                    <td class="error_form"><?php echo form_error('adresse_postale'); ?></td>
            </tr>
            <tr>
                    <td> Mots-clés </td>
                    <td> <textarea name=mots_cles value="<?php echo $objet->get_mots_cles(); ?>" rows="2" cols="75"><?php echo $objet->get_mots_cles(); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('mots_cles'); ?></td>
            </tr>
            
            <tr>
                <td><input type="checkbox" name="validation" value="TRUE">Validé</td>
            </tr>
            
            <tr><td><input type="submit" value="Ajouter cet objet" /><tr><td>
                            
        </table>
</form>

</html>
