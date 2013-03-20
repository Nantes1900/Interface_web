<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

	<h1>Formulaire d'ajout d'un objet historique</h1>
        
        <?php echo form_open('data_center/ajout_objet'); ?>
        
        <table border=0>
		
            <tr> 
                    <td> Nom </td> 
                    <td> <input type=text name=nom_objet value="<?php echo set_value('nom_objet'); ?>" size="30"/> </td>
                    <td class="error_form"><?php echo form_error('nom_objet'); ?></td>
            </tr>
            <tr> 
                    <td> Résumé </td>
                    <td> <textarea name=resume value="<?php echo set_value('resume'); ?>" rows="10" cols="75"></textarea> </td>
                    <td class="error_form"><?php echo form_error('resume'); ?></td>
            </tr>
            <tr>
                    <td> Historique </td>
                    <td> <textarea name=historique value="<?php echo set_value('historique'); ?>" rows="10" cols="75"></textarea> </td>
                    <td class="error_form"><?php echo form_error('historique'); ?></td>
            </tr>
            <tr>
                    <td> Description </td>
                    <td> <textarea name=description value="<?php echo set_value('description'); ?>" rows="5" cols="75"></textarea> </td>
                    <td class="error_form"><?php echo form_error('description'); ?></td>
            </tr>
            <tr>
                    <td> Adresse Postale </td>
                    <td> <input type=text name=adresse_postale value="<?php echo set_value('adresse_postale'); ?>" size="30"/> </td>
                    <td class="error_form"><?php echo form_error('adresse_postale'); ?></td>
            </tr>
            <tr>
                    <td> Mots-clés </td>
                    <td> <textarea name=mots_cles value="<?php echo set_value('mots_cles'); ?>" rows="2" cols="75"></textarea> </td>
                    <td class="error_form"><?php echo form_error('mots_cles'); ?></td>
            </tr>
            
            <tr><td><input type="submit" value="Ajouter cet objet" /><tr><td>
                            
        </table>
	

</html>
