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
                           value="<?php echo $user->get_firstName() ?>" placeholder="<?php echo $user->get_firstName() ?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="name">Prénom</label>
                    <input type="text" name="name" id="name" maxlength="40" 
                           value="<?php echo $user->get_name() ?>" placeholder="<?php echo $user->get_name() ?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="adress">Adresse</label>
                    <input type="text" name="adress" id="adress" 
                           value="<?php echo $user->get_adress() ?>" placeholder="<?php echo $user->get_adress() ?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="phoneNumber">Numéro de téléphone</label>
                    <input type="text" name="phoneNumber" id="phoneNumber" 
                           value="<?php echo $user->get_phoneNumber() ?>" placeholder="<?php echo $user->get_phoneNumber() ?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="job">Profession</label>
                    <input type="text" name="job" id="job" 
                           value="<?php echo $user->get_job() ?>" placeholder="<?php echo $user->get_job() ?>"/>
                </td>
            </tr>
        </table>
        <h2>Sécurité</h2>
        <table>
            <tr>
                <td>
                    <label for="email">E-mail</label>
                    <input type="email" name="adress" id="adress" type="email"
                           value="<?php echo $user->get_email() ?>" placeholder="<?php echo $user->get_email() ?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="newPW">Nouveau mot de passe</label>
                    <input type="password" name="newPW" id="newPW" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="newPW2">Confirmer nouveau mot de passe</label>
                    <input type="password" name="newPW2" id="newPW2" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="enregistrer vos modifications" />
                </td>
            </tr>
        </table>
    </form>
    
</html>