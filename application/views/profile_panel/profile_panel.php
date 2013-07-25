

    <h1><?php echo $this->lang->line('user_profile_title'); ?></h1>
    
    <p> <?php echo sprintf($this->lang->line('user_profile_overview'),$user->get_userName(),
                           $this->lang->line('user_userlevel_'.$user->get_userLevel()));?></p>
    
    <p style="font-size : 11px;" ><?php echo $this->lang->line('user_profile_warning'); ?></p>
    <?php echo form_open('profile_panel/profile_panel/change_profile') ?>
        <h2><?php echo $this->lang->line('user_general_info'); ?></h2>
        <table>
            <tr>
                <td>
                    <label for="firstName"><?php echo $this->lang->line('user_family_name'); ?></label>
                    <input type="text" name="firstName" id="firstName" maxlength="40" 
                           value="<?php echo $user->get_firstName() ?>" />
                </td>
                <td class="error_form"><?php echo form_error('firstName'); ?></td>
            </tr>
            <tr>
                <td>
                    <label for="name"><?php echo $this->lang->line('user_first_name'); ?></label>
                    <input type="text" name="name" id="name" maxlength="40" 
                           value="<?php echo $user->get_name() ?>" />
                </td>
                <td class="error_form"><?php echo form_error('name'); ?></td>
            </tr>
            <tr>
                <td>
                    <label for="theAdress"><?php echo $this->lang->line('user_address'); ?></label>
                    <input type="text" name="theAdress" id="theAdress" 
                           value="<?php echo $user->get_adress() ?>" />
                </td>
                <td class="error_form"><?php echo form_error('theAdress'); ?></td>
            </tr>
            <tr>
                <td>
                    <label for="phoneNumber"><?php echo $this->lang->line('user_phone'); ?></label>
                    <input type="text" name="phoneNumber" id="phoneNumber" 
                           value="<?php echo $user->get_phoneNumber() ?>" />
                </td>
                <td class="error_form"><?php echo form_error('phoneNumber'); ?></td>
            </tr>
            <tr>
                <td>
                    <label for="job"><?php echo $this->lang->line('user_job'); ?></label>
                    <input type="text" name="job" id="job" 
                           value="<?php echo $user->get_job() ?>" />
                </td>
                <td class="error_form"><?php echo form_error('job'); ?></td>
            </tr>
        </table>
        <h2><?php echo $this->lang->line('user_security_info'); ?></h2>
        <table>
            <tr>
                <td>
                    <label for="email"><?php echo $this->lang->line('user_email'); ?></label>
                    <input type="email" name="email" id="email" 
                           value="<?php echo $user->get_email() ?>" />
                </td>
                <td class="error_form"><?php echo form_error('email'); ?></td>
            </tr>
            <tr>
                <td>
                    <label for="password"><?php echo $this->lang->line('user_password'); ?></label>
                    <input type="password" name="password" id="password" />
                </td>
                <td class="error_form"><?php echo form_error('password'); ?></td>
            </tr>
            <tr>
                <td>
                    <label for="newPW"><?php echo $this->lang->line('user_new_password'); ?></label>
                    <input type="password" name="newPW" id="newPW" />
                </td>
                <td class="error_form"><?php echo form_error('newPW'); ?></td>
            </tr>
            <tr>
                <td>
                    <label for="newPW2"><?php echo $this->lang->line('user_new_password2'); ?></label>
                    <input type="password" name="newPW2" id="newPW2" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="<?php echo $this->lang->line('user_save_profile'); ?>" />
                </td>
            </tr>
        </table>
    </form>
    
    <h2><?php echo $this->lang->line('user_lang_settings'); ?></h2>
    <p style="font-size : 11px;" >
        <?php echo $this->lang->line('user_lang_warning'); ?>
    </p>
        
<?php echo form_open('profile_panel/profile_panel/change_lang'); ?>
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