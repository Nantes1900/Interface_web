
    <h1>Centre d'administration</h1>
    
    <h2>Liste des membres</h2>
    
<!--    sorting form-->
    <?php echo form_open('admin_panel/admin_panel/sort_admin_panel') ?>
        <label for="speUserLevel">Niveau spécifique:</label>
        <select name="speUserLevel" id="speUserLevel">
            <option value="null" <?php if($this->session->userdata('sel_admin_speUserLevel') == 'null'){ 
                                          echo 'selected'; 
                                       } ?>>
                Tous
            </option>
            <option value="0" <?php if($this->session->userdata('sel_admin_speUserLevel') == '0'){ 
                                          echo 'selected'; 
                                       } ?>>
                Utilisateur non validé
            </option>
            <option value="1" <?php if($this->session->userdata('sel_admin_speUserLevel') == '1'){ 
                                          echo 'selected'; 
                                       } ?>>
                Visiteur
            </option>
<!--            <option value="3" <?php if($this->session->userdata('sel_admin_speUserLevel') == '3'){ 
                                          echo 'selected'; 
                                       } ?>>
                Informateur
            </option>-->
            <option value="4" <?php if($this->session->userdata('sel_admin_speUserLevel') == '4'){ 
                                          echo 'selected'; 
                                       } ?>>
                Chercheur
            </option>
            <option value="5" <?php if($this->session->userdata('sel_admin_speUserLevel') == '5'){ 
                                          echo 'selected'; 
                                       } ?>>
                Moderateur
            </option>
            <option value="9" <?php if($this->session->userdata('sel_admin_speUserLevel') == '9'){ 
                                          echo 'selected'; 
                                       } ?>>
                Administrateur
            </option>
            <option value="10" <?php if($this->session->userdata('sel_admin_speUserLevel') == '10'){ 
                                          echo 'selected'; 
                                       } ?>>
                Super Administrateur
            </option>
            <option value="-1" <?php if($this->session->userdata('sel_admin_speUserLevel') == '-1'){ 
                                          echo 'selected'; 
                                       } ?>>
                Utilisateur banni
            </option>
        </select>
        <br/>
        <label for="orderBy">Trier par:</label>
        <select name="orderBy" id="orderBy">
            <option value="username" <?php if($this->session->userdata('sel_admin_orderBy') == 'username'){ 
                                                echo 'selected'; 
                                            } ?>>
                Nom d'utilisateur
            </option>
            <option value="user_level" <?php if($this->session->userdata('sel_admin_orderBy') == 'user_level'){ 
                                                echo 'selected'; 
                                             } ?>>
                Niveau d'utilisateur
            </option>
            <option value="timestamp" <?php if($this->session->userdata('sel_admin_orderBy') == 'timestamp'){ 
                                                echo 'selected'; 
                                             } ?>>
                Date de création
            </option>
            <option value="nom" <?php if($this->session->userdata('sel_admin_orderBy') == 'nom'){ 
                                                echo 'selected'; 
                                             } ?>>
                Nom
            </option>
            <option value="prenom" <?php if($this->session->userdata('sel_admin_orderBy') == 'prenom'){ 
                                                echo 'selected'; 
                                             } ?>>
                Prenom
            </option>
            <option value="adresse_postale" <?php if($this->session->userdata('sel_admin_orderBy') == 'adresse_postale'){ 
                                                echo 'selected'; 
                                             } ?>>
                Adresse
            </option>
            <option value="email" <?php if($this->session->userdata('sel_admin_orderBy') == 'email'){ 
                                                echo 'selected'; 
                                             } ?>>
                e-mail
            </option>
            <option value="telephone" <?php if($this->session->userdata('sel_admin_orderBy') == 'telephone'){ 
                                                echo 'selected'; 
                                             } ?>>
                Téléphone
            </option>
            <option value="profession" <?php if($this->session->userdata('sel_admin_orderBy') == 'profession'){ 
                                                echo 'selected'; 
                                             } ?>>
                Profession
            </option>
        </select>
        <select name="orderDirection">
            <option value="asc" <?php if($this->session->userdata('sel_admin_orderDirection') == 'asc'){ 
                                            echo 'selected'; 
                                      } ?>>
                Croissant
            </option>
            <option value="desc" <?php if($this->session->userdata('sel_admin_orderDirection') == 'desc'){ 
                                            echo 'selected'; 
                                      } ?>>
                Décroissant
            </option>
        </select>
        <br/>
        <label for="speAttribute">Rechercher un(e):</label>
        <select name="speAttribute" id="speAttribute">
            <option value="username" <?php if($this->session->userdata('sel_admin_speAttribute') == 'username'){ 
                                                echo 'selected'; 
                                           } ?>>
                Nom d'utilisateur
            </option>
            <option value="timestamp" <?php if($this->session->userdata('sel_admin_speAttribute') == 'timestamp'){ 
                                                echo 'selected'; 
                                            } ?>>
                Date de création
            </option> 
            <option value="nom" <?php if($this->session->userdata('sel_admin_speAttribute') == 'nom'){ 
                                            echo 'selected'; 
                                      } ?>>
                Nom
            </option>
            <option value="prenom" <?php if($this->session->userdata('sel_admin_speAttribute') == 'prenom'){ 
                                            echo 'selected'; 
                                         } ?>>
                Prenom
            </option>
            <option value="adresse_postale" <?php if($this->session->userdata('sel_admin_speAttribute') == 'adresse_postale'){ 
                                                        echo 'selected'; 
                                                  } ?>>
                Adresse
            </option>
            <option value="email" <?php if($this->session->userdata('sel_admin_speAttribute') == 'email'){ 
                                                echo 'selected'; 
                                        } ?>>
                e-mail
            </option>
            <option value="telephone" <?php if($this->session->userdata('sel_admin_speAttribute') == 'telephone'){ 
                                                echo 'selected'; 
                                            } ?>>
                Téléphone
            </option>
            <option value="profession" <?php if($this->session->userdata('sel_admin_speAttribute') == 'profession'){ 
                                                echo 'selected'; 
                                             } ?>>
                Profession
            </option>
        </select>

        <input type="text" name="speAttributeValue" maxlength="50" 
               value="<?php if($this->session->userdata('sel_admin_speAttributeValue') != null){ 
                                echo $this->session->userdata('sel_admin_speAttributeValue'); 
                      } ?>" />
        <br/>
        <label for="userPerPage">Nombre d'utilisateurs par page :</label>
        <select name="userPerPage" id="userPerPage">
            <option value="5" <?php if($this->session->userdata('sel_admin_userPerPage') == '5'){ 
                                        echo 'selected'; 
                                    } ?>>
                5
            </option>
            <option value="10" <?php if($this->session->userdata('sel_admin_userPerPage') == '10'){ 
                                        echo 'selected'; 
                                     } ?>>
                10
            </option>
            <option value="20" <?php if($this->session->userdata('sel_admin_userPerPage') == '20'){ 
                                        echo 'selected'; 
                                     } ?>>
                20
            </option>
            <option value="30" <?php if($this->session->userdata('sel_admin_userPerPage') == '30'){ 
                                        echo 'selected'; 
                                     } ?>>
                30
            </option>
            <option value="40" <?php if($this->session->userdata('sel_admin_userPerPage') == '40'){ 
                                        echo 'selected'; 
                                     } ?>>
                40
            </option>
            <option value="50" <?php if($this->session->userdata('sel_admin_userPerPage') == '50'){ 
                                        echo 'selected'; 
                                     } ?>>
                50
            </option>
        </select>
        <br/>
        <input type="submit" value="Trier" />
    </form>
    
