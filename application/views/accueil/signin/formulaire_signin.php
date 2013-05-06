<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >

    <table>

	<?php echo form_open('signin'); ?>

	<tr><td>Nom d'utilisateur:</td></tr>
        <tr>
            <td><input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" /></td>
            <td class="error_form"><?php echo form_error('username'); ?></td>
        </tr>
        <tr><td>Choisissez un mot de passe :</td></tr>
        <tr>
            <td><input type="password" name="password1" value="" size="50" /></td>
            <td class="error_form"><?php echo form_error('password1'); ?></td>
        </tr>
        <tr><td>Retapez votre mot de passe :</td></tr>
        <tr>
            <td><input type="password" name="password2" value="" size="50" /></td>
            <td class="error_form"><?php echo form_error('password2'); ?></td>
        </tr>
        <tr><td>Nom :</td></tr>
        <tr>
            <td><input type="text" name="nom" value="<?php echo set_value('nom'); ?>" size="50" /></td>
            <td class="error_form"><?php echo form_error('nom'); ?></td>
        </tr>
        <tr><td>Prénom :</td></tr>
        <tr>
            <td><input type="text" name="prenom" value="<?php echo set_value('prenom'); ?>" size="50" /></td>
            <td class="error_form"><?php echo form_error('prenom'); ?></td>
        </tr>
	
        <tr><td><input type="submit" value="Cr&eacute;er un compte" /><tr><td>

	</form>
    </table>

</html>
