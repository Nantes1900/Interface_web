<?php

/**
 * controller to manage objet modification
 *
 * @author paulyves
 */

class Modify_objet extends MY_Controller {

    public function index($goal, $success = null, $lastAction = null) {
        if ($this->input->post('objet_id') == null) {
            if (isset($success) && isset($lastAction)) {
                $message = $this->create_success_message($success, $lastAction);
                $this->layout->view('data_center/success_form', array('success' => $success, 'message' => $message));
            }
            $this->select_objet($goal);
        } else {
            $this->modify($this->input->post('objet_id'));
        }
    }

    public function __construct() {

        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        $this->lang->load('moderation', $this->language);
        require_once ('application/models/objet.php');
        $this->load->model('objet_model');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'dates', 'geom'));
        $this->layout->add_js('close_message');
        $this->layout->add_js('removepopup');
        if (!$this->session->userdata('username')) { //checking that user is connected
            redirect('accueil/accueil/not_connected/', 'refresh');
        } elseif (!$this->session->userdata('user_level') >= 5) {
            redirect('accueil/accueil/', 'refresh');
        }
    }
    
    //setting the sort option of the objet list
    //
    //$goal can be :
    // - modify, to list objets an have access to modify, validate and delete buttons
    // - relation, to have access to create a add relation and delete relation buttons
    // - add_relation, to link an objet as arg ($objet1_id) to the selected objet
    public function sort_sel_obj($goal, $objet1_id = null){
        //managing the sort option
        $orderBy = $this->input->post('orderBy');
        if ($orderBy == null) {
            $orderBy = 'nom_objet';
        }
        $this->session->set_userdata('sel_obj_orderBy', $orderBy);
        
        $orderDirection = $this->input->post('orderDirection');
        $this->session->set_userdata('sel_obj_orderDirection', $orderDirection);
        
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
        $this->session->set_userdata('sel_obj_speAttribute', $speAttribute);
        $this->session->set_userdata('sel_obj_speAttributeValue', $speAttributeValue);
        if ($this->input->post('validation') == TRUE) { //we check if we only want non validated objet
            $valid = 'f';
        } else {
            $valid = null;
        }
        $this->session->set_userdata('sel_obj_valid', $valid);
        if ($this->input->post('valAttribute') == 'conservation') { //we check if we only want non validated object for specific staff
            $valid_service = 'conservation';
        } else if ($this->input->post('valAttribute') == 'public') {
            $valid_service = 'public';
        } else {
            $valid_service = null;
        }
        $this->session->set_userdata('sel_obj_valid_service',$valid_service);
        $this->select_objet($goal, 1, $objet1_id);
    }
    
    //powerful method to render a sorted list of objet, with 
    //various button to different controllers, depending on input attributes
    //
    //$goal can be :
    // - modify, to list objets an have access to modify, validate and delete buttons
    // - relation, to have access to create a add relation and delete relation buttons
    // - add_relation, to link an objet as arg ($objet1_id) to the selected objet
    public function select_objet($goal = 'modify', $page = 1, $objet1_id = null) {
        //getting the sort option
        if($this->session->userdata('sel_obj_orderBy')!=null){
            $orderBy = $this->session->userdata('sel_obj_orderBy');
        } else {
            $orderBy = 'nom_objet';
        }
        if($this->session->userdata('sel_obj_orderDirection')!=null){
            $orderDirection = $this->session->userdata('sel_obj_orderDirection');
        } else {
            $orderDirection = 'asc';
        }
        if($this->session->userdata('sel_obj_speAttribute')!=null){
            $speAttribute = $this->session->userdata('sel_obj_speAttribute');
        } else {
            $speAttribute = null;
        }
        if($this->session->userdata('sel_obj_speAttributeValue')!=null){
            $speAttributeValue = $this->session->userdata('sel_obj_speAttributeValue');
        } else {
            $speAttributeValue = null;
        }
        if($this->session->userdata('sel_obj_valid')!=null){
            $valid = $this->session->userdata('sel_obj_valid');
        }else{
            $valid = null;
        }
        if($this->session->userdata('sel_obj_valid_service')!=null){
            $valid_service = $this->session->userdata('sel_obj_valid_service');
        }else{
            $valid_service = null;
        }
        //creating the list
        $data = array('listObjet' => $this->objet_model->get_objet_list($orderBy, $orderDirection, $speAttribute, $speAttributeValue, $valid, $valid_service, $page));
        $data['numPage'] = $this->objet_model->count_page_obj($speAttribute, $speAttributeValue, $valid);
        $data['currentPage'] = $page;
        $data['goal'] = $goal;
        if ($objet1_id != null) {
            $data['objetSource'] = new Objet($objet1_id);
        }
        $this->layout->view('moderation/select_objet', $data);
    }

    private function modify($objet_id) {
        $objet = new Objet($objet_id);
        if ($this->form_validation->run('ajout_objet') == FALSE) {
            $this->layout->view('moderation/modify_objet', array('objet' => $objet));
        } else {
            $objet->set_nom_objet($this->input->post('nom_objet'));
            $objet->set_resume($this->input->post('resume'));
            $objet->set_historique($this->input->post('historique'));
            $objet->set_adresse_postale($this->input->post('adresse_postale'));
            $objet->set_mots_cles($this->input->post('mots_cles'));
            
            //Validation
            if ($this->input->post('validate') == 'conservation' && !$objet->get_validation_status('conservation')) {
                $this->update_validation($objet_id,'conservation');
            } else if ($this->input->post('validate') == 'public' && !$objet->get_validation_status('public') && $objet->get_validation_status('conservation')){
                $this->update_validation($objet_id,'public');
            } else if ($this->input->post('validate') == 'edition' && !$objet->get_validation_status('edition') && $objet->get_validation_status('public') && $objet->get_validation_status('conservation')) {
                $this->update_validation($objet_id,'edition');
            }
            /*if (isset($this->input->post('statut'))) {
                $objet->set_statut($this->input->post('statut'));
            }*/
            $success = $objet->save($this->session->userdata('username'));
            $lastAction = 'modify';
            $message = $this->create_success_message($success, $lastAction, $objet->get_nom_objet());
            
            update_coordonnes(); //we update the coordonnees.json file for the map
            
            $this->layout->views('data_center/success_form', array('success' => $success, 'message' => $message));
            $this->select_objet('modify');
        }
    }

    public function validate() {
        $objet_id = $this->input->post('objet_id');
        $objet = new Objet($objet_id);
        $success = $objet->validate();
        update_coordonnes(); //we update the coordonnees.json file for the map
        //creation success message
        $lastAction = 'validate';
        $message = $this->create_success_message($success, $lastAction, $objet->get_nom_objet());
        $this->layout->views('data_center/success_form', array('success' => $success, 'message' => $message));
        $this->select_objet('modify');
    }

    public function delete_objet() {
        $objet_id = $this->input->post('objet_id');
        $objet = new Objet($objet_id); 
        if ($objet->get_objet_id() != null) {
            $success = $this->objet_model->delete($objet_id);
        } else {
            $success = FALSE;
        }
        update_coordonnes(); //we update the coordonnees.json file for the map
        
        $lastAction = 'deletion';
        $message = $this->create_success_message($success, $lastAction, $objet->get_nom_objet());
        $this->layout->views('data_center/success_form', array('success' => $success, 'message' => $message));
        $this->select_objet('modify');
    }

    //render the select objet menu to choose which objet you want to link
    public function add_relation() {
        $objet_id = $this->input->post('objet_id');
        $this->select_objet('add_relation', 1,$objet_id);
    }

    public function add_relation_form() {
        $objet1_id = $this->input->post('objet1_id');
        $objet2_id = $this->input->post('objet2_id');
        if ($this->form_validation->run('ajout_relation') == FALSE) {
            $objet1 = new Objet($objet1_id);
            $objet2 = new Objet($objet2_id);
            $this->load->model('relation_model');
            $type_relation_list = $this->relation_model->get_type_relation_list();

            $data = array('objet1' => $objet1, 'objet2' => $objet2, 'type_relation_list' => $type_relation_list);

            $this->layout->view('moderation/ajout_relation', $data);
        } else {
            $this->load->model('relation_model');
            $relationdata = array();
            $relationdata['objet_id_1'] = $objet1_id;
            $relationdata['objet_id_2'] = $objet2_id;
            $relationdata['type_relation_id'] = $this->input->post('type_relation');
            $relationdata['username'] = $this->session->userdata('username');
            $relationdata['datation_indication_debut'] = $this->input->post('datation_indication_debut');
            $relationdata['datation_indication_fin'] = $this->input->post('datation_indication_fin');

            $dates_infos = conc_2_date($this->input->post('jour_debut'), $this->input->post('mois_debut'), 
                                        $this->input->post('annee_debut'), $this->input->post('jour_fin'), 
                                        $this->input->post('mois_fin'), $this->input->post('annee_fin'));

            $relationdata['date_debut_relation'] = $dates_infos['date_debut'];
            $relationdata['date_fin_relation'] = $dates_infos['date_fin'];
            $relationdata['date_precision'] = $dates_infos['date_precision'];

            $relationdata['parent'] = $this->input->post('parent') ? 'true' : 'false';

            $success = $this->relation_model->ajout_relation($relationdata);
            $lastAction = 'addRelation';
            //creation of the success message
            $objet1 = new Objet($objet1_id);
            $objet2 = new Objet($objet2_id);
            $message = $this->create_success_message($success, $lastAction, $objet1->get_nom_objet(), $objet2->get_nom_objet());

            $this->layout->views('data_center/success_form', array('success' => $success, 'message' => $message));
            $this->select_objet('add_relation', 1, $objet1_id);
        }
    }

    //render the list of objet linked to one objet so that one can delete these relation
    public function delete_relation($objet_id = null) {
        if ($objet_id == null) {
            $objet_id = $this->input->post('objet_id');
        }
        $objet = new Objet($objet_id);
        $linkedObjetArray = $this->objet_model->get_linked_objet($objet_id, null);
        $data = array('objet' => $objet, 'linkedObjetArray' => $linkedObjetArray);
        $this->layout->view('moderation/delete_relation', $data);
    }

    public function delete_relation_form() {
        $objet_id = $this->input->post('objet_id');
        $relation_id = $this->input->post('relation_id');
        $this->load->model('relation_model');
        if($relation_id != null){
            $success = $this->relation_model->delete_relation($relation_id);
        } else {
            $success = FALSE;
        }
        $message = $this->create_success_message($success, 'relationDeletion', $this->input->post('nom_objet_source'), 
                                                    $this->input->post('nom_objet_target'));
        $this->layout->views('data_center/success_form', array('success' => $success, 'message' => $message));

        $this->delete_relation($objet_id);
    }
    
    public function modify_relation_form(){
        $relation_id = $this->input->post('relation_id');
        $this->load->model('relation_model');
        $objet_source_id = $this->input->post('objet_id');
        if ($this->form_validation->run('ajout_relation') == FALSE){
            $objet_source_name = $this->input->post('nom_objet_source');
            $objet_target_name = $this->input->post('nom_objet_target');
            $relation_info = $this->relation_model->get_relation($relation_id);
            $type_relation_list = $this->relation_model->get_type_relation_list();
            $data = array ('relation_id'=>$relation_id, 'objet_source_name'=>$objet_source_name,
                            'objet_target_name'=>$objet_target_name, 'relation_info'=>$relation_info,
                            'type_relation_list'=>$type_relation_list, 'objet_source_id'=>$objet_source_id);
            $this->layout->view('moderation/modify_relation', $data);
        } else {
            $relationdata['type_relation_id'] = $this->input->post('type_relation');
            $relationdata['username'] = $this->session->userdata('username');
            $relationdata['datation_indication_debut'] = $this->input->post('datation_indication_debut');
            $relationdata['datation_indication_fin'] = $this->input->post('datation_indication_fin');

            $dates_infos = conc_2_date($this->input->post('jour_debut'), $this->input->post('mois_debut'), 
                                        $this->input->post('annee_debut'), $this->input->post('jour_fin'), 
                                        $this->input->post('mois_fin'), $this->input->post('annee_fin'));

            $relationdata['date_debut_relation'] = $dates_infos['date_debut'];
            $relationdata['date_fin_relation'] = $dates_infos['date_fin'];
            $relationdata['date_precision'] = $dates_infos['date_precision'];

            $relationdata['parent'] = $this->input->post('parent') ? 't' : 'f';

            $success = $this->relation_model->update_relation($relation_id, $relationdata);
            $message = $this->create_success_message($success, 'modRelation', $this->input->post('nom_objet_source'), 
                                                    $this->input->post('nom_objet_target'));
            $this->layout->views('data_center/success_form', array('success' => $success, 'message' => $message));

            $this->delete_relation($objet_source_id);
        }
    }
    
    public function delete_geom($geom_id, $objet_id) {
        $objet = new Objet($objet_id);
        if ($objet->get_nom_objet() != null && $geom_id != null) {
            $success = $this->objet_model->delete_geometry($geom_id);
        } else {
            $success = FALSE;
        }
        update_coordonnes(); //we update the coordonnees.json file for the map
        
        $message = $this->create_success_message($success, 'geomDeletion', $objet->get_nom_objet());
        $this->layout->views('data_center/success_form', array('success' => $success, 'message' => $message));
        $this->lang->load('map', $this->language);
        $data = array();
        $this->layout->add_css('leaflet');
        $this->layout->add_js('leaflet');
        $this->layout->add_js('addmarkers');
        $this->layout->view('view_data/select_geo', $data);
    }

    private function create_success_message($success, $lastAction, $firstEntity = null, $secondEntity = null) {
        if ($lastAction == 'modify') {
            if ($success) {
                $message = sprintf($this->lang->line('moderation_obj_modify_success'),$firstEntity);
            } else {
                $message = sprintf($this->lang->line('moderation_obj_modify_failure'),$firstEntity);
            }
        } elseif ($lastAction == 'validate') {
            if ($success) {
                $message = sprintf($this->lang->line('moderation_obj_validate_success'),$firstEntity);
            } else {
                $message = sprintf($this->lang->line('moderation_obj_validate_failure'),$firstEntity);
            }
        } elseif ($lastAction == 'deletion') {
            if ($success) {
                $message = sprintf($this->lang->line('moderation_obj_deletion_success'),$firstEntity);
            } else {
                $message = sprintf($this->lang->line('moderation_obj_deletion_failure'),$firstEntity);
            }
        } elseif ($lastAction == 'addRelation') {
            if ($success) {
                $message = sprintf($this->lang->line('moderation_obj_addRel_success'),$firstEntity,$secondEntity);
            } else {
                $message = sprintf($this->lang->line('moderation_obj_addRel_failure'),$firstEntity,$secondEntity);
            }
        } elseif ($lastAction == 'relationDeletion') {
            if ($success) {
                $message = sprintf($this->lang->line('moderation_obj_delRel_success'),$firstEntity,$secondEntity);
            } else {
                $message = sprintf($this->lang->line('moderation_obj_delRel_failure'),$firstEntity,$secondEntity);
            }
        } elseif ($lastAction == 'geomDeletion') {
            if ($success) {
                $message = sprintf($this->lang->line('moderation_obj_geomDel_success'),$firstEntity);
            } else {
                if ($firstEntity != null) {
                    $message = sprintf($this->lang->line('moderation_obj_geomDel_failure'),$firstEntity);
                } else {
                    $message = $this->lang->line('moderation_obj_geomDel_unknown');
                }
            }
        } elseif ($lastAction == 'modRelation') {
            if ($success) {
                $message = 'La relation entre '.$firstEntity.' et '.$secondEntity.' a été modifié avec succès';
            } else {
                $message = 'Erreur : la relation entre '.$firstEntity.' et '.$secondEntity.' n\'a pas pu être modifiée';
            }
        }
        return $message;
    }

    public function check_nom($name) {
        $objet = $this->objet_model->get_objet('nom_objet', $name);
        $objet_id = $this->input->post('objet_id');
        if ($objet != null && ($objet['objet_id'] != $objet_id)) {
            $this->form_validation->set_message('check_nom', sprintf($this->lang->line('common_add_obj_check_nom'),$name));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function check_date($input, $boundary) { //callback function checking date_debut or date_fin validity
        $day = (int) $this->input->post('jour_' . $boundary);
        $month = (int) $this->input->post('mois_' . $boundary);
        $year = (int) $this->input->post('annee_' . $boundary);
        if ($day != null && $month != null){
            $valid = checkdate($month, $day, $year);
        } else{
            $valid = (bool) $year;
        }
        if (!$valid) {
            $this->form_validation->set_message('check_date', $this->lang->line('common_add_obj_check_date'));
        }
        return $valid;
    }
    
    //update review.json file, should be called after each validation
    //3 possible validation : conservation, public, edition
    //each step triggers email for next step
    //each validation is recorded into json file
    public function update_validation($objet_id,$validation_type) {
        $objetManager = new Objet_model($objet_id);
        //Request the db for more info
        //$object_name = $objetManager.get_nom_objet();

        if (file_exists(FCPATH . 'assets/utils/review.json')) {
            $jsonList = file_get_contents(FCPATH . 'assets/utils/review.json');
            $liste = json_decode($jsonList, true); //true parameter is mandatory
            $liste[$objet_id][$validation_type] = True;
            $liste[$objet_id]['reviewer'] = False; // Reset current review locking
        } else { 
            $liste = array(); 
            $liste[$objet_id][$validation_type] = True;
            $liste[$objet_id]['reviewer'] = False;
        }
        
            $newJsonList = json_encode($liste);
            file_put_contents(FCPATH . 'assets/utils/review.json', $newJsonList);
        
        //send email
        $config = array();        
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
        
        $this->load->library('email');
        $this->email->initialize($config);

        $this->email->from('benjamin.hervy@chateau-nantes.fr', 'email automatique'); //mettre une adresse valide
        if ($validation_type == 'conservation') {
            $to_email = 'benjamin.hervy@ec-nantes.fr';
        }
        else if ($validation_type == 'public') {
            $to_email = 'benjamin.hervy@irccyn.ec-nantes.fr';
        }
        else if ($validation_type == 'edition') {
            $to_email = 'benjamin.hervy@chateau-nantes.fr';
        }
        $this->email->to($to_email);
        $this->email->subject('[Nantes1900] Noreply : validation d\'une fiche');
        $msg = '<h1>Une fiche a été validée par le service'. $validation_type .'</h1>';
        $msg = $msg . '<p>La fiche n°'. $objet_id .' a été validée.';
        $msg = $msg . 'Vous pouvez désormais y accéder pour la modifier puis la valider.</p>';
        $msg = $msg . '<p>Pour y accéder, vous devez vous connectez à l\'adresse suivante : ';
        $msg = $msg . anchor('accueil') .'</p>';
        $msg = $msg . '<p>Vous retrouverez la fiche dans le menu "Modération", puis "Modifier un objet"</p>'; 
        $msg = $msg . '<p>En cas de problème, essayez de contacter l\'administrateur principal à l\'adresse de l\'expéditeur.</p>';
        $this->email->message($msg);

        //$this->email->send();
    }
    
    //Function purpose: lock modification when moderator is working on
    function lock_review(){
        
        $objet_id = $this->input->post('objet_id');
        $objet = new Objet($objet_id);
        
        $this->select_objet('modify');
        
        $username = $this->session->userdata('username');
        $objetManager = new Objet_model($objet_id);

        if (file_exists(FCPATH . 'assets/utils/review.json')) {
            $jsonList = file_get_contents(FCPATH . 'assets/utils/review.json');
            $liste = json_decode($jsonList, true);
            $liste[$objet_id]['reviewer'] = $username;
        } else { 
            $liste = array(); 
            $liste[$objet_id]['reviewer'] = $username;
        }
        
            $newJsonList = json_encode($liste);
            file_put_contents(FCPATH . 'assets/utils/review.json', $newJsonList);
    }
}

/* End of file modify_objet.php */
/* Location : ./application/models/modify_objet.php */

