<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

    <h1>Centre d'administration</h1>
    
    <h2>Liste des membres</h2>
    
<!--    sorting form-->
    <?php echo form_open('admin_panel/admin_panel/index') ?>
        <label for="speUserLevel">Niveau spécifique:</label>
        <select name="speUserLevel" id="speUserLevel">
            <option value="null" selected>Tous</option>
            <option value="1">Visiteur</option>
            <option value="3">Informateur</option>
            <option value="4">Moderateur</option>
            <option value="5">Chercheur</option>
            <option value="9">Administrateur</option>
        </select>
        <br/>
        <label for="orderBy">Trier par:</label>
        <select name="orderBy" id="orderBy">
            <option value="username">Nom d'utilisateur</option>
            <option value="user_level">Niveau d'utilisateur</option>
            <option value="timestamp">Date de création</option>
            <option value="nom">Nom</option>
            <option value="prenom">Prenom</option>
            <option value="adresse_postale">Adresse</option>
            <option value="email">e-mail</option>
            <option value="telephone">Téléphone</option>
            <option value="profession">Profession</option>
        </select>
        <select name="orderDirection">
            <option value="asc">Croissant</option>
            <option value="desc">Décroissant</option>
        </select>
        <br/>
        <label for="speAttribute">Rechercher un(e):</label>
        <select name="speAttribute" id="speAttribute">
            <option value="username">Nom d'utilisateur</option>
<!--            <option value="timestamp">Date de création</option> doesn't work-->
            <option value="nom">Nom</option>
            <option value="prenom">Prenom</option>
            <option value="adresse_postale">Adresse</option>
            <option value="email">e-mail</option>
            <option value="telephone">Téléphone</option>
            <option value="profession">Profession</option>
        </select>
        <input type="text" name="speAttributeValue" maxlength="50"/>
        <br/>
        <input type="submit" value="Trier" />
    </form>
    
<!--    list of users-->
    <div class="classyTable">
    <table>
        <thead>
            <tr>
                <th>Pseudo</th><th>User Level</th><th>Creation Date</th><th>First Name</th><th>Name</th>
                <th>Adress</th><th>E-mail</th><th>Phone Number</th><th>Job</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listUser as $user) {        ?>
                <tr>
                    <td><?php echo $user->get_userName(); ?></td>
                    <td>
                        <?php echo form_open('admin_panel/admin_panel/change_level') ?>
                            <input type="hidden" name="username" value="<?php echo $user->get_userName(); ?>" />
                                <select name="userLevel">
                                    <option value="1" <?php if ($user->get_userLevel()==1){echo 'selected';}?>>Visiteur</option>
                                    <option value="3" <?php if ($user->get_userLevel()==3){echo 'selected';}?>>Informateur</option>
                                    <option value="4" <?php if ($user->get_userLevel()==4){echo 'selected';}?>>Moderateur</option>
                                    <option value="5" <?php if ($user->get_userLevel()==5){echo 'selected';}?>>Chercheur</option>
                                    <option value="9" <?php if ($user->get_userLevel()==9){echo 'selected';}?>>Administrateur</option>
                                </select>    
                            <input type="submit" value="changer le niveau d'utilisateur" />
                        </form>
                    </td>
                    <td><?php echo date('d/m/Y',$user->get_creationDate()); ?></td>
                    <td><?php echo $user->get_firstName(); ?></td>
                    <td><?php echo $user->get_name(); ?></td>
                    <td><?php echo $user->get_adress(); ?></td>
                    <td><?php echo $user->get_email(); ?></td>
                    <td><?php echo $user->get_phoneNumber(); ?></td>
                    <td><?php echo $user->get_job(); ?></td>
                </tr>
            <?php }  ?>
        </tbody>
    </table>
    </div>
</html>