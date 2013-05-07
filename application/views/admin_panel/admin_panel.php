<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

    <h1>Admin panel</h1>
    
    <h2>Members</h2> 
   
    <table style="border : solid black">
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
                    <td><?php echo $user->get_userLevel(); ?></td>
                    <td><?php echo $user->get_creationDate(); ?></td>
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