<?php

/**
 * controller to manage ressource modification
 *
 * @author paulyves
 */

class Modify_ressource extends CI_Controller{
    public function index($typeRessource){
        if($this->session->userdata('username')){
            if ( $this->session->userdata('user_level') == 4 ){
                if($this->input->post('ressource_id')==null){
                    $this->select_ressource($typeRessource);
                }elseif($typeRessource=='ressource_texte'){
                    $this->modify_texte($this->input->post('ressource_id'));
                }
            }
        } else {
            $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
        }
    }
    
    public function __construct() {
	
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        require_once ('application/models/ressource_texte.php');
        $this->load->model('ressource_texte_model');
        $this->load->helper('dates');
        $this->load->library('form_validation');
        $this->load->view('header');
    } 
    
    private function select_ressource($typeRessource){
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
        if ($this->input->post('validation')==TRUE){ //we check if we only want non validated objet
            $valid = 'f';
        } else {
            $valid = null;
        }
        
        //creating the list
        $data = array();
        $data['typeRessource']=$typeRessource;
        $typeRessource= ucfirst($typeRessource).'_model';
        $ressourceManager = new $typeRessource();
        $data['listRessource'] = $ressourceManager->get_ressource_list($orderBy,$orderDirection,$speAttribute,$speAttributeValue,$valid);
        
        $this->load->view('moderation/select_ressource', $data);
        $this->load->view('footer');
    }
    
    private function modify_texte($ressource_id){
        $ressource = new Ressource_texte($ressource_id);
        if ($this->form_validation->run('ajout_texte') == FALSE) {
            $this->load->view('moderation/modify_texte',array('ressource'=>$ressource));
            $this->load->view('footer');
        }else{
            $ressource->set_titre($this->input->post('titre'));
            $ressource->set_description($this->input->post('description'));
            $ressource->set_reference_ressource($this->input->post('reference_ressource'));
            $ressource->set_disponibilite($this->input->post('disponibilite'));
            $ressource->set_auteurs($this->input->post('auteurs'));
            $ressource->set_editeur($this->input->post('editeur'));
            $ressource->set_ville_edition($this->input->post('ville_edition'));
            $ressource->set_sous_categorie($this->input->post('sous_categorie'));
            $ressource->set_mots_cles($this->input->post('mots_cles'));
            if ($this->input->post('pagination')!=null){
                $ressource->set_pagination($this->input->post('pagination'));
            }
            $date_infos = conc_date($this->input->post('jour'),$this->input->post('mois'),$this->input->post('annee'));
            $ressource->set_date_debut_ressource($date_infos['date']);
            $ressource->set_date_precision($date_infos['date_precision']);
            if ($this->input->post('validation')==TRUE){ //beware, in database, booleans are t (for TRUE) and f (FALSE)
                $ressource->set_validation('t');
            }else{
                $ressource->set_validation('f');
            }
            $ressource->save();
            redirect('moderation/moderation_center/','refresh');
        }
    }
    
    public function check_titre($title,$typeRessource){
        if ($typeRessource == 'texte'){
            $ressourceManager = new Ressource_texte_model();
            $existingRessource = $ressourceManager->get_ressource('titre', $title);
            $existing_id = $existingRessource['ressource_textuelle_id'];
        }
        if ($typeRessource == 'image'){
            $ressourceManager = new Ressource_graphique_model();
            $existingRessource = $ressourceManager->get_ressource('titre', $title);
            $existing_id = $existingRessource['ressource_graphique_id'];
        }
        if ($typeRessource == 'video'){
            $ressourceManager = new Ressource_video_model();
            $existingRessource = $ressourceManager->get_ressource('titre', $title);
            $existing_id = $existingRessource['ressource_video_id'];
        }
        
        $ressource_id = $this->input->post('ressource_id');
        if (isset($existingRessource) && $existing_id!=$ressource_id){
            $this->form_validation->set_message('check_titre', 'Titre déjà existant');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}

/* End of file modify_ressource.php */
/* Location : ./application/models/modify_ressource.php */

