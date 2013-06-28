<?php

/**
 * Gère les différents affichage pour créer une relation de documentation
 * entre une ressource et un objet
 * Repose énormément sur le controlleur select_data pour le choix 
 * de la ressource et de l'objet
 * 
 * @author paulyves
 */
class Ajout_documentation extends CI_Controller{
    /**
    * Redirige automatiquement vers le choix du type de documentation
    * @access public
    */
    public function index(){
        if ( $this->session->userdata('username') ) {
            $this->load->view('data_center/data_center');
            $this->choix_documentation(); 
        }else{
            $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
        }            
    }

    /**
    * Charge automatiquement la bibliothèque "form_validation" et les helper "form" et "dates" à chaque appel du contrôleur
    * @access public
    */
    public function __construct(){
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
            
        $this->load->library('form_validation');
        $this->load->model('objet_model');
        require_once ('application/models/objet.php');
        $this->load->helper(array('form','dates'));
        $this->load->view('header');
    }
    
    /*
     * Once this method is executed, links will follow each other to select
     * an objet and then a ressource, finaly the links will call add controller
     */
    private function choix_documentation(){
        $this->load->view('data_center/choix_documentation');
    }
    
    /*
     * This method is called by the select_ressource method with add_doc goal
     */
    public function add($typeRessource){
        if ( $this->session->userdata('username') ) {
            $this->load->model($typeRessource.'_model');
            $ressource_id = $this->input->post('ressource_id');
            $objet_id = $this->input->post('objet_id');
            $typeRessourceModel= ucfirst($typeRessource).'_model';
            $ressourceManager = new $typeRessourceModel();
            
            $success = FALSE;
            
            if($typeRessource!='ressource_video'){ //if we it's not a video, we may want to refer to a precise page
                if($this->form_validation->run('add_documentation') == TRUE){
                    $page = $this->input->post('page');
                }else{
                    $page = 0;
                }
                if($ressourceManager->add_documentation($objet_id,$ressource_id,$page)){
                    $success = TRUE;
                }
            }else{
                if($ressourceManager->add_documentation($objet_id,$ressource_id)){
                    $success = TRUE;
                }
            }
            
            if($success){
                $data = array('success'=>TRUE , 'message'=>'Le lien de documentation a été ajouté avec succès');
            } else {
                $data = array('success'=>FALSE , 'message'=>'Erreur : Le lien de documentation n\'a pas pu être ajouté');
            }
            $this->load->view('data_center/success_form', $data);
            $this->index();
        }else{
            $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
        } 
    }
}

/* End of file ajout_documentation.php */
/* Location : ./application/models/ajout_documentation.php */

