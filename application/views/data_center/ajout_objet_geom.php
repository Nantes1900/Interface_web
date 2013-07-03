<h1>Formulaire d'ajout d'un objet historique positionné sur la carte</h1>
        
<?php echo form_open('data_center/ajout_objet/formulaire_objet_geo/'.$latitude.'/'.$longitude); ?>
        
        <table border=0>
		
            <tr> 
                    <td> Nom </td> 
                    <td> <input type=text name=nom_objet value="<?php echo set_value('nom_objet'); ?>" size="30"/> </td>
                    <td class="error_form"><?php echo form_error('nom_objet'); ?></td>
            </tr>
            <tr> 
                    <td> Résumé </td>
                    <td> <textarea name=resume value="<?php echo set_value('resume'); ?>" rows="10" cols="75"><?php echo set_value('resume'); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('resume'); ?></td>
            </tr>
            <tr>
                    <td> Historique </td>
                    <td> <textarea name=historique value="<?php echo set_value('historique'); ?>" rows="10" cols="75"><?php echo set_value('historique'); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('historique'); ?></td>
            </tr>
            <tr>
                    <td> Description </td>
                    <td> <textarea name=description value="<?php echo set_value('description'); ?>" rows="5" cols="75"><?php echo set_value('description'); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('description'); ?></td>
            </tr>
            <tr>
                    <td> Adresse Postale </td>
                    <td> <input type=text name=adresse_postale value="<?php echo set_value('adresse_postale'); ?>" size="30"/> </td>
                    <td class="error_form"><?php echo form_error('adresse_postale'); ?></td>
            </tr>
            <tr>
                    <td> Mots-clés </td>
                    <td> <textarea name=mots_cles value="<?php echo set_value('mots_cles'); ?>" rows="2" cols="75"><?php echo set_value('mots_cles'); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('mots_cles'); ?></td>
            </tr>
        </table>
        <table>
            <tr>
                <td> Date de début </td>
            </tr>
            <tr>
                <td> Jour </td>
		<td> <input type=text name=jour_debut value="<?php echo set_value('jour_debut'); ?>" size="3" maxlength="2"> </td>
		<td> Mois </td>
		<td> <input type=text name=mois_debut value="<?php echo set_value('mois_debut'); ?>" size="3" maxlength="2"> </td>
		<td> Année </td>
		<td> <input type=text name=annee_debut value="<?php echo set_value('annee_debut'); ?>" size="5" maxlength="4"> </td>
            </tr>
            <tr>
                <td class="error_form"><?php echo form_error('jour_debut'); ?></td>
                <td class="error_form"><?php echo form_error('mois_debut'); ?></td>
                <td class="error_form"><?php echo form_error('annee_debut'); ?></td>
            </tr>
        </table>   
        
        <table>
            <tr>
                <td> Date de fin</td>
            </tr>
            <tr>
                <td> Jour </td>
		<td> <input type=text name=jour_fin value="<?php echo set_value('jour_fin'); ?>" size="3" maxlength="2"> </td>
		<td> Mois </td>
		<td> <input type=text name=mois_fin value="<?php echo set_value('mois_fin'); ?>" size="3" maxlength="2"> </td>
		<td> Année </td>
		<td> <input type=text name=annee_fin value="<?php echo set_value('annee_fin'); ?>" size="5" maxlength="4"> </td>
            </tr>
            <tr>
                <td class="error_form"><?php echo form_error('jour_fin'); ?></td>
                <td class="error_form"><?php echo form_error('mois_fin'); ?></td>
                <td class="error_form"><?php echo form_error('annee_fin'); ?></td>
            </tr>
        </table> 
        
        <table>
            <tr>
                    <td> Indication début </td>
                    <td> <input type=text size=30 name=datation_indication_debut value="<?php echo set_value('datation_indication_debut'); ?>"> </td>
                    <td class="error_form"><?php echo form_error('datation_indication_debut'); ?></td>
            </tr>
            <tr>
                    <td> Indication fin </td>
                    <td> <input type=text size=30 name=datation_indication_fin value="<?php echo set_value('datation_indication_fin'); ?>"> </td>
                    <td class="error_form"><?php echo form_error('datation_indication_fin'); ?></td>
            </tr>
            <tr><td><input type="submit" value="Ajouter cet objet" /><tr><td>
                            
        </table>
</form>