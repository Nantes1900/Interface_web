<?php

/**
 * View_data class
 * 
 * Détails d'un objet, objets et ressources liés en barre latérale
 * 
 * @author LUCAS Paul-Yves
 * 
 */
class View_data extends CI_Controller {
   
    //check what ressource is targeted and if it exist, then call the proper function
    public function index(){ 
        if($this->session->userdata('username')){
            $dataType = $this->input->post('type');
            $data_id = $this->input->post('data_id');
            if (($dataType == 'objet') && ($this->objet_model->exist($data_id))){
                $this->view_objet($data_id);
            } elseif($dataType == 'ressource_texte' || $dataType == 'ressource_graphique'|| $dataType == 'ressource_video') {
                $this->view_ressource($data_id, $dataType);
            } else {
                $this->load->view('view_data/error',array('error'=>'La ressource recherchée est inexistante'));
            }
        } else {
            $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
        }
    }
    
    public function __construct() {
	
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        require_once ('application/models/objet.php');
        require_once ('application/models/ressource_graphique.php');
        require_once ('application/models/ressource_texte.php');
        require_once ('application/models/ressource_video.php');
        $this->load->model('objet_model');
        $this->load->model('ressource_graphique_model');
        $this->load->model('ressource_texte_model');
        $this->load->model('ressource_video_model');
        $this->load->library('form_validation');
        $this->load->helper('dates');
        $this->load->view('header');
    }   
    
    public function view_objet($objet_id){
        $objet = new Objet($objet_id);
        
        $linkedObjetArray = $this->objet_model->get_linked_objet($objet_id);
        $linkedRessTxtArray = $this->objet_model->get_linked_ressource($objet_id, 'textuelle');
        $linkedRessGraphArray = $this->objet_model->get_linked_ressource($objet_id, 'graphique');
        $linkedRessVidArray = $this->objet_model->get_linked_ressource($objet_id, 'video');
        
        $data = array ('objet'=>$objet);
        $sidebarData = array ('linkedObjetArray'=>$linkedObjetArray, 'linkedRessTxtArray'=>$linkedRessTxtArray,
                                'linkedRessGraphArray'=>$linkedRessGraphArray, 'linkedRessVidArray'=>$linkedRessVidArray);
        
        
        $this->load->view('view_data/linked_sidebar', $sidebarData);
        $this->load->view('view_data/view_objet', $data);
        
        $this->load->view('footer');
    }
    
    public function view_ressource ($ressource_id, $typeRessource){
        //getting the kind of ressource
        $typeRessource = ucfirst($typeRessource);
        $managerName = $typeRessource.'_model';
        
        if (class_exists($typeRessource) && class_exists($managerName)){
            $ressource = new $typeRessource($ressource_id);
            $ressourceManager = new $managerName();
           
            $linkedObjetArray = $ressourceManager->get_linked_objet($ressource_id);
            
            $data = array ('ressource'=>$ressource, 'typeRessource'=>strtolower($typeRessource));
            $sidebarData = array ('linkedObjetArray'=>$linkedObjetArray);
           
            $this->load->view('view_data/linked_sidebar_ress', $sidebarData);
            $this->load->view('view_data/view_ressource', $data);
      
            $this->load->view('footer');
        }
    }
    
}
