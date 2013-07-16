

    <h1>Profil personnel</h1>
    
    <p> Vous êtes <?php echo $user->get_userName(); ?> et avez les droits suivants : <?php echo $user->get_userLevelType(); ?></p>
    
    <p style="font-size : 11px;" >Pour valider tout changement, renseignez votre mot de passe</p>
    <?php echo form_open('profile_panel/profile_panel/change_profile') ?>
        <h2>Informations générales</h2>
        <table>
            <tr>
                <td>
                    <label for="firstName">Nom</label>
                    <input type="text" name="firstName" id="firstName" maxlength="40" 
                           value="<?php echo $user->get_firstName() ?>" />
                </td>
                <td class="error_form"><?php echo form_error('firstName'); ?></td>
            </tr>
            <tr>
                <td>
                    <label for="name">Prénom</label>
                    <input type="text" name="name" id="name" maxlength="40" 
                           value="<?php echo $user->get_name() ?>" />
                </td>
                <td class="error_form"><?php echo form_error('name'); ?></td>
            </tr>
            <tr>
                <td>
                    <label for="theAdress">Adresse</label>
                    <input type="text" name="theAdress" id="theAdress" 
                           value="<?php echo $user->get_adress() ?>" />
                </td>
                <td class="error_form"><?php echo form_error('theAdress'); ?></td>
            </tr>
            <tr>
                <td>
                    <label for="phoneNumber">Numéro de téléphone</label>
                    <input type="text" name="phoneNumber" id="phoneNumber" 
                           value="<?php echo $user->get_phoneNumber() ?>" />
                </td>
                <td class="error_form"><?php echo form_error('phoneNumber'); ?></td>
            </tr>
            <tr>
                <td>
                    <label for="job">Profession</label>
                    <input type="text" name="job" id="job" 
                           value="<?php echo $user->get_job() ?>" />
                </td>
                <td class="error_form"><?php echo form_error('job'); ?></td>
            </tr>
        </table>
        <h2>Sécurité</h2>
        <table>
            <tr>
                <td>
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" 
                           value="<?php echo $user->get_email() ?>" />
                </td>
                <td class="error_form"><?php echo form_error('email'); ?></td>
            </tr>
            <tr>
                <td>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" />
                </td>
                <td class="error_form"><?php echo form_error('password'); ?></td>
            </tr>
            <tr>
                <td>
                    <label for="newPW">Nouveau mot de passe</label>
                    <input type="password" name="newPW" id="newPW" />
                </td>
                <td class="error_form"><?php echo form_error('newPW'); ?></td>
            </tr>
            <tr>
                <td>
                    <label for="newPW2">Confirmer nouveau mot de passe</label>
                    <input type="password" name="newPW2" id="newPW2" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Enregistrer vos modifications" />
                </td>
            </tr>
        </table>
    </form>
    
    <h2>Gestion de la langue</h2>
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