<!--    page navigation-->
<div style="text-align: right;">
    Page : 
    <?php
        for ($i = 1; $i <= $numPage; $i++) {
            if ($i != $currentPage) {
                echo anchor('admin_panel/admin_panel/index/' . $i, $i, array('class' => 'otherPage'));
                echo '&nbsp;';
            } else {
                echo anchor('admin_panel/admin_panel/index/' . $i, $i, array('class' => 'currentPage'));
                echo '&nbsp;';
            }
        }
    ?>
</div>
<br>     
    
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
                        <?php if($this->session->userdata('user_level') == 10){ ?>
                            <?php echo form_open('admin_panel/admin_panel/change_level') ?>
                                <input type="hidden" name="username" value="<?php echo $user->get_userName(); ?>" />
                                    <select name="userLevel">
                                        <option value="0" <?php if ($user->get_userLevel()==0){echo 'selected';}?>>Non validé</option>
                                        <option value="1" <?php if ($user->get_userLevel()==1){echo 'selected';}?>>Visiteur</option>
<!--                                        <option value="3" <?php if ($user->get_userLevel()==3){echo 'selected';}?>>Informateur</option>-->
                                        <option value="4" <?php if ($user->get_userLevel()==4){echo 'selected';}?>>Chercheur</option>
                                        <option value="5" <?php if ($user->get_userLevel()==5){echo 'selected';}?>>Moderateur</option>
                                        <option value="9" <?php if ($user->get_userLevel()==9){echo 'selected';}?>>Administrateur</option>
                                        <option value="-1" <?php if ($user->get_userLevel()==-1){echo 'selected';}?>>Utilisateur banni</option>
                                    </select>    
                                <input type="submit" value="changer le niveau d'utilisateur" />
                            </form>
                        <?php }elseif($this->session->userdata('user_level') == 9 && $user->get_userLevel()<9){ ?>
                            <?php echo form_open('admin_panel/admin_panel/change_level') ?>
                                <input type="hidden" name="username" value="<?php echo $user->get_userName(); ?>" />
                                    <select name="userLevel">
                                        <option value="0" <?php if ($user->get_userLevel()==0){echo 'selected';}?>>Non validé</option>
                                        <option value="1" <?php if ($user->get_userLevel()==1){echo 'selected';}?>>Visiteur</option>
<!--                                        <option value="3" <?php if ($user->get_userLevel()==3){echo 'selected';}?>>Informateur</option>-->
                                        <option value="4" <?php if ($user->get_userLevel()==4){echo 'selected';}?>>Chercheur</option>
                                        <option value="5" <?php if ($user->get_userLevel()==5){echo 'selected';}?>>Moderateur</option>
                                        <option value="-1" <?php if ($user->get_userLevel()==-1){echo 'selected';}?>>Utilisateur banni</option>
                                    </select>    
                                <input type="submit" value="changer le niveau d'utilisateur" />
                            </form>
                        <?php }else{
                                echo $user->get_userLevelType();
                        } ?>
                    </td>
                    <td><?php echo date('d/m/Y',$user->get_creationDate()); ?></td>
                    <td><?php echo $user->get_firstName(); ?></td>
                    <td><?php echo $user->get_name(); ?></td>
                    <td><?php echo $user->get_adress(); ?></td>
                    <td><?php echo $user->get_email(); ?></td>
                    <td><?php echo $user->get_phoneNumber(); ?></td>
                    <td><?php echo $user->get_job(); ?></td>
                    <td>
                        <?php if ($user->get_contribution()<1 && $user->get_userLevel() < 10){
                                echo form_open('admin_panel/admin_panel/delete_user/'.$user->get_userName()) ?>   
                                    <div class="message" style="left:15%; top:40%; display:none">
                                        <p>
                                            Vous vous apprêtez à supprimer définitivement <em><?php echo $user->get_userName(); ?></em>,
                                             êtes vous certain de ne pas plutôt vouloir l'invalider?
                                        </p>
                                        <input type="submit" value="Supprimer cet utilisateur" />
                                        <button type="reset" class="closePopup"> Annuler </button>
                                        <?php echo img(array('src'=>'assets/utils/close.png','alt'=>'fermer','width'=>'4%', 
                                                         'class'=>'removePopup')); ?>
                                    </div>
                                </form>
                                <button class="removePopup"> Supprimer </button>
                        <?php } elseif($user->get_contribution()>=1) {
                                echo 'Contributeur actif';
                        } elseif($user->get_userLevel() == 10) {
                                echo 'Super administrateur';
                        } ?>
                    </td>
                </tr>
            <?php }  ?>
        </tbody>
    </table>
    </div>

<br>
<!--    page navigation-->
<div style="text-align: right;">
    Page : 
    <?php
        for ($i = 1; $i <= $numPage; $i++) {
            if ($i != $currentPage) {
                echo anchor('admin_panel/admin_panel/index/' . $i, $i, array('class' => 'otherPage'));
                echo '&nbsp;';
            } else {
                echo anchor('admin_panel/admin_panel/index/' . $i, $i, array('class' => 'currentPage'));
                echo '&nbsp;';
            }
        }
    ?>
</div>

<script src="<?php echo base_url();?>assets/js/removepopup.js"></script>