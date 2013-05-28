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
        $this->load->view('header');
    }   
    
    public function view_objet($objet_id){
        $objet = new Objet($objet_id);
        
        $linkedObjetArray = $this->objet_model->get_linked_objet($objet_id);
        
        $data = array ('objet'=>$objet);
        $sidebarData = array ('linkedObjetArray'=>$linkedObjetArray);
        
        $this->load->view('view_data/linked_sidebar', $sidebarData);
        $this->load->view('view_data/view_objet', $data);
        
        $this->load->view('footer');
    }
    
}

