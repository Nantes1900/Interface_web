<?php

/**
 * controller to manage ressource modification
 *
 * @author paulyves
 */

class Modify_ressource extends CI_Controller{
    public function index($typeRessource,$goal='modify'){
        if($this->input->post('ressource_id') == null) {
            $this->select_ressource($typeRessource, $goal);
        } elseif ($typeRessource == 'ressource_texte') {
            $this->modify_texte($this->input->post('ressource_id'));
        } elseif ($typeRessource == 'ressource_graphique') {
            $this->modify_image($this->input->post('ressource_id'));
        } elseif ($typeRessource == 'ressource_video') {
            $this->modify_video($this->input->post('ressource_id'));
        }
    }
    
    public function __construct() {
	
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        require_once ('application/models/ressource_texte.php');
        require_once ('application/models/ressource_graphique.php');
        require_once ('application/models/ressource_video.php');
        $this->load->model('ressource_texte_model');
        $this->load->model('ressource_graphique_model');
        $this->load->model('ressource_video_model');
        $this->load->helper(array('dates','ressource'));
        $this->load->library('form_validation');
        $this->load->view('header');
        if (!$this->session->userdata('username')) { //checking that user is connected
            redirect('accueil/accueil/not_connected/', 'refresh');
        } elseif (!$this->session->userdata('user_level') >= 5) {
            redirect('accueil/accueil/', 'refresh');
        }
    } 
    
    //setting the sort option of the ressource list
    public function sort_sel_ress($typeRessource, $goal){
        //security
        if (!check_typeRessource($typeRessource)) {
            redirect('accueil/accueil');
        }
        //managing the sort option
        $orderBy = $this->input->post('orderBy');
        if ($orderBy == null) {
            $orderBy = 'titre';
        }
        $this->session->set_userdata('sel_ress_orderBy', $orderBy);
        
        $orderDirection = $this->input->post('orderDirection');
        $this->session->set_userdata('sel_ress_orderDirection', $orderDirection);
        
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
        $this->session->set_userdata('sel_ress_speAttribute', $speAttribute);
        $this->session->set_userdata('sel_ress_speAttributeValue', $speAttributeValue);
        
        if ($this->input->post('validation') == TRUE) { //we check if we only want non validated objet
            $valid = 'f';
        } else {
            $valid = null;
        }
        $this->session->set_userdata('sel_obj_valid', $valid);
        $this->select_ressource($typeRessource, $goal);
    }
    
