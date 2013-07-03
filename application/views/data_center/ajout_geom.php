	<h1>Formulaire d'ajout d'une géométrie à l'objet historique <?php echo $objet->get_nom_objet(); ?></h1>
        
        <?php echo form_open('data_center/ajout_objet/geometry_form/'.$latitude.'/'.$longitude); ?>
        
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
            <tr>
                    <td> Mots-clés </td>
                    <td> <textarea name=mots_cles value="<?php echo set_value('mots_cles'); ?>" rows="2" cols="75"><?php echo set_value('mots_cles'); ?></textarea> </td>
                    <td class="error_form"><?php echo form_error('mots_cles'); ?></td>
            </tr>
            <tr><td><input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" /><tr><td>
            <tr><td><input type="submit" value="Ajouter cet objet" /><tr><td>
                            
        </table>
</form>