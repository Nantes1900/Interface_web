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
            $this->choix_ressource(); /** @todo Ajouter une sécurité par vérification du user_level*/
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
            $this->load->view('data_center/data_center');
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
                       
            $this->load->model('ressource_texte_model','ressource_texte');
            
            if ($this->form_validation->run('ajout_texte') == FALSE) /** @todo Rajouter dans la validation si une ressource du même nom existe déjà ou pas */
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
                    
                $this->ressource_texte->ajout_texte($textedata);            
                redirect('data_center/data_center/','refresh');
                
                /** @todo Ajouter une page de confirmation du succès d'ajout de l'objet */
            }
         
        /** @todo Coder les générations de formulaires pour l'ajout des autres types de ressources*/
            
        }
        
        
}

/* End of file ajout_ressource.php */
/* Location : ./application/controllers/data_center/ajout_ressource.php */