    public function select_ressource($typeRessource,$goal, $page = 1){
        //security
        if (!check_typeRessource($typeRessource)) {
            redirect('accueil/accueil');
        }
        
        //managing the sort option
        
        if($this->session->userdata('sel_ress_orderBy')!=null){
            $orderBy = $this->session->userdata('sel_ress_orderBy');
        } else {
            $orderBy = 'titre';
        }
        if($this->session->userdata('sel_ress_orderDirection')!=null){
            $orderDirection = $this->session->userdata('sel_ress_orderDirection');
        } else {
            $orderDirection = 'asc';
        }
        if($this->session->userdata('sel_ress_speAttribute')!=null){
            $speAttribute = $this->session->userdata('sel_ress_speAttribute');
        } else {
            $speAttribute = null;
        }
        if($this->session->userdata('sel_ress_speAttributeValue')!=null){
            $speAttributeValue = $this->session->userdata('sel_ress_speAttributeValue');
        } else {
            $speAttributeValue = null;
        }
        if($this->session->userdata('sel_ress_valid')!=null){
            $valid = $this->session->userdata('sel_ress_valid');
        } else {
            $valid = null;
        }
        

        //creating the list
        $data = array('typeRessource' => $typeRessource, 'goal' => $goal);

        $typeRessource = ucfirst($typeRessource) . '_model';
        $ressourceManager = new $typeRessource();
        $data['listRessource'] = $ressourceManager->get_ressource_list($orderBy, $orderDirection, $speAttribute, $speAttributeValue, $valid, $page);
        $data['numPage'] = $ressourceManager->count_page_ress($speAttribute, $speAttributeValue, $valid);
        $data['currentPage'] = $page;
        
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
            if ($this->input->post('validate')==TRUE){ //beware, in database, booleans are t (for TRUE) and f (FALSE)
                $ressource->set_validation('t');
            }else{
                $ressource->set_validation('f');
            }
            $success = $ressource->save();
            
            //creation message
            $lastAction = 'modify_texte';
            $message = $this->create_success_message($success, $lastAction, $ressource->get_titre());
            $this->load->view('data_center/success_form',array('success'=>$success, 'message'=> $message));
            $this->select_ressource('ressource_texte', 'modify');
        }
    }
    
    private function modify_image($ressource_id){
        $ressource = new Ressource_graphique($ressource_id);
        $dir = './assets/images/';
        $config['upload_path'] = $dir;
        $config['allowed_types'] = 'jpg|jpeg|gif|png';
        $config['max_size']	= '100';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $this->load->library('upload',$config);
        
        if ($this->form_validation->run('ajout_image') == FALSE) {
            $this->load->view('moderation/modify_image',array('ressource'=>$ressource, 'error'=>''));
            $this->load->view('footer');
        }else{
            if ($_FILES && $_FILES['image']['name'] !== "") { //we want to make image re-uploading optional
                if ( ! $this->upload->do_upload('image')){
                    $data = array('ressource' => $ressource,'error' => $this->upload->display_errors());
                    $this->load->view('moderation/modify_image',$data);
                    $this->load->view('footer');
                }else{
                    //getting info about upload
                    $imageData = $this->upload->data();
                    
                    //modifiying $ressource out of post data
                    $ressource =  $this->mod_img_basic($ressource); //just basic posted data collecting
                        
                    //we delete the old image
                    if($ressource->get_image()!=null){
                        $this->load->helper('file');
                        $path=  FCPATH.'assets/images/'.$ressource->get_image();
                        if (file_exists($path)){
                            unlink($path);
                        }
                    }
        
                    //as title is unique, we add the title to the name of the image
                    rename($dir . $imageData['file_name'], $dir .$ressource->get_titre().$imageData['file_name']);
                    $ressource->set_image($ressource->get_titre().$imageData['file_name']);
                    $ressource->set_dimension($imageData['image_size_str']);
                    
                    $success = $ressource->save();
            
                    //creation message
                    $lastAction = 'modify_image';
                    $message = $this->create_success_message($success, $lastAction, $ressource->get_titre());
                    $this->load->view('data_center/success_form',array('success'=>$success, 'message'=> $message));
                    $this->select_ressource('ressource_graphique', 'modify');
                }
            }else{
                //modifiying $ressource out of post data
                $ressource =  $this->mod_img_basic($ressource); //just basic posted data collecting
                $success = $ressource->save();
            
                //creation message
                $lastAction = 'modify_image';
                $message = $this->create_success_message($success, $lastAction, $ressource->get_titre());
                $this->load->view('data_center/success_form',array('success'=>$success, 'message'=> $message));
                $this->select_ressource('ressource_graphique', 'modify');
            }
        }
    }
    
    //basic treatment for posted image form
    private function mod_img_basic(Ressource_graphique $ressource){
        $attrArray = array('titre','description','reference_ressource','disponibilite','auteurs','editeur','ville_edition',
                            'couleur','mots_cles','legende','image_link','localisation','technique','type_support');
        foreach($attrArray as $attr){
            $setMethod = 'set_'.$attr;
            $ressource->$setMethod($this->input->post($attr));
        }
        $date_infos = conc_date($this->input->post('jour'),$this->input->post('mois'),$this->input->post('annee'));
        $ressource->set_date_debut_ressource($date_infos['date']);
        $ressource->set_date_precision($date_infos['date_precision']);
        $date_infos = conc_date($this->input->post('jourPrise'),$this->input->post('moisPrise'),$this->input->post('anneePrise'));
        $ressource->set_date_prise_vue($date_infos['date']);
        if ($this->input->post('validate')==TRUE){ //beware, in database, booleans are t (for TRUE) and f (FALSE)
            $ressource->set_validation('t');
        }else{
            $ressource->set_validation('f');
        }
        if ($this->input->post('pagination')!=null){
                $ressource->set_pagination($this->input->post('pagination'));
        }
        return $ressource;
    }
    
    private function modify_video($ressource_id){
        $ressource = new Ressource_video($ressource_id);
        $dir = './assets/video/';
        $config['upload_path'] = $dir;
        $config['allowed_types'] = 'avi|flv|wmv|mpeg|mp3|mp4';
        $config['max_size']	= '102400';
        $this->load->library('upload',$config);
        set_time_limit(120); //change the max execution time of php to 120 sec for this method
        if($this->form_validation->run('ajout_video') == FALSE){
            
            $this->load->view('moderation/modify_video',array('ressource'=>$ressource, 'error'=>''));
            $this->load->view('footer');
                
        } else {
            if ($_FILES && $_FILES['video']['name'] !== "") { //we want to make video uploading optional
                if ( ! $this->upload->do_upload('video')){
                    $data = array('ressource' => $ressource,'error' => $this->upload->display_errors());
                    $this->load->view('moderation/modify_video',$data);
                    $this->load->view('footer');
                }else{
                    //getting info about upload
                    $videoData = $this->upload->data();
                    
                    //modifiying $ressource out of post data
                    $ressource =  $this->mod_vid_basic($ressource); //just basic posted data collecting
                        
                    //we delete the old video
                    if($ressource->get_video()!=null){
                        $this->load->helper('file');
                        $path=  FCPATH.'assets/video/'.$ressource->get_video();
                        if (file_exists($path)){
                            unlink($path);
                        }
                    }
                         
                    //as title is unique, we add the title to the name of the image
                    rename($dir . $videoData['file_name'], $dir .$ressource->get_titre().$videoData['file_name']);
                    $ressource->set_video($ressource->get_titre().$videoData['file_name']);
                    
                    $success = $ressource->save();
            
                    //creation message
                    $lastAction = 'modify_video';
                    $message = $this->create_success_message($success, $lastAction, $ressource->get_titre());
                    $this->load->view('data_center/success_form',array('success'=>$success, 'message'=> $message));
                    $this->select_ressource('ressource_video', 'modify');
                }
            }else{
                //modifiying $ressource out of post data
                $ressource =  $this->mod_vid_basic($ressource); //just basic posted data collecting
                $success = $ressource->save();
            
                //creation message
                $lastAction = 'modify_video';
                $message = $this->create_success_message($success, $lastAction, $ressource->get_titre());
                $this->load->view('data_center/success_form',array('success'=>$success, 'message'=> $message));
                $this->select_ressource('ressource_video', 'modify');
            }
        }
    }
    
    //basic treatment for posted image form
    private function mod_vid_basic(Ressource_video $ressource){
        $attrArray = array('titre','description','reference_ressource','disponibilite','auteurs','editeur','ville_edition',
                            'duree','mots_cles','diffusion','versionvideo','distribution','production','video_link');
        foreach($attrArray as $attr){
            $setMethod = 'set_'.$attr;
            $ressource->$setMethod($this->input->post($attr));
        }
        $date_infos = conc_date($this->input->post('jour'),$this->input->post('mois'),$this->input->post('annee'));
        $ressource->set_date_debut_ressource($date_infos['date']);
        $ressource->set_date_precision($date_infos['date_precision']);
        $date_infos = conc_date($this->input->post('jourProd'),$this->input->post('moisProd'),$this->input->post('anneeProd'));
        $ressource->set_date_production($date_infos['date']);
        if ($this->input->post('validate')==TRUE){ //beware, in database, booleans are t (for TRUE) and f (FALSE)
            $ressource->set_validation('t');
        }else{
            $ressource->set_validation('f');
        }
        return $ressource;
    }
    
    public function validate_ressource($typeRessource) {
        $ressource_id = $this->input->post('ressource_id');
        $typeRessourceClass = ucfirst($typeRessource);
        if (class_exists($typeRessourceClass)) {
            $ressource = new $typeRessourceClass($ressource_id);
            if ($ressource->get_titre() != null) {
                $success = $ressource->validate();
            } else {
                $success = FALSE;
            }
            //creation message
            $lastAction = 'validate-' . $typeRessource;
            $message = $this->create_success_message($success, $lastAction, $ressource->get_titre());
            $this->load->view('data_center/success_form', array('success' => $success, 'message' => $message));
            $this->select_ressource($typeRessource, 'modify');
        }
    }
    
    public function delete_ressource($typeRessource) {
        $ressource_id = $this->input->post('ressource_id');
        $typeRessourceModel = ucfirst($typeRessource) . '_model';
        if (class_exists($typeRessourceModel)) {
            $ressourceManager = new $typeRessourceModel();
            if ($ressource_id != null) {
                $success = $ressourceManager->delete($ressource_id);
            } else {
                $success = FALSE;
            }
            //creation message
            $lastAction = 'delete-' . $typeRessource;
            $message = $this->create_success_message($success, $lastAction, $this->input->post('titre'));
            $this->load->view('data_center/success_form', array('success' => $success, 'message' => $message));
            $this->select_ressource($typeRessource, 'modify');
        }
    }
        
    public function add_doc($typeRessource){
        if ( $typeRessource == 'ressource_texte' || 
             $typeRessource == 'ressource_graphique' || 
             $typeRessource == 'ressource_video'){
            
            $ressource_id = $this->input->post('ressource_id');
            $this->select_objet('add_doc', $ressource_id, $typeRessource);
        }else{
            redirect('accueil/accueil/','refresh');
        }
    }
    
    //setting the sort option of the objet list
    public function sort_sel_obj($goal = 'add_doc', $ressource_id, $typeRessource){
        
        if (!check_ressource($typeRessource, $ressource_id)) {
            redirect('accueil/accueil');
        }
        
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
        $this->select_objet($goal, $ressource_id, $typeRessource, 1);
    }
    
    //powerful method to render a sorted list of objet, with various button to different controllers, depending on input attributes
    //slightly different than in modify_objet because args are not the same
    public function select_objet($goal = 'add_doc', $ressource_id, $typeRessource, $page = 1){
        if (!check_ressource($typeRessource, $ressource_id)) {
            redirect('accueil/accueil');
        }
        
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

        //creating the list
        require_once ('application/models/objet.php');
        $this->load->model('objet_model');

        $data = array('listObjet' => $this->objet_model->get_objet_list($orderBy, $orderDirection, $speAttribute, $speAttributeValue, $valid, $page));
        $data['numPage'] = $this->objet_model->count_page_obj($speAttribute, $speAttributeValue, $valid);
        $data['currentPage'] = $page;
        $data['goal'] = $goal;
        
        $ressourceMethod = ucfirst($typeRessource);
        $data['ressource'] = new $ressourceMethod($ressource_id);
        $data['typeRessource'] = $typeRessource;
        
        $this->load->view('moderation/select_objet', $data);
        $this->load->view('footer');
    }
    
    public function add_doc_form($typeRessource){
        if ( $typeRessource == 'ressource_texte' || 
             $typeRessource == 'ressource_graphique' || 
             $typeRessource == 'ressource_video'){
            
            $ressource_id = $this->input->post('ressource_id');
            $objet_id = $this->input->post('objet_id');
            $typeRessourceModel= ucfirst($typeRessource).'_model';
            $ressourceManager = new $typeRessourceModel();
            if($typeRessource!='ressource_video'){ //if we it's not a video, we may want to refer to a precise page
                if($this->form_validation->run('add_documentation') == TRUE){
                    $page = $this->input->post('page');
                }else{
                    $page = 0;
                }
                $success = $ressourceManager->add_documentation($objet_id,$ressource_id,$page);
            }else{
                $success = $ressourceManager->add_documentation($objet_id,$ressource_id);
            }
            
            //creation message
            $lastAction = 'addDoc-'.$typeRessource;
            $message = $this->create_success_message($success, $lastAction, $this->input->post('ressource_titre'), $this->input->post('nom_objet'));
            $this->load->view('data_center/success_form',array('success'=>$success, 'message'=> $message));
            $this->select_ressource($typeRessource, 'documentation');
        }else{
            redirect('accueil/accueil/','refresh');
        }
    }
    
    public function delete_doc($typeRessource){ //load the view to delete documentation related to a ressource
        if ( $this->session->userdata('user_level') >= 5 ){
            $ressource_id = $this->input->post('ressource_id');
            
            $typeRessourceModel= ucfirst($typeRessource).'_model';//adding list of documentation as arg for webpage
            $ressourceManager = new $typeRessourceModel();
            $data = array('documentationArray'=>$ressourceManager->get_linked_objet($ressource_id));
            $data['typeRessource']=$typeRessource;
            
            $typeRessource = ucfirst($typeRessource); //adding the ressource as argument for webpage
            $ressource = new $typeRessource($ressource_id);
            $data['ressource']=$ressource;
            
            $this->load->view('moderation/delete_documentation', $data);
            $this->load->view('footer');
        }else{
            redirect('accueil/accueil/','refresh');
        }
    }
    
    public function delete_documentation($typeRessource){
        if ( $typeRessource == 'ressource_texte' || 
             $typeRessource == 'ressource_graphique' || 
             $typeRessource == 'ressource_video'){
            
            $ressource_id = $this->input->post('ressource_id');
            $documentation_id = $this->input->post('documentation_id');

            $typeRessourceModel = ucfirst($typeRessource) . '_model'; //adding list of documentation as arg for webpage
            $ressourceManager = new $typeRessourceModel();

            if ($documentation_id != null) {
                $success = $ressourceManager->delete_documentation($documentation_id);
            } else {
                $success = FALSE;
            }
            //creation message
            $lastAction = 'removeDoc-' . $typeRessource;
            $message = $this->create_success_message($success, $lastAction, $this->input->post('ressource_titre'), $this->input->post('nom_objet'));
            $this->load->view('data_center/success_form', array('success' => $success, 'message' => $message));

            $this->delete_doc($typeRessource);
        } else {
            redirect('accueil/accueil/', 'refresh');
        }
    }
    
    public function check_date($field, $extension=null){ //callback function checking date validity
        $day = (int) $this->input->post('jour'.$extension);
        $month = (int) $this->input->post('mois'.$extension);
        $year = (int) $this->input->post('annee'.$extension);
        $valid = checkdate($month,$day,$year);
        if (!$valid){
            $this->form_validation->set_message('check_date', 'Date invalide');
        }
        return $valid;
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
    
    private function create_success_message($success, $lastAction, $firstEntity = null, $secondEntity = null ){
         if($lastAction == 'modify_texte'){
             if($success){
                 $message = 'La modification de la ressource textuelle <b>'.$firstEntity.'</b> s\'est déroulée avec succès';
             }else {
                 $message = 'Erreur : la modification de la ressource textuelle <b>'.$firstEntity.'</b> a échoué ';
             }
         } elseif($lastAction == 'modify_image'){
             if($success){
                 $message = 'La modification de la ressource graphique <b>'.$firstEntity.'</b> s\'est déroulée avec succès';
             }else {
                 $message = 'Erreur : la modification de la ressource graphique <b>'.$firstEntity.'</b> a échoué ';
             }
         } elseif($lastAction == 'modify_video'){
             if($success){
                 $message = 'La modification de la ressource video <b>'.$firstEntity.'</b> s\'est déroulée avec succès';
             }else {
                 $message = 'Erreur : la modification de la ressource video <b>'.$firstEntity.'</b> a échoué ';
             }
         } elseif(preg_match("#^validate#", $lastAction)){
             $types = explode('_', $lastAction);
             if($types['1']=='texte'){$types['1']='textuelle';}
             if($success){
                 $message = 'La ressource '.$types['1'].' <b>'.$firstEntity.'</b> a bien été validé';
             }else {
                 $message = 'Erreur : la ressource '.$types['1'].' <b>'.$firstEntity.'</b> n\'a pas été validé ';
             }
         } elseif(preg_match("#^delete#", $lastAction)){
             $types = explode('_', $lastAction);
             if($types['1']=='texte'){$types['1']='textuelle';}
             if($success){
                 $message = 'La ressource '.$types['1'].' <b>'.$firstEntity.'</b> a bien été supprimé';
             }else {
                 $message = 'Erreur : la ressource '.$types['1'].' <b>'.$firstEntity.'</b> n\'a pas été supprimé ';
             }
         } elseif(preg_match("#^addDoc#", $lastAction)){
             $types = explode('_', $lastAction);
             if($types['1']=='texte'){$types['1']='textuelle';}
             if($success){
                 $message = 'La documentation '.$types['1'].' entre <b>'.
                            $firstEntity.'</b> et <b>'.$secondEntity.'</b> a bien été créé';
             }else {
                 $message = 'Erreur : la documentation '.$types['1'].' entre <b>'.
                            $firstEntity.'</b> et <b>'.$secondEntity.'</b> n\'a pas été créé ';
             }
         } elseif(preg_match("#^removeDoc#", $lastAction)){
             $types = explode('_', $lastAction);
             if($types['1']=='texte'){$types['1']='textuelle';}
             if($success){
                 $message = 'La documentation '.$types['1'].' entre <b>'.
                            $firstEntity.'</b> et <b>'.$secondEntity.'</b> a bien été supprimé';
             }else {
                 $message = 'Erreur : la documentation '.$types['1'].' entre <b>'.
                            $firstEntity.'</b> et <b>'.$secondEntity.'</b> n\'a pas été supprimé ';
             }
         }
         
         return $message;
     }
    
}

/* End of file modify_ressource.php */
/* Location : ./application/models/modify_ressource.php */

