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
            $userLevel = $this->session->userdata('user_level');
            $data['userLevel'] = $userLevel;
            $this->load->view('data_center/data_center',$data);
            $this->formulaire(); /** @todo Ajouter une sécurité par vérification de la connection*/
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
         * @access public
         * 
         */
        public function formulaire()
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
                
                $this->objet_model->ajout_objet($objetdata);            
                redirect('data_center/data_center/','refresh');
                
                /** @todo Ajouter une page de confirmation du succès d'ajout de l'objet */
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
