<?php

/**
 * Ajout_ressource class
 * 
 * Génére un formulaire afin d'ajouter une ressource à la base.
 * 
 * @author NATIVEL Pierre-Alexandre
 * 
 */

class Ajout_ressource extends CI_Controller
{

        /**
         * Redirige automatiquement vers le choix du type de ressource
         * @access public
         */
	public function index()
	{
            if ( $this->session->userdata('username') ) {
                $this->load->view('data_center/data_center');
                $this->choix_ressource(); 
            }else{
                $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
            }            
	}

        /**
         * Charge automatiquement la bibliothèque "form_validation" et les helper "form" et "dates" à chaque appel du contrôleur
         * @access public
         */
	public function __construct()
	{
            parent::__construct();

            //Ce code sera executé charque fois que ce contrôleur sera appelé
            
            $this->load->library('form_validation');
            $this->load->helper(array('form','dates'));
            $this->load->view('header');
	}
        
        /**
         * Propose un choix du type de ressource, et redirige vers la génération de formulaire associée
         * @access public
         */
        public function choix_ressource()
        {
            $this->load->view('data_center/choix_ressource');
        }
        
        /**
         * Génére le formulaire permettant d'ajouter une ressource textuelle à la base, valide les données et les transmets au modèle ressource_texte_model
         * 
         * @access public
         * 
         */
        public function formulaire_texte()
        {
            
            $this->load->view('data_center/data_center');           
            $this->load->model('ressource_texte_model');
            
            if ($this->form_validation->run('ajout_texte') == FALSE) 
            {
                $this->load->view('data_center/ajout_texte');
                $this->load->view('footer');
            }
            else
            {
                $textedata = array();
                $textedata['titre'] = $this->input->post('titre');
                $textedata['reference_ressource'] = $this->input->post('reference_ressource');
                $textedata['disponibilite'] = $this->input->post('disponibilite');
                $textedata['description'] = $this->input->post('description');
                $textedata['auteurs'] = $this->input->post('auteurs');
                $textedata['editeur'] = $this->input->post('editeur');
                $textedata['ville_edition'] = $this->input->post('ville_edition');
                
                //Le champ pagination ne peut pas rester vide
                if ( ! $this->input->post('pagination'))
                {
                    $textedata['pagination'] = '0';
                }
                else
                {
                    $textedata['pagination'] = $this->input->post('pagination');
                }
                
                $textedata['sous_categorie'] = $this->input->post('sous_categorie');
                $textedata['mots_cles'] = $this->input->post('mots_cles');
                $textedata['username'] = $this->session->userdata('username');
                                
                $date_infos = conc_date($this->input->post('jour'),$this->input->post('mois'),$this->input->post('annee'));
                                
                $textedata['date'] = $date_infos['date'];
                $textedata['date_precision'] = $date_infos['date_precision'];
                    
                $this->ressource_texte_model->ajout_texte($textedata);            
                redirect('data_center/data_center/','refresh');
                
                /** @todo Ajouter une page de confirmation du succès d'ajout de l'objet */
            }
         
        /** @todo Coder les générations de formulaires pour l'ajout des autres types de ressources*/
            
        }
        
        public function formulaire_image(){
            require ('application/models/ressource_graphique.php');
            $this->load->view('data_center/data_center');           
            $this->load->model('ressource_graphique_model');
            $dir = './assets/images/';
            $config['upload_path'] = $dir;
            $config['allowed_types'] = 'jpg|jpeg|gif|png';
            $config['max_size']	= '100';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $this->load->library('upload',$config);
            
            if($this->form_validation->run('ajout_image') == FALSE){
                
                $this->load->view('data_center/ajout_image', array('error' => ' ' ));
                $this->load->view('footer');   
                
            } else {
                
                if ( ! $this->upload->do_upload('image')){
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('data_center/ajout_image', $error);
		} else {
                    //getting info about upload
                    $imageData = $this->upload->data();
                    
                    //creating a Ressource_graphique entity out of post data
                    $array = array();
                    $ressource = new Ressource_graphique($array);
                    $ressource->set_date_creation(date('Y-m-d H:i:s'));
                    $ressource->set_username($this->session->userdata('username'));
                    $ressource->set_titre($this->input->post('titre'));
                    $ressource->set_description($this->input->post('description'));
                    $ressource->set_reference_ressource($this->input->post('reference_ressource'));
                    $ressource->set_theme_ressource($this->input->post('theme_ressource'));
                    $ressource->set_auteurs($this->input->post('auteurs'));
                    $ressource->set_editeur($this->input->post('editeur'));
                    $ressource->set_ville_edition($this->input->post('ville_edition'));
                    $date_infos = conc_date($this->input->post('jour'),$this->input->post('mois'),$this->input->post('annee'));
                    $ressource->set_date_debut_ressource($date_infos['date']);
                    $ressource->set_date_precision($date_infos['date_precision']);
                    $ressource->set_mots_cles($this->input->post('mots_cles'));
                    $ressource->set_legende($this->input->post('legende'));
                    $ressource->set_couleur($this->input->post('couleur'));
                    if ( ! $this->input->post('pagination')) {
                        $ressource->set_pagination('0');
                    } else {
                        $textedata['pagination'] = $this->input->post('pagination');
                    }
                    //as title is unique, we add the title to the name of the image
                    rename($dir . $imageData['file_name'], $dir .$ressource->get_titre().$imageData['file_name']);
                    $ressource->set_image($ressource->get_titre().$imageData['file_name']);
                    
                    $ressource->set_dimension($imageData['image_size_str']);
                    
                    $date_infos = conc_date($this->input->post('jourPrise'),$this->input->post('moisPrise'),$this->input->post('anneePrise'));
                    $ressource->set_date_prise_vue($date_infos['date']);
                    
                    $ressource->set_localisation($this->input->post('localisation'));
                    
                    $ressource->set_technique($this->input->post('technique'));
                    $ressource->set_type_support($this->input->post('type_support'));
                    
                    //we set the manager and add $ressource in the database
                    $ressourceManager = new Ressource_graphique_model();
                    $ressourceManager->ajout_ressource($ressource);
                    redirect('data_center/data_center/','refresh');
                }
            }
        }
        
