<?php

/**
 * controller to manage objet modification
 *
 * @author paulyves
 */

class Modify_objet extends CI_Controller{
    
    public function index($goal, $success = null, $lastAction = null){
        if($this->session->userdata('username')){
            if ( $this->session->userdata('user_level') >= 5 ){
                if($this->input->post('objet_id')==null){
                    if(isset($success) && isset($lastAction)){
                        $message = $this->create_success_message($success, $lastAction);
                        $this->load->view('data_center/success_form',array('success'=>$success, 'message'=> $message));
                    }
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
        if ( $this->session->userdata('user_level') >= 5 ){
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
            if ($this->input->post('validate')==TRUE){ //beware, in database, booleans are t (for TRUE) and f (FALSE)
                $objet->set_validation('t');
            }else{
                $objet->set_validation('f');
            }
            $success = $objet->save();
            $lastAction = 'modify';
            $message = $this->create_success_message($success, $lastAction, $objet->get_nom_objet());
            $this->load->view('data_center/success_form',array('success'=>$success, 'message'=> $message));
            $this->select_objet('modify');
        }
    }
    
    public function validate (){
        if ( $this->session->userdata('user_level') >= 5 ){
            $objet_id = $this->input->post('objet_id');
            $objet = new Objet($objet_id);
            $success = $objet->validate();
            
            //creation success message
            $lastAction = 'validate';
            $message = $this->create_success_message($success, $lastAction, $objet->get_nom_objet());
            $this->load->view('data_center/success_form',array('success'=>$success, 'message'=> $message));
            $this->select_objet('modify');
        }else{
            redirect('accueil/accueil/','refresh');
        }
    }
    
    public function delete_objet(){
        if ( $this->session->userdata('user_level') >= 5 ){
            $objet_id = $this->input->post('objet_id');
            $objet = new Objet($objet_id);
            $success = $this->objet_model->delete($objet_id);
            
            $lastAction = 'deletion';
            $message = $this->create_success_message($success, $lastAction, $objet->get_nom_objet());
            $this->load->view('data_center/success_form',array('success'=>$success, 'message'=> $message));
            $this->select_objet('modify');
        }else{
            redirect('accueil/accueil/','refresh');
        }
    }
    //render the select objet menu to choose which objet you want to link
    public function add_relation(){
        if ( $this->session->userdata('user_level') >= 5 ){
            $objet_id = $this->input->post('objet_id');
            $this->select_objet('add_relation', $objet_id);
        }else{
            redirect('accueil/accueil/','refresh');
        }
    }
    
    public function add_relation_form(){
        if ( $this->session->userdata('user_level') >= 5 ){
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
                             
                $success = $this->relation_model->ajout_relation($relationdata);
                $lastAction = 'addRelation';
                //creation of the success message
                $objet1 = new Objet($objet1_id);
                $objet2 = new Objet($objet2_id);
                $message = $this->create_success_message($success, $lastAction, $objet1->get_nom_objet(), $objet2->get_nom_objet());
                
                $this->load->view('data_center/success_form',array('success'=>$success, 'message'=> $message));
                $this->select_objet('add_relation', $objet1_id);
            }
        }else{
            redirect('accueil/accueil/','refresh');
        }
    }
    
    //render the list of objet linked to one objet so that one can delete these relation
    public function delete_relation($objet_id=null){
        if ( $this->session->userdata('user_level') >= 5 ){
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
         if ( $this->session->userdata('user_level') >= 5 ){
            $objet_id = $this->input->post('objet_id');
            $relation_id = $this->input->post('relation_id');
            $this->load->model('relation_model');
            
            $success = $this->relation_model->delete_relation($relation_id);
            $message = $this->create_success_message($success, 'relationDeletion', 
                        $this->input->post('nom_objet_source'), $this->input->post('nom_objet_target'));
            $this->load->view('data_center/success_form',array('success'=>$success, 'message'=> $message));
            
            $this->delete_relation($objet_id);
        }else{
            redirect('accueil/accueil/','refresh');
        }
     }
    
     public function delete_geom($geom_id, $objet_id){
         if ( $this->session->userdata('user_level') >= 5 ){
            $objet = new Objet($objet_id);
            if ($objet->get_nom_objet()!=null){
                $success = $this->objet_model->delete_geometry($geom_id);
            }else{
                $success = FALSE;
            }
            $message = $this->create_success_message($success, 'geomDeletion', $objet->get_nom_objet());
            $this->load->view('data_center/success_form',array('success'=>$success, 'message'=> $message));
        }else{
            redirect('accueil/accueil/','refresh');
        }
     }
     
     public function create_success_message($success, $lastAction, $firstEntity = null, $secondEntity = null ){
         if($lastAction == 'modify'){
             if($success){
                 $message = 'La modification de l\'objet <b>'.$firstEntity.'</b> s\'est déroulée avec succès';
             }else {
                 $message = 'Erreur : la modification de l\'objet <b>'.$firstEntity.'</b> a échoué ';
             }
         } elseif ($lastAction == 'validate'){
             if($success){
                 $message = 'La validation de l\'objet <b>'.$firstEntity.'</b> s\'est déroulée avec succès';
             }else {
                 $message = 'Erreur : la validation de l\'objet <b>'.$firstEntity.'</b> a échoué ';
             }
         } elseif ($lastAction == 'deletion'){
             if($success){
                 $message = 'La suppression de l\'objet <b>'.$firstEntity.'</b> s\'est déroulée avec succès';
             }else {
                 $message = 'Erreur : la suppression de l\'objet <b>'.$firstEntity.'</b> a échoué ';
             }
         }elseif($lastAction == 'addRelation'){
             if($success){
                    $message = 'La relation entre <b>'.$firstEntity.
                            '</b> et <b>'.$secondEntity.'</b> a été ajoutée avec succès';                    
             } else {
                    $message = 'Erreur : la relation entre <b>'.$firstEntity.
                            '</b> et <b>'.$secondEntity.'</b> n\'a pas pu être ajouté'; 
             }
         }elseif ($lastAction == 'relationDeletion'){
             if($success){
                 $message = 'La suppression de la relation entre <b>'.$firstEntity.
                            '</b> et <b>'.$secondEntity.'</b> s\'est déroulée avec succès';
             }else {
                 $message = 'Erreur : la suppression de la relation entre <b>'.$firstEntity.
                            '</b> et <b>'.$secondEntity.'</b> a échoué ';
             }
         }elseif ($lastAction == 'geomDeletion'){
             if($success){
                 $message = 'La suppression du marqueur géographique de <b>'.$firstEntity.
                            '</b> s\'est déroulée avec succès. <br>'.
                            'Attention : l\'objet existe encore, seules se coordonnées ont été supprimées';
             }else {
                 if($firstEntity != null){
                    $message = 'Erreur : la suppression du marqueur géographique de <b>'.$firstEntity.
                               '</b> a échoué, l\'objet reste présent sur la carte ';
                 } else {
                     $message = 'Erreur : l\'objet n\'existait pas, il n\'a pas pu être effacé de la carte';
                 }
             }
         }
         return $message;
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

