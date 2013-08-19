

<table>

    <p>
        <?php echo $this->lang->line('common_welcome_warning'); ?>
    </p>

    <h1><?php echo $titre; ?></h1>

    <?php echo form_open('accueil/login'); ?>

    <tr><td><?php echo $this->lang->line('common_username'); ?></td></tr>
    <tr>
        <td><input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" /></td>
        <td class="error_form"><?php echo form_error('username'); ?></td>
    </tr>
    <tr><td><?php echo $this->lang->line('common_password'); ?></td></tr>
    <tr>
        <td><input type="password" name="password" value="" size="50" /></td>
        <td class="error_form"><?php echo form_error('password'); ?></td>
    </tr>
    <tr><td><input type="submit" value="<?php echo $this->lang->line('common_login'); ?>" /></td></tr>

</form>
</table>

<p><?php echo anchor('accueil/accueil/signin', $this->lang->line('common_signin_link')); ?></p>

<p>
    <button class="forgotPW">Mot de passe oublié?</button>
    <?php echo form_open(); ?>
    <div class="message" style="display:none; left:15%; top:40%; ">
        <p>
            Veuillez entrer votre pseudo et e-mail
        </p>
        <table>
            <tr><td>Pseudo : </td><td><input type="text" name="username" value=""> </td></tr>
            <tr><td>E-mail : </td><td><input type="text" name="email" value=""> </td></tr>
        </table>
        <input type="submit" value="Réinitialiser mon mot de passe" />
        <button type="reset" class="closePopup"><?php echo $this->lang->line('common_cancel'); ?></button>
        <?php echo img(array('src' => 'assets/utils/close.png', 'alt' => 'fermer', 'width' => '4%',
            'class' => 'removePopup'));?>
        
    </div>
    <?php echo form_close(); ?>
</p>
<h2><?php echo $this->lang->line('common_lang_title'); ?></h2>
<?php echo form_open('accueil/accueil/change_lang'); ?>
<select name="language" id="language">
    <option value="french" <?php if ($this->session->userdata('language') == 'french') {
    echo 'selected';
} ?>>
        Français
    </option>
    <option value="english" <?php if ($this->session->userdata('language') == 'english') {
    echo 'selected';
} ?>>
        English
    </option>
</select>
<button type="submit"> <?php echo $this->lang->line('common_change_lang'); ?> </button>
</form>

