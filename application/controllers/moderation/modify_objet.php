<?php

/**
 * controller to manage objet modification
 *
 * @author paulyves
 */

class Modify_objet extends CI_Controller{
    
    public function index($goal){
        if($this->session->userdata('username')){
            if ( $this->session->userdata('user_level') == 4 ){
                if($this->input->post('objet_id')==null){
                    $this->select_objet($goal);
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
        $this->load->helper(array('form','dates'));
        $this->load->view('header');
    }   
    
    
    //powerful method to render a sorted list of objet, with various button to different controllers, depending on input attributes
    public function select_objet($goal,$objet1_id=null){
        if ( $this->session->userdata('user_level') == 4 ){
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
            $data['goal']=$goal;
            if($objet1_id!=null){$data['objetSource']=new Objet($objet1_id);}
            $this->load->view('moderation/select_objet', $data);
            $this->load->view('footer');
        }else{
            redirect('accueil/accueil/','refresh');
        }
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
            redirect('moderation/modify_objet/index/modify','refresh');
        }
    }
    
    public function delete_objet(){
        if ( $this->session->userdata('user_level') == 4 ){
            $objet_id = $this->input->post('objet_id');
            $this->objet_model->delete($objet_id);
            redirect('moderation/modify_objet/index/modify','refresh');
        }else{
            redirect('accueil/accueil/','refresh');
        }
    }
    //render the select objet menu to choose which objet you want to link
    public function add_relation(){
        if ( $this->session->userdata('user_level') == 4 ){
            $objet_id = $this->input->post('objet_id');
            $this->select_objet('add_relation', $objet_id);
        }else{
            redirect('accueil/accueil/','refresh');
        }
    }
    
    public function add_relation_form(){
        if ( $this->session->userdata('user_level') == 4 ){
            $objet1_id = $this->input->post('objet1_id');
            $objet2_id = $this->input->post('objet2_id');
            if ($this->form_validation->run('ajout_relation') == FALSE){
                $objet1 = new Objet($objet1_id);
                $objet2 = new Objet($objet2_id);
                $this->load->model('relation_model');
                $type_relation_list = $this->relation_model->get_type_relation_list();
                
                $data=array('objet1'=>$objet1,'objet2'=>$objet2,'type_relation_list'=>$type_relation_list);
                
                $this->load->view('moderation/ajout_relation',$data);
                $this->load->view('footer');
            }else{
                $this->load->model('relation_model');
                $relationdata = array();
                $relationdata['objet_id_1'] = $objet1_id;
                $relationdata['objet_id_2'] = $objet2_id;
                $relationdata['type_relation_id'] = $this->input->post('type_relation');
                $relationdata['username'] = $this->session->userdata('username');
                $relationdata['datation_indication_debut'] = $this->input->post('datation_indication_debut');
                $relationdata['datation_indication_fin'] = $this->input->post('datation_indication_fin');
                
                $dates_infos = conc_2_date($this->input->post('jour_debut'),$this->input->post('mois_debut'),$this->input->post('annee_debut'),$this->input->post('jour_fin'),$this->input->post('mois_fin'),$this->input->post('annee_fin'));
                                
                $relationdata['date_debut_relation'] = $dates_infos['date_debut'];
                $relationdata['date_fin_relation'] = $dates_infos['date_fin'];
                $relationdata['date_precision'] = $dates_infos['date_precision'];
                                
                $relationdata['parent'] = $this->input->post('parent')? 'true':'false';
                             
                $this->relation_model->ajout_relation($relationdata);
                $this->select_objet('add_relation', $objet1_id);
            }
        }else{
            redirect('accueil/accueil/','refresh');
        }
    }
    
    public function delete_relation($objet_id=null){
        if ( $this->session->userdata('user_level') == 4 ){
            if($objet_id==null){
                $objet_id = $this->input->post('objet_id');
            }
            $objet = new Objet ($objet_id);
            $linkedObjetArray = $this->objet_model->get_linked_objet($objet_id);
            $data = array('objet'=>$objet,'linkedObjetArray'=>$linkedObjetArray);
            $this->load->view('moderation/delete_relation', $data);
            $this->load->view('footer');
        }else{
            redirect('accueil/accueil/','refresh');
        }
    }
    
     public function delete_relation_form(){
         if ( $this->session->userdata('user_level') == 4 ){
            $objet_id = $this->input->post('objet_id');
            $relation_id = $this->input->post('relation_id');
            $this->load->model('relation_model');
            $this->relation_model->delete_relation($relation_id);
            $this->delete_relation($objet_id);
        }else{
            redirect('accueil/accueil/','refresh');
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
    
    public function check_date($input, $boundary){ //callback function checking date_debut or date_fin validity
            $day = (int) $this->input->post('jour_'.$boundary);
            $month = (int) $this->input->post('mois_'.$boundary);
            $year = (int) $this->input->post('annee_'.$boundary);
            $valid = checkdate($month,$day,$year);
            if (!$valid){
                $this->form_validation->set_message('check_date', 'Date invalide');
            }
            return $valid;
        }
}

/* End of file modify_objet.php */
/* Location : ./application/models/modify_objet.php */

