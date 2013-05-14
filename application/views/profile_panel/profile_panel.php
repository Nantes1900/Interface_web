<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

    <h1>Profil personnel</h1>
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
            </tr>
            <tr>
                <td>
                    <label for="name">Prénom</label>
                    <input type="text" name="name" id="name" maxlength="40" 
                           value="<?php echo $user->get_name() ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="theAdress">Adresse</label>
                    <input type="text" name="theAdress" id="theAdress" 
                           value="<?php echo $user->get_adress() ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="phoneNumber">Numéro de téléphone</label>
                    <input type="text" name="phoneNumber" id="phoneNumber" 
                           value="<?php echo $user->get_phoneNumber() ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="job">Profession</label>
                    <input type="text" name="job" id="job" 
                           value="<?php echo $user->get_job() ?>" />
                </td>
            </tr>
        </table>
        <h2>Sécurité</h2>
        <table>
            <tr>
                <td>
                    <label for="email">E-mail</label>
                    <input type="email" name="adress" id="adress" type="email"
                           value="<?php echo $user->get_email() ?>" />
                </td>
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
    
</html>