        public function formulaire_video(){
            require ('application/models/ressource_video.php');
            $this->load->view('data_center/data_center');           
            $this->load->model('ressource_video_model');
            $dir = './assets/video/';
            $config['upload_path'] = $dir;
            $config['allowed_types'] = 'avi|flv|wmv|mpeg|mp3|mp4';
            $config['max_size']	= '102400';
            $this->load->library('upload',$config);
            set_time_limit(120); //change the max execution time of php to 120 sec for this method
            if($this->form_validation->run('ajout_video') == FALSE){
                
                $this->load->view('data_center/ajout_video', array('error' => ' ' ));
                $this->load->view('footer');   
                
            } else {
                
                if ( ! $this->upload->do_upload('video')){
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('data_center/ajout_video', $error);
		} else {
                    //getting info about upload
                    $videoData = $this->upload->data();
                    
                    //creating a Ressource_video entity out of post data
                
                    $ressource = new Ressource_video(array());
                    $ressource->set_date_creation(date('Y-m-d H:i:s'));
                    $ressource->set_username($this->session->userdata('username'));
                    $ressource->set_titre($this->input->post('titre'));
                    $ressource->set_description($this->input->post('description'));
                    $ressource->set_reference_ressource($this->input->post('reference_ressource'));
                    $ressource->set_disponibilite($this->input->post('disponibilité'));
                    $ressource->set_theme_ressource($this->input->post('theme_ressource'));
                    $ressource->set_auteurs($this->input->post('auteurs'));
                    $ressource->set_editeur($this->input->post('editeur'));
                    $ressource->set_ville_edition($this->input->post('ville_edition'));
                    $date_infos = conc_date($this->input->post('jour'),$this->input->post('mois'),$this->input->post('annee'));
                    $ressource->set_date_debut_ressource($date_infos['date']);
                    $ressource->set_date_precision($date_infos['date_precision']);
                    $ressource->set_mots_cles($this->input->post('mots_cles'));
                    $ressource->set_duree($this->input->post('duree'));
                    $ressource->set_diffusion($this->input->post('diffusion'));
                    $ressource->set_versionvideo($imageData['versionvideo']);
                    $ressource->set_distribution($this->input->post('distribution'));
                    $ressource->set_production($this->input->post('production'));
                 
                    //as title is unique, we add the title to the name of the image
                    rename($dir . $videoData['file_name'], $dir .$ressource->get_titre().$videoData['file_name']);
                    $ressource->set_video($ressource->get_titre().$videoData['file_name']);
                    
                    $date_infos = conc_date($this->input->post('jourProd'),$this->input->post('moisProd'),$this->input->post('anneeProd'));
                    $ressource->set_date_production($date_infos['date']);
                  
                    //we set the manager and add $ressource in the database
                    $ressourceManager = new Ressource_video_model();
                    $ressourceManager->ajout_ressource($ressource);
                    redirect('data_center/data_center/','refresh');
                }
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
        
        public function check_titre($title,$typeRessource){ //callback function checking if titre already exist
            if ($typeRessource == 'texte'){
                $ressourceManager = new Ressource_texte_model();
            }
            if ($typeRessource == 'image'){
                $ressourceManager = new Ressource_graphique_model();
            }
            if ($typeRessource == 'video'){
                $ressourceManager = new Ressource_video_model();
            }
            $existingRessource = $ressourceManager->get_ressource('titre', $title);
            if (isset($existingRessource)){
                $this->form_validation->set_message('check_titre', 'Titre déjà existant');
                return FALSE;
            } else {
                return TRUE;
            }
        }
}

/* End of file ajout_ressource.php */
/* Location : ./application/controllers/data_center/ajout_ressource.php */
