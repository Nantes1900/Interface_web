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
                }elseif ($typeRessource=='ressource_graphique') {
                    $this->modify_image($this->input->post('ressource_id'));
                }elseif ($typeRessource=='ressource_video') {
                    $this->modify_video($this->input->post('ressource_id'));
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
        require_once ('application/models/ressource_graphique.php');
        require_once ('application/models/ressource_video.php');
        $this->load->model('ressource_texte_model');
        $this->load->model('ressource_graphique_model');
        $this->load->model('ressource_video_model');
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
            redirect('moderation/modify_ressource/index/ressource_texte','refresh');
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
                    //as title is unique, we add the title to the name of the image
                    rename($dir . $imageData['file_name'], $dir .$ressource->get_titre().$imageData['file_name']);
                    $ressource->set_image($ressource->get_titre().$imageData['file_name']);
                    $ressource->set_dimension($imageData['image_size_str']);
                    
                    $ressource->save();
                    redirect('moderation/modify_ressource/index/ressource_graphique','refresh');
                }
            }else{
                //modifiying $ressource out of post data
                $ressource =  $this->mod_img_basic($ressource); //just basic posted data collecting
                $ressource->save();
                redirect('moderation/modify_ressource/index/ressource_graphique','refresh');
            }
        }
    }
    
    //basic treatment for posted image form
    function mod_img_basic(Ressource_graphique $ressource){
        $attrArray = array('titre','description','reference_ressource','auteurs','editeur','ville_edition','couleur',
                            'mots_cles','legende','image_link','localisation','technique','type_support');
        foreach($attrArray as $attr){
            $setMethod = 'set_'.$attr;
            $ressource->$setMethod($this->input->post($attr));
        }
        $date_infos = conc_date($this->input->post('jour'),$this->input->post('mois'),$this->input->post('annee'));
        $ressource->set_date_debut_ressource($date_infos['date']);
        $ressource->set_date_precision($date_infos['date_precision']);
        $date_infos = conc_date($this->input->post('jourPrise'),$this->input->post('moisPrise'),$this->input->post('anneePrise'));
        $ressource->set_date_prise_vue($date_infos['date']);
        if ($this->input->post('validation')==TRUE){ //beware, in database, booleans are t (for TRUE) and f (FALSE)
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
                 
                    //as title is unique, we add the title to the name of the image
                    rename($dir . $videoData['file_name'], $dir .$ressource->get_titre().$videoData['file_name']);
                    $ressource->set_video($ressource->get_titre().$videoData['file_name']);
                    
                    $ressource->save();
                    redirect('moderation/modify_ressource/index/ressource_video','refresh');
                }
            }else{
                //modifiying $ressource out of post data
                $ressource =  $this->mod_vid_basic($ressource); //just basic posted data collecting
                $ressource->save();
                redirect('moderation/modify_ressource/index/ressource_video','refresh');
            }
        }
    }
    
    //basic treatment for posted image form
    function mod_vid_basic(Ressource_video $ressource){
        $attrArray = array('titre','description','reference_ressource','auteurs','editeur','ville_edition','duree',
                            'mots_cles','diffusion','versionvideo','distribution','production','video_link');
        foreach($attrArray as $attr){
            $setMethod = 'set_'.$attr;
            $ressource->$setMethod($this->input->post($attr));
        }
        $date_infos = conc_date($this->input->post('jour'),$this->input->post('mois'),$this->input->post('annee'));
        $ressource->set_date_debut_ressource($date_infos['date']);
        $ressource->set_date_precision($date_infos['date_precision']);
        $date_infos = conc_date($this->input->post('jourProd'),$this->input->post('moisProd'),$this->input->post('anneeProd'));
        $ressource->set_date_production($date_infos['date']);
        if ($this->input->post('validation')==TRUE){ //beware, in database, booleans are t (for TRUE) and f (FALSE)
            $ressource->set_validation('t');
        }else{
            $ressource->set_validation('f');
        }
        return $ressource;
    }
    
    public function delete_ressource($typeRessource){
        if ( $this->session->userdata('user_level') == 4 ){
            $ressource_id = $this->input->post('ressource_id');
            $typeRessourceModel= ucfirst($typeRessource).'_model';
            $ressourceManager = new $typeRessourceModel();
            $ressourceManager->delete($ressource_id);
            redirect('moderation/modify_ressource/index/'.$typeRessource,'refresh');
        }else{
            redirect('accueil/accueil/','refresh');
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
}

/* End of file modify_ressource.php */
/* Location : ./application/models/modify_ressource.php */

