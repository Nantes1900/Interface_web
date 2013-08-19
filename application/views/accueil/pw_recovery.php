<?php echo form_open('accueil/login/set_new_password/'.$cryptedUsername); ?>

    <h1><?php echo $username;?> vous pouvez entrer ici votre nouveau mot de passe</h1>

    <table>
        <tr><td><?php echo ($this->lang->line('signin_choose_pw')); ?></td></tr>
        <tr>
            <td><input type="password" name="password1" value="" size="50" /></td>
            <td class="error_form"><?php echo form_error('password1'); ?></td>
        </tr>
        <tr><td><?php echo ($this->lang->line('signin_confirm_pw')); ?></td></tr>
        <tr>
            <td><input type="password" name="password2" value="" size="50" /></td>
            <td class="error_form"><?php echo form_error('password2'); ?></td>
        </tr>
    </table>

    <tr><td><input type="submit" value="<?php echo 'Réinitialiser le mot de passe'; ?>" /><tr><td>
        
<?php echo form_close(); ?> 