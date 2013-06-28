<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

	<h1>Formulaire d'ajout d'une relation entre <?php echo $objet1->get_nom_objet().' et '.$objet2->get_nom_objet();?></h1>
        
        <?php echo form_open('moderation/modify_objet/add_relation_form'); ?>
        
        <table>
        
            <tr>
                    <td> Selectionner le type de relation :</td>
                    <td> <select name="type_relation">
                            <?php foreach($type_relation_list as $type_relation): 
                                    echo '<option value="'.$type_relation['type_relation_id'].'">'.$type_relation['type_relation'].'</option>'; 
                                  endforeach; ?>
                            
                         </select> </td>
            </tr>
            
        </table>
        <table>
            
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
                    <td> Date début secondaire </td>
                    <td> <input type=text size=30 name=datation_indication_debut value="<?php echo set_value('datation_indication_debut'); ?>"> </td>
                    <td class="error_form"><?php echo form_error('datation_indication_debut'); ?></td>
            </tr>
            <tr>
                    <td> Date fin secondaire </td>
                    <td> <input type=text size=30 name=datation_indication_fin value="<?php echo set_value('datation_indication_fin'); ?>"> </td>
                    <td class="error_form"><?php echo form_error('datation_indication_fin'); ?></td>
            </tr>
            <tr>
                    <td>Relation Parent-Enfant</td>
                    <td><input type="checkbox" name=parent value=1 /></td>
            </tr>
            
            <tr>
                <td>
                    <input type="hidden" name="objet1_id" value="<?php echo $objet1->get_objet_id(); ?>" />
                    <input type="hidden" name="objet2_id" value="<?php echo $objet2->get_objet_id(); ?>" />
                    <input type="submit" value="Ajouter cette ressource" />                 
                </td>
            </tr>
                        
        </table>