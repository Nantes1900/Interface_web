<?php

/**
 * Ajout_objet class
 * 
 * Génére un formulaire afin d'ajouter un objet à la base.
 * 
 * @author NATIVEL Pierre-Alexandre
 * 
 */

class Ajout_objet extends CI_Controller
{
        /**
         * Redirige automatiquement vers la génération de formulaire
         * @access public
         */
	public function index()
	{
            if($this->session->userdata('username')){
                $userLevel = $this->session->userdata('user_level');
                $data['userLevel'] = $userLevel;
                $this->load->view('data_center/data_center',$data);
                if ($userLevel>=4){
                    $this->formulaire();
                }
            } else {
                $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
            }
	}

        /**
         * Charge automatiquement le modèle "objet_model", la bibliothèque "form_validation" et le helper "form" à chaque appel du contrôleur
         * @access public
         */
	public function __construct()
	{
            parent::__construct();
            
            $this->load->model('objet_model');
            require('application/models/objet.php');
            $this->load->library('form_validation');
            $this->load->helper(array('form'));
            $this->load->view('header');   
	}
        
        /**
         * Génére le formulaire permettant d'ajouter un objet à la base, valide les données et les transmets au modèle objet_model
         * 
         * @access private
         * 
         */
        private function formulaire()
        {
            
            if ($this->form_validation->run('ajout_objet') == FALSE) 
            {
                $this->load->view('data_center/ajout_objet');
                $this->load->view('footer');
            }
            else
            {
                $objetdata = array();
                $objetdata['nom_objet'] = $this->input->post('nom_objet');
                $objetdata['resume'] = $this->input->post('resume');
                $objetdata['historique'] = $this->input->post('historique');
                $objetdata['description'] = $this->input->post('description');
                $objetdata['adresse_postale'] = $this->input->post('adresse_postale');
                $objetdata['mots_cles'] = $this->input->post('mots_cles');
                $objetdata['username'] = $this->session->userdata('username');
                
                if($this->objet_model->ajout_objet($objetdata)){
                    $data = array('success'=>TRUE , 'message' => 'L\'ajout de l\'objet '.
                                $objetdata['nom_objet'].' s\'est déroulé avec succès');
                } else {
                    $data = array('success'=>FALSE , 'message' => 'Une erreur a eu lieu, l\'objet '.
                                $objetdata['nom_objet'].' n\'a pas été ajouté');
                } 
                $this->load->view('data_center/success_form', $data);
            }
        }
        
        
        
        public function check_nom($name){
            $objet = $this->objet_model->get_objet('nom_objet', $name);
            if ($objet!=null){
                $this->form_validation->set_message('check_nom', 'Cet objet existe déjà');
                return FALSE;
            } else {
                return TRUE;
            }
        }
        
        
}

/* End of file ajout_objet.php */
/* Location : ./application/controllers/data_center/ajout_objet.php */
