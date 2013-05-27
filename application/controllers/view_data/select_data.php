<?php

/**
 * admin_panel class
 * 
 * Accessible à tous
 * Menu permettant de sélectionner des objets, ressources... pour les visualiser
 * 
 * @author LUCAS Paul-Yves
 * 
 */
class Select_data extends CI_Controller {
   
    public function index(){
        if($this->session->userdata('username')){
            $this->select_data();
        } else {
            $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
        }
    }
    
    public function __construct() {
	
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        require ('application/models/objet.php');
        $this->load->model('objet_model');
        $this->load->library('form_validation');
        $this->load->helper('dates_helper');
        $this->load->view('header');
    }   
    
    public function select_data(){
        
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
        $this->load->view('view_data/select_data', $data);
        $this->load->view('footer');
    }
    
}

/* End of file select_data.php */
/* Location : ./application/controllers/view_data/select_data.php */