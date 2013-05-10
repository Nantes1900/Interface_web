<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

    <h1>Admin panel</h1>
    
    <h2>Members</h2> 

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
                        <input type="submit" value="Change user level" />
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

</html>