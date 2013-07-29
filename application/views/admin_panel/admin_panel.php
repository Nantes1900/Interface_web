
    <h1><?php echo $this->lang->line('common_lsidebar_admin_panel'); ?></h1>
    
    <h2><?php echo $this->lang->line('common_menu_admin_panel'); ?></h2>
    
<!--    sorting form-->
    <?php echo form_open('admin_panel/admin_panel/sort_admin_panel') ?>
        <label for="speUserLevel"><?php echo $this->lang->line('user_sort_userlevel'); ?></label>
        <select name="speUserLevel" id="speUserLevel">
            <option value="null" <?php if($this->session->userdata('sel_admin_speUserLevel') == 'null'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('user_userlevel_all'); ?>
            </option>
            <option value="0" <?php if(is_string($this->session->userdata('sel_admin_speUserLevel')) && 
                                        $this->session->userdata('sel_admin_speUserLevel') == '0'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('user_userlevel_0'); ?>
            </option>
            <option value="1" <?php if($this->session->userdata('sel_admin_speUserLevel') == '1'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('user_userlevel_1'); ?>
            </option>
<!--            <option value="3" <?php if($this->session->userdata('sel_admin_speUserLevel') == '3'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('user_userlevel_3'); ?>
            </option>-->
            <option value="4" <?php if($this->session->userdata('sel_admin_speUserLevel') == '4'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('user_userlevel_4'); ?>
            </option>
            <option value="5" <?php if($this->session->userdata('sel_admin_speUserLevel') == '5'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('user_userlevel_5'); ?>
            </option>
            <option value="9" <?php if($this->session->userdata('sel_admin_speUserLevel') == '9'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('user_userlevel_9'); ?>
            </option>
            <option value="10" <?php if($this->session->userdata('sel_admin_speUserLevel') == '10'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('user_userlevel_10'); ?>
            </option>
            <option value="-1" <?php if($this->session->userdata('sel_admin_speUserLevel') == '-1'){ 
                                          echo 'selected'; 
                                       } ?>>
                <?php echo $this->lang->line('user_userlevel_-1'); ?>
            </option>
        </select>
        <br/>
        <label for="orderBy"><?php echo $this->lang->line('user_orderBy'); ?></label>
        <select name="orderBy" id="orderBy">
            <option value="username" <?php if($this->session->userdata('sel_admin_orderBy') == 'username'){ 
                                                echo 'selected'; 
                                            } ?>>
                <?php echo $this->lang->line('user_username'); ?>
            </option>
            <option value="user_level" <?php if($this->session->userdata('sel_admin_orderBy') == 'user_level'){ 
                                                echo 'selected'; 
                                             } ?>>
                <?php echo $this->lang->line('user_userLevel'); ?>
            </option>
            <option value="timestamp" <?php if($this->session->userdata('sel_admin_orderBy') == 'timestamp'){ 
                                                echo 'selected'; 
                                             } ?>>
                <?php echo $this->lang->line('date_crea'); ?>
            </option>
            <option value="nom" <?php if($this->session->userdata('sel_admin_orderBy') == 'nom'){ 
                                                echo 'selected'; 
                                             } ?>>
                <?php echo $this->lang->line('user_family_name'); ?>
            </option>
            <option value="prenom" <?php if($this->session->userdata('sel_admin_orderBy') == 'prenom'){ 
                                                echo 'selected'; 
                                             } ?>>
                <?php echo $this->lang->line('user_first_name'); ?>
            </option>
            <option value="adresse_postale" <?php if($this->session->userdata('sel_admin_orderBy') == 'adresse_postale'){ 
                                                echo 'selected'; 
                                             } ?>>
                <?php echo $this->lang->line('user_address'); ?>
            </option>
            <option value="email" <?php if($this->session->userdata('sel_admin_orderBy') == 'email'){ 
                                                echo 'selected'; 
                                             } ?>>
                <?php echo $this->lang->line('user_email'); ?>
            </option>
            <option value="telephone" <?php if($this->session->userdata('sel_admin_orderBy') == 'telephone'){ 
                                                echo 'selected'; 
                                             } ?>>
                <?php echo $this->lang->line('user_phone'); ?>
            </option>
            <option value="profession" <?php if($this->session->userdata('sel_admin_orderBy') == 'profession'){ 
                                                echo 'selected'; 
                                             } ?>>
                <?php echo $this->lang->line('user_job'); ?>
            </option>
        </select>
        <select name="orderDirection">
            <option value="asc" <?php if($this->session->userdata('sel_admin_orderDirection') == 'asc'){ 
                                            echo 'selected'; 
                                      } ?>>
                <?php echo $this->lang->line('user_order_asc'); ?>
            </option>
            <option value="desc" <?php if($this->session->userdata('sel_admin_orderDirection') == 'desc'){ 
                                            echo 'selected'; 
                                      } ?>>
                <?php echo $this->lang->line('user_order_desc'); ?>
            </option>
        </select>
        <br/>
        <label for="speAttribute"><?php echo $this->lang->line('user_search_label'); ?></label>
        <select name="speAttribute" id="speAttribute">
            <option value="username" <?php if($this->session->userdata('sel_admin_speAttribute') == 'username'){ 
                                                echo 'selected'; 
                                           } ?>>
                <?php echo $this->lang->line('user_username'); ?>
            </option>
<!--            <option value="timestamp" <?php if($this->session->userdata('sel_admin_speAttribute') == 'timestamp'){ 
                                                echo 'selected'; 
                                            } ?>>
                Date de création
            </option>  problem because of timestamp precision, do not use until repaired-->
            <option value="nom" <?php if($this->session->userdata('sel_admin_speAttribute') == 'nom'){ 
                                            echo 'selected'; 
                                      } ?>>
                <?php echo $this->lang->line('user_family_name'); ?>
            </option>
            <option value="prenom" <?php if($this->session->userdata('sel_admin_speAttribute') == 'prenom'){ 
                                            echo 'selected'; 
                                         } ?>>
                <?php echo $this->lang->line('user_first_name'); ?>
            </option>
            <option value="adresse_postale" <?php if($this->session->userdata('sel_admin_speAttribute') == 'adresse_postale'){ 
                                                        echo 'selected'; 
                                                  } ?>>
                <?php echo $this->lang->line('user_address'); ?>
            </option>
            <option value="email" <?php if($this->session->userdata('sel_admin_speAttribute') == 'email'){ 
                                                echo 'selected'; 
                                        } ?>>
                <?php echo $this->lang->line('user_email'); ?>
            </option>
            <option value="telephone" <?php if($this->session->userdata('sel_admin_speAttribute') == 'telephone'){ 
                                                echo 'selected'; 
                                            } ?>>
                <?php echo $this->lang->line('user_phone'); ?>
            </option>
            <option value="profession" <?php if($this->session->userdata('sel_admin_speAttribute') == 'profession'){ 
                                                echo 'selected'; 
                                             } ?>>
                <?php echo $this->lang->line('user_job'); ?>
            </option>
        </select>

        <input type="text" name="speAttributeValue" maxlength="50" 
               value="<?php if($this->session->userdata('sel_admin_speAttributeValue') != null){ 
                                echo $this->session->userdata('sel_admin_speAttributeValue'); 
                      } ?>" />
        <br/>
        <label for="userPerPage"><?php echo $this->lang->line('user_per_page'); ?></label>
        <select name="userPerPage" id="userPerPage">
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
        <input type="submit" value="<?php echo $this->lang->line('user_sort_button'); ?>" />
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
                <th><?php echo $this->lang->line('user_username'); ?></th>
                <th><?php echo $this->lang->line('user_userLevel'); ?></th>
                <th><?php echo $this->lang->line('date_crea'); ?></th>
                <th><?php echo $this->lang->line('user_family_name'); ?></th>
                <th><?php echo $this->lang->line('user_first_name'); ?></th>
                <th><?php echo $this->lang->line('user_email'); ?></th>
                <th><?php echo $this->lang->line('user_job'); ?></th>
                <th class="hint">
                    <?php echo $this->lang->line('user_delete'); ?>
                    <span>
                        <?php echo $this->lang->line('user_delete_hint'); ?>
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
                                        <option value="0" <?php if ($user->get_userLevel()==0){echo 'selected';}?>>
                                            <?php echo $this->lang->line('user_userlevel_0'); ?>
                                        </option>
                                        <option value="1" <?php if ($user->get_userLevel()==1){echo 'selected';}?>>
                                            <?php echo $this->lang->line('user_userlevel_1'); ?>
                                        </option>
<!--                                    <option value="3" <?php if ($user->get_userLevel()==3){echo 'selected';}?>>
                                            <?php echo $this->lang->line('user_userlevel_3'); ?>
                                        </option>-->
                                        <option value="4" <?php if ($user->get_userLevel()==4){echo 'selected';}?>>
                                            <?php echo $this->lang->line('user_userlevel_4'); ?>
                                        </option>
                                        <option value="5" <?php if ($user->get_userLevel()==5){echo 'selected';}?>>
                                            <?php echo $this->lang->line('user_userlevel_5'); ?>
                                        </option>
                                        <option value="9" <?php if ($user->get_userLevel()==9){echo 'selected';}?>>
                                            <?php echo $this->lang->line('user_userlevel_9'); ?>
                                        </option>
                                        <option value="-1" <?php if ($user->get_userLevel()==-1){echo 'selected';}?>>
                                            <?php echo $this->lang->line('user_userlevel_-1'); ?>
                                        </option>
                                    </select>    
                                <input type="submit" value="<?php echo $this->lang->line('user_change_userLevel'); ?>" />
                            </form>
                        <?php }elseif($this->session->userdata('user_level') == 9 && $user->get_userLevel()<9){ ?>
                            <?php echo form_open('admin_panel/admin_panel/change_level') ?>
                                <input type="hidden" name="username" value="<?php echo $user->get_userName(); ?>" />
                                    <select name="userLevel">
                                        <option value="0" <?php if ($user->get_userLevel()==0){echo 'selected';}?>>
                                            <?php echo $this->lang->line('user_userlevel_0'); ?>
                                        </option>
                                        <option value="1" <?php if ($user->get_userLevel()==1){echo 'selected';}?>>
                                            <?php echo $this->lang->line('user_userlevel_1'); ?>
                                        </option>
<!--                                    <option value="3" <?php if ($user->get_userLevel()==3){echo 'selected';}?>>
                                            <?php echo $this->lang->line('user_userlevel_3'); ?>
                                        </option>-->
                                        <option value="4" <?php if ($user->get_userLevel()==4){echo 'selected';}?>>
                                            <?php echo $this->lang->line('user_userlevel_4'); ?>
                                        </option>
                                        <option value="5" <?php if ($user->get_userLevel()==5){echo 'selected';}?>>
                                            <?php echo $this->lang->line('user_userlevel_5'); ?>
                                        </option>
                                        <option value="-1" <?php if ($user->get_userLevel()==-1){echo 'selected';}?>>
                                            <?php echo $this->lang->line('user_userlevel_-1'); ?>
                                        </option>
                                    </select>    
                                <input type="submit" value="<?php echo $this->lang->line('user_change_userLevel'); ?>" />
                            </form>
                        <?php }else{
                                echo $this->lang->line('user_userlevel_'.$user->get_userLevel());
                        } ?>
                    </td>
                    <td><?php echo date('d/m/Y',$user->get_creationDate()); ?></td>
                    <td><?php echo $user->get_firstName(); ?></td>
                    <td><?php echo $user->get_name(); ?></td>
                    <td><?php echo $user->get_email(); ?></td>
                    <td><?php echo $user->get_job(); ?></td>
                    <td>
                        <?php if ($user->get_contribution()<1 && $user->get_userLevel() < 10){
                                echo form_open('admin_panel/admin_panel/delete_user/'.$user->get_userName()) ?>   
                                    <div class="message" style="left:15%; top:40%; display:none">
                                        <p>
                                            <?php echo sprintf($this->lang->line('user_delete_warning'),$user->get_userName()) ?>
                                        </p>
                                        <input type="submit" value="<?php echo $this->lang->line('user_do_delete'); ?>" />
                                        <button type="reset" class="closePopup"> <?php echo $this->lang->line('common_cancel'); ?> </button>
                                        <?php echo img(array('src'=>'assets/utils/close.png','alt'=>'fermer','width'=>'4%', 
                                                         'class'=>'removePopup')); ?>
                                    </div>
                                </form>
                                <button class="removePopup"> <?php echo $this->lang->line('user_delete'); ?> </button>
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
