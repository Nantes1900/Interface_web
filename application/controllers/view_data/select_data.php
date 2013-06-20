<?php

/**
 * select_data class
 * 
 * Accessible à tous
 * Menu permettant de sélectionner des objets, ressources... pour les visualiser
 * 
 * @author LUCAS Paul-Yves
 * 
 */
class Select_data extends CI_Controller {
   
    public function index($dataType = 'select', $goal = 'view' ){
        if($this->session->userdata('username')){
            if($dataType == 'select'){
                $this->select_type();
            }elseif($dataType == 'objet'){
                $this->select_objet($goal);
            }elseif(($dataType == 'ressource_texte') || ($dataType == 'ressource_graphique') || ($dataType == 'ressource_video')){
                $this->select_ressource($dataType, $goal);
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
        $this->load->helper('dates');
        $this->load->view('header');
    }   
    
    private function select_type(){
        $this->load->view('view_data/select_type');
        $this->load->view('footer');
    }
    
    private function select_objet($goal){
        
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
        $data = array('listObjet' => $this->objet_model->get_objet_list($orderBy,$orderDirection,$speAttribute,$speAttributeValue,'t'));
        $data['goal'] = $goal;
        $this->load->view('view_data/select_objet', $data);
        $this->load->view('footer');
    }
    
    private function select_ressource($typeRessource, $goal){
        //loading the models and class
        require_once ('application/models/'.$typeRessource.'.php');
        $this->load->model($typeRessource.'_model');
        //managing the sort option
        $orderBy = $this->input->post('orderBy');
        if($orderBy == null){$orderBy = 'titre';}
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
        $data = array('typeRessource'=>$typeRessource,'goal'=>$goal);
            
        $typeRessource= ucfirst($typeRessource).'_model';
        $ressourceManager = new $typeRessource();
        $data['listRessource'] = $ressourceManager->get_ressource_list($orderBy,$orderDirection,$speAttribute,$speAttributeValue,'t');
        
        $this->load->view('view_data/select_ressource', $data);
        $this->load->view('footer');
    }
    
}

/* End of file select_data.php */
/* Location : ./application/controllers/view_data/select_data.php */