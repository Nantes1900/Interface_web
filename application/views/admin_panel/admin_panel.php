

    <h1>Centre d'administration</h1>
    
    <h2>Liste des membres</h2>
    
<!--    sorting form-->
    <?php echo form_open('admin_panel/admin_panel/index') ?>
        <label for="speUserLevel">Niveau spécifique:</label>
        <select name="speUserLevel" id="speUserLevel">
            <option value="null" selected>Tous</option>
            <option value="1">Visiteur</option>
            <option value="3">Informateur</option>
            <option value="4">Chercheur</option>
            <option value="5">Moderateur</option>
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
                <th>Pseudo</th><th>Niveau utilisateur</th><th>Date de création</th><th>Nom</th><th>Prénom</th>
                <th>Adresse</th><th>E-mail</th><th>Numéro de téléphone</th><th>Profession</th>
                <th class="hint">
                    Supprimer
                    <span>
                        Vous ne pouvez supprimer que les utilisateurs qui n'ont 
                        jamais effectué de contribution au site 
                    </span>
                </th>
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
                                    <option value="0" <?php if ($user->get_userLevel()==0){echo 'selected';}?>>Non validé</option>
                                    <option value="1" <?php if ($user->get_userLevel()==1){echo 'selected';}?>>Visiteur</option>
                                    <option value="3" <?php if ($user->get_userLevel()==3){echo 'selected';}?>>Informateur</option>
                                    <option value="4" <?php if ($user->get_userLevel()==4){echo 'selected';}?>>Chercheur</option>
                                    <option value="5" <?php if ($user->get_userLevel()==5){echo 'selected';}?>>Moderateur</option>
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
                    <td>
                        <?php if ($user->get_contribution()<1){
                                echo form_open('admin_panel/admin_panel/delete_user/'.$user->get_userName()) ?>   
                                    <div class="message" style="left:15%; top:40%; display:none">
                                        <p>
                                            Vous vous apprêtez à supprimer définitivement <em><?php echo $user->get_userName(); ?></em>,
                                             êtes vous certain de ne pas plutôt vouloir l'invalider?
                                        </p>
                                        <input type="submit" value="Supprimer cet utilisateur" />
                                        <?php echo img(array('src'=>'assets/utils/close.png','alt'=>'fermer','width'=>'4%', 
                                                         'class'=>'removePopup')); ?>
                                    </div>
                                </form>
                                <button class="removePopup"> Supprimer </button>
                        <?php } else {
                                echo 'Contributeur actif';
                        } ?>
                    </td>
                </tr>
            <?php }  ?>
        </tbody>
    </table>
    </div>

<script src="<?php echo base_url();?>assets/js/removepopup.js"></script>