<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >

    <table>
        
        <h1><?php echo $titre; ?></h1>
        
	<?php echo form_open('login'); ?>

	<tr><td>Nom d'utilisateur:</td></tr>
        <tr>
            <td><input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" /></td>
            <td class="error_form"><?php echo form_error('username'); ?></td>
        </tr>
	<tr><td>Mot de passe :</td></tr>
        <tr>
            <td><input type="password" name="password" value="" size="50" /></td>
            <td class="error_form"><?php echo form_error('password'); ?></td>
        </tr>
	<tr><td><input type="submit" value="Connexion" /></td></tr>

	</form>
    </table>
	<p><?php echo anchor('accueil/signin', 'Nouveau sur le site ? Cliquez-ici pour vous inscrire'); ?></p>

</html>
