<?php

/**
 * admin_panel class
 * 
 * Accessible uniquement aux utilisateurs autorisés.
 * Menu d'administration proposant de gérer les utilisateurs (droits d'accès)
 * 
 * @author LUCAS Paul-Yves
 * 
 */
class Admin_panel extends MY_Controller {

    public function index($page = 1) {
        if ($this->session->userdata('user_level') >= 9) {
            $this->admin_panel($page);
        } else {
            redirect('accueil/accueil/', 'refresh');
        }
    }

    public function __construct() {

        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        $this->lang->load('user', $this->language);
        $this->load->model('user_model');
        require_once ('application/models/user.php');
        $this->load->library('form_validation');
        $this->load->helper('dates_helper');
        if (!$this->session->userdata('username')) {
            redirect('accueil/accueil/not_connected/', 'refresh');
        }
        $this->layout->add_js('removepopup');
        $this->layout->add_js('close_message');
    }

    public function sort_admin_panel(){
        if ($this->session->userdata('user_level') >= 9) {
            //managing the sort option
            $speUserLevel = $this->input->post('speUserLevel');
            $this->session->set_userdata('sel_admin_speUserLevel', $speUserLevel);

            $orderBy = $this->input->post('orderBy');
            if ($orderBy == null) {
                $orderBy = 'username';
            }
            $this->session->set_userdata('sel_admin_orderBy', $orderBy);

            $orderDirection = $this->input->post('orderDirection');
            $this->session->set_userdata('sel_admin_orderDirection', $orderDirection);

            if ($this->form_validation->run('sort_user') == TRUE) { //we check there is no xss in the field
                $speAttributeValue = $this->input->post('speAttributeValue');
                if (!empty($speAttributeValue)) { //if something is specified we set the values
                    $speAttribute = $this->input->post('speAttribute');
                } else { //if nothing specified as specific value we set to null
                    $speAttribute = null;
                    $speAttributeValue = null;
                }
            } else { //in case of xss attempt, no sorting on this
                $speAttribute = null;
                $speAttributeValue = null;
            }
            $this->session->set_userdata('sel_admin_speAttribute', $speAttribute);
            $this->session->set_userdata('sel_admin_speAttributeValue', $speAttributeValue);
            
            $userPerPage = $this->input->post('userPerPage');
            $this->session->set_userdata('sel_admin_userPerPage', $userPerPage);
            
            return $this->admin_panel();
        } else {
            redirect('accueil/accueil/', 'refresh');
        }
    }
    
    //this render the admin_panel page, with 20 users per page as default value
    private function admin_panel($page = 1) {     
        $userManager = new User_model();
        $data = array();
        //getting the sort option
        $speUserLevel = $this->session->userdata('sel_admin_speUserLevel');
        if ($speUserLevel == 'null') {
                $speUserLevel = null;
        }
        if ($this->session->userdata('sel_admin_orderBy') != null) {
            $orderBy = $this->session->userdata('sel_admin_orderBy');
        } else {
            $orderBy = 'username';
        }
        if ($this->session->userdata('sel_admin_orderDirection') != null) {
            $orderDirection = $this->session->userdata('sel_admin_orderDirection');
        } else {
            $orderDirection = 'asc';
        }
        if ($this->session->userdata('sel_admin_speAttribute') != null) {
            $speAttribute = $this->session->userdata('sel_admin_speAttribute');
        } else {
            $speAttribute = null;
        }
        if ($this->session->userdata('sel_admin_speAttributeValue') != null) {
            $speAttributeValue = $this->session->userdata('sel_admin_speAttributeValue');
        } else {
            $speAttributeValue = null;
        }
        if ($this->session->userdata('sel_admin_userPerPage') != null) {
            $userPerPage = $this->session->userdata('sel_admin_userPerPage');
        } else {
            $userPerPage = 20;
        }
        
        //creating the list
        $data['listUser'] = $userManager->get_user_list($speUserLevel, $orderBy, $orderDirection, 
                            $speAttribute, $speAttributeValue, $this->session->userdata('username'), null,
                            $page, $userPerPage);
        $data['numPage'] = $userManager->count_page_users($speUserLevel, $speAttribute, $speAttributeValue, 
                                                          $this->session->userdata('username'), null, $userPerPage);
        $data['currentPage'] = $page;
        $this->layout->view('admin_panel/admin_panel', $data);
    }

    //change the level of an user (form)
    public function change_level() {
        if ($this->session->userdata('user_level') >= 9) {
            if ($this->form_validation->run('change_level') == TRUE) {
                $userName = $this->input->post('username');
                $newLevel = (int) $this->input->post('userLevel');
                $user = new User($userName);
                if($user->get_userLevel() < 10){
                    $user->set_userLevel($newLevel);
                    $user->save();
                }
            }
            redirect('admin_panel/admin_panel', 'refresh');
        } else {
            redirect('accueil/accueil/', 'refresh');
        }
    }
    
    public function delete_user($username){
        if ($this->session->userdata('user_level') >= 9) {
            $user = new User($username);
            if ($user->get_contribution() < 1 && $user->get_userLevel() < 10) {
                $success = $this->user_model->delete_user($username);
                if ($success) {
                    $message = sprintf($this->lang->line('user_admin_delete_msg'),$username);
                } else {
                    $message = sprintf($this->lang->line('user_delete_error_msg'),$username);
                }
            } else {
                $success = FALSE;
                $message = sprintf($this->lang->line('user_delete_error_forbidden'),$username);
            }
            $this->layout->views('data_center/success_form', array('success' => $success, 'message' => $message));
            $this->admin_panel();
        } else {
            redirect('accueil/accueil/', 'refresh');
        }
    }

}

/* End of file admin_panel.php */
/* Location : ./application/controllers/admin_panel/admin_panel.php */
