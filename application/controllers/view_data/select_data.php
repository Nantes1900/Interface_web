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
   
    public function index($dataType = null, $goal = 'view' ){
        if($dataType == null) {
            $this->select_type();
        } elseif ($dataType == 'objet') {
            $this->select_objet($goal);
        } elseif (($dataType == 'ressource_texte') || ($dataType == 'ressource_graphique') || ($dataType == 'ressource_video')) {
            $this->select_ressource($dataType, $goal);
        } elseif ($dataType == 'carte') {
            $this->select_geo();
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
        if(!$this->session->userdata('username')){
            redirect('accueil/accueil/not_connected/', 'refresh');
        }
    }   
    
    private function select_type(){
        $this->load->view('view_data/select_type');
        $this->load->view('footer');
    }
    
    public function select_objet($goal){
        //managing the sort option
        $orderBy = $this->input->post('orderBy');
        if ($orderBy == null) {
            $orderBy = 'nom_objet';
        }
        $orderDirection = $this->input->post('orderDirection');
        if ($this->form_validation->run('sort_objet') == TRUE) { //we check there is no xss in the field
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
        $valid = 't';
        if ($goal == 'add_doc') { //we put some info about the related ressource if we are adding a documentation
            $ressource_id = $this->input->post('ressource_id');
            $typeRessource = $this->input->post('typeRessource');
            require_once ('application/models/' . $typeRessource . '.php');
            $this->load->model($typeRessource . '_model');
            $typeRessourceMethod = ucfirst($typeRessource);
            $ressource = new $typeRessourceMethod($ressource_id);
            $valid = null;
        }

        //creating the list
        $data = array('listObjet' => $this->objet_model->get_objet_list($orderBy, $orderDirection, $speAttribute, $speAttributeValue, $valid));
        $data['goal'] = $goal;
        if ($goal == 'add_doc') { //we put some info about the related ressource if we are adding a documentation
            $data['ressource'] = $ressource;
            $data['typeRessource'] = $typeRessource;
        }
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
        if($goal!='add_doc'){
            $valid = 't';
        }else{
            $valid = null;
        }
        $data['listRessource'] = $ressourceManager->get_ressource_list($orderBy,$orderDirection,$speAttribute,$speAttributeValue,$valid);
        
        $this->load->view('view_data/select_ressource', $data);
        $this->load->view('footer');
    }
    private function select_geo(){
        $data = array();
        //we consider if there is a focus on a particular objet
        if($this->input->post('latitude')!=null && $this->input->post('longitude')!=null){
            $data['latitude'] = $this->input->post('latitude');
            $data['longitude'] = $this->input->post('longitude');
        }
        
        $this->load->view('view_data/select_geo', $data);
        $this->load->view('footer');
    }
    
}

/* End of file select_data.php */
/* Location : ./application/controllers/view_data/select_data.php */