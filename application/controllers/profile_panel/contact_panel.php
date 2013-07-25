<?php

/**
 * contact_panel class
 * Display a list of users and allow to contact them (email)
 *
 * @author paulyves
 */
class Contact_panel extends MY_Controller{
    public function index($page = 1){
        $this->contact_panel($page);
    }
    
    public function __construct() {
	
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        $this->lang->load('user', $this->language);
        $this->load->model('user_model');
        require ('application/models/user.php');
        $this->load->library('form_validation');
        $this->load->helper('dates_helper');
        $this->load->view('header');
        if(!$this->session->userdata('username')){
            redirect('accueil/accueil/not_connected/', 'refresh');
        }
    }   
    
    public function sort_contact_panel(){
        //managing the sort option
        $speUserLevel = $this->input->post('speUserLevel');
        if($speUserLevel=='null'){$speUserLevel=null;}
        $this->session->set_userdata('sel_admin_speUserLevel', $speUserLevel);
        
        $orderBy = $this->input->post('orderBy');
        if($orderBy == null){$orderBy = 'username';}
        $this->session->set_userdata('sel_admin_orderBy', $orderBy);
        
        $orderDirection = $this->input->post('orderDirection');
        $this->session->set_userdata('sel_admin_orderDirection', $orderDirection);
        
        if($this->form_validation->run('sort_user')==TRUE){ //we check there is no xss in the field
            $speAttributeValue = $this->input->post('speAttributeValue');
            if(!empty($speAttributeValue)){ //if something is specified we set the values
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

        return $this->contact_panel();
    }
    
    private function contact_panel($page = 1){     //this render the contact_panel page
            
        $userManager = new User_model();
        $data = array();
        //managing the sort option
        $speUserLevel = $this->session->userdata('sel_admin_speUserLevel');
        //users can't see banned or unvalid user through contact panel
        if ($speUserLevel == 'null' || (is_numeric($speUserLevel) && $speUserLevel<1)) {
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
       $data['listUser'] = $userManager->get_user_list($speUserLevel,$orderBy,$orderDirection,
                           $speAttribute, $speAttributeValue, $this->session->userdata('username'),1, $page, $userPerPage); 
       $data['numPage'] = $userManager->count_page_users($speUserLevel, $speAttribute, $speAttributeValue, 
                                                          $this->session->userdata('username'), 1, $userPerPage);
       $data['currentPage'] = $page;
       $this->load->view('profile_panel/contact_panel', $data);
       $this->load->view('footer');
    }
}

/* End of file contact_panel.php */
/* Location : ./application/models/contact_panel.php */

