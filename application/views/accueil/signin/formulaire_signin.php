

    <table>

	<?php echo form_open('accueil/signin'); ?>

	<tr><td><?php echo ($this->lang->line('common_username')); ?></td></tr>
        <tr>
            <td><input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" /></td>
            <td class="error_form"><?php echo form_error('username'); ?></td>
        </tr>
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
        <tr><td><?php echo ($this->lang->line('signin_lastname')); ?></td></tr>
        <tr>
            <td><input type="text" name="nom" value="<?php echo set_value('nom'); ?>" size="50" /></td>
            <td class="error_form"><?php echo form_error('nom'); ?></td>
        </tr>
        <tr><td><?php echo ($this->lang->line('signin_firstname')); ?></td></tr>
        <tr>
            <td><input type="text" name="prenom" value="<?php echo set_value('prenom'); ?>" size="50" /></td>
            <td class="error_form"><?php echo form_error('prenom'); ?></td>
        </tr>
        <tr><td><?php echo ($this->lang->line('signin_email_adress')); ?></td></tr>
        <tr>
            <td><input type="email" name="email" value="<?php echo set_value('email'); ?>" size="50" /></td>
            <td class="error_form"><?php echo form_error('email'); ?></td>
        </tr>
	
        <tr><td><input type="submit" value="<?php echo ($this->lang->line('signin_validate')); ?>" /><tr><td>

	</form>
    </table>


