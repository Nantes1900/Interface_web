<?php

/**
 * controller to manage objet modification
 *
 * @author paulyves
 */

class Modify_objet extends CI_Controller{
    
    public function index(){
        if($this->session->userdata('username')){
            if ( $this->session->userdata('user_level') == 4 ){
                $this->select_objet();
            }
        } else {
            $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
        }
    }
    
    public function __construct() {
	
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        require_once ('application/models/objet.php');
        $this->load->model('objet_model');
        $this->load->library('form_validation');
        $this->load->view('header');
    }   
    
    public function select_objet(){
        
        //managing the sort option
        $orderBy = $this->input->post('orderBy');
        if($orderBy == null){$orderBy = 'nom_objet';}
        $orderDirection = $this->input->post('orderDirection');
        if($this->form_validation->run('sort_objet')==TRUE){ //we check there is no xss in the field
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
        $data = array('listObjet' => $this->objet_model->get_objet_list($orderBy,$orderDirection,$speAttribute,$speAttributeValue));
        $this->load->view('moderation/select_objet', $data);
        $this->load->view('footer');
    }
}

/* End of file modify_objet.php */
/* Location : ./application/models/modify_objet.php */

