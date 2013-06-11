<?php

/**
 * contact_panel class
 * Display a list of users and allow to contact them (email)
 *
 * @author paulyves
 */
class Contact_panel extends CI_Controller{
    public function index(){
        if ( $this->session->userdata('username') ) {
            $this->contact_panel();
        }else{
            $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
        }
    }
    
    public function __construct() {
	
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        $this->load->model('user_model');
        require ('application/models/user.php');
        $this->load->library('form_validation');
        $this->load->helper('dates_helper');
        $this->load->view('header');
    }   
    
    private function contact_panel(){     //this render the contact_panel page
            
        $userManager = new User_model();
        $data = array();
        //managing the sort option
        $speUserLevel = $this->input->post('speUserLevel');
        if($speUserLevel=='null'){$speUserLevel=null;}
        $orderBy = $this->input->post('orderBy');
        if($orderBy == null){$orderBy = 'username';}
        $orderDirection = $this->input->post('orderDirection');
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
       //creating the list
       $data['listUser'] = $userManager->get_user_list($speUserLevel,$orderBy,$orderDirection,$speAttribute,$speAttributeValue,$this->session->userdata('username')); 
       $this->load->view('profile_panel/contact_panel', $data);
       $this->load->view('footer');
    }
}

/* End of file contact_panel.php */
/* Location : ./application/models/contact_panel.php */

