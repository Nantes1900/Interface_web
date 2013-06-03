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
                if($this->input->post('objet_id')==null){
                    $this->select_objet();
                }else{
                    $this->modify($this->input->post('objet_id'));
                }
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
    
    private function select_objet(){
        
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
        if ($this->input->post('validation')==TRUE){ //we check if we only want non validated objet
            $valid = 'f';
        } else {
            $valid = null;
        }
        
        //creating the list
        $data = array('listObjet' => $this->objet_model->get_objet_list($orderBy,$orderDirection,$speAttribute,$speAttributeValue,$valid));
        $this->load->view('moderation/select_objet', $data);
        $this->load->view('footer');
    }
    
    private function modify($objet_id){
        $objet = new Objet($objet_id);
        if ($this->form_validation->run('ajout_objet') == FALSE){
            $this->load->view('moderation/modify_objet',array('objet'=>$objet));
            $this->load->view('footer');
        } else {
            $objet->set_nom_objet($this->input->post('nom_objet'));
            $objet->set_resume($this->input->post('resume'));
            $objet->set_historique($this->input->post('historique'));
            $objet->set_description($this->input->post('description'));
            $objet->set_adresse_postale($this->input->post('adresse_postale'));
            $objet->set_mots_cles($this->input->post('mots_cles'));
            if ($this->input->post('validation')==TRUE){ //beware, in database, booleans are t (for TRUE) and f (FALSE)
                $objet->set_validation('t');
            }else{
                $objet->set_validation('f');
            }
            $objet->save();
            redirect('moderation/moderation_center/','refresh');
        }
    }
    
    public function check_nom($name){
        $objet = $this->objet_model->get_objet('nom_objet', $name);
        $objet_id = $this->input->post('objet_id');
        if ($objet!=null && ($objet['objet_id']!=$objet_id)){
            $this->form_validation->set_message('check_nom', 'Un autre objet porte déjà ce nom');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}

/* End of file modify_objet.php */
/* Location : ./application/models/modify_objet.php */

