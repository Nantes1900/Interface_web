<?php

/**
 * Ajout_relation class
 * 
 * Génére un formulaire afin d'ajouter une relation à la base.
 * 
 * @author NATIVEL Pierre-Alexandre
 * 
 */

class Ajout_relation extends CI_Controller
{
    
        /**
         * Redirige automatiquement vers la génération de formulaire
         * @access public
         */
	public function index()
	{
            if($this->session->userdata('username')){
                $userLevel = $this->session->userdata('user_level');
                $this->load->view('data_center/data_center');
                if ($userLevel>=4){
                    $this->formulaire();
                }
            } else {
                $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
            }
	}

        /**
         * Charge automatiquement les modèles "relation_model" et "objet_model", la bibliothèque "form_validation" et le helper "form" à chaque appel du contrôleur
         * @access public
         */
	public function __construct()
	{
            parent::__construct();
            
            $this->load->model('relation_model');
            $this->load->model('objet_model');
            require ('application/models/objet.php');
            $this->load->library('form_validation');
            $this->load->helper(array('form','dates'));
            $this->load->view('header');
	}
        
        /**
         * Génére le formulaire permettant d'ajouter une relation à la base, valide les données et les transmets au modèle relation_model
         * 
         * @access private
         * 
         */
        public function formulaire(){
            $userLevel = $this->session->userdata('user_level');
            if ($userLevel>=4){
                //On va récupérer une liste des objets existants dans la base, afin de les proposer
                $objet_list = $this->objet_model->get_objet_list();
            
                //On va récupérer une liste des types de relation existants dans la base, afin de les proposer
                $type_relation_list = $this->relation_model->get_type_relation_list();
            
                if ($this->form_validation->run('ajout_relation') == FALSE){
                    $data = array('objet_list' => $objet_list,'type_relation_list' => $type_relation_list);
                
                    $this->load->view('data_center/ajout_relation', $data);
                    $this->load->view('footer');
                }else{
                    $relationdata = array();
                    $relationdata['objet_id_1'] = $this->input->post('objet1');
                    $relationdata['objet_id_2'] = $this->input->post('objet2');
                    $relationdata['type_relation_id'] = $this->input->post('type_relation');
                    $relationdata['username'] = $this->session->userdata('username');
                    $relationdata['datation_indication_debut'] = $this->input->post('datation_indication_debut');
                    $relationdata['datation_indication_fin'] = $this->input->post('datation_indication_fin');
                
                    $dates_infos = conc_2_date($this->input->post('jour_debut'),$this->input->post('mois_debut'),$this->input->post('annee_debut'),$this->input->post('jour_fin'),$this->input->post('mois_fin'),$this->input->post('annee_fin'));
                                
                    $relationdata['date_debut_relation'] = $dates_infos['date_debut'];
                    $relationdata['date_fin_relation'] = $dates_infos['date_fin'];
                    $relationdata['date_precision'] = $dates_infos['date_precision'];
                                
                    $relationdata['parent'] = $this->input->post('parent')? 'true':'false';
                             
                    if($this->relation_model->ajout_relation($relationdata)){
                        $data = array('success'=>TRUE , 'message' => 'L\'ajout de relation entre objets s\'est déroulé avec succès');
                    }else{
                        $data = array('success'=>FALSE , 'message' => 'Une erreur a eu lieu, les objets n\'ont pas été reliés');
                    }
                    
                    $this->load->view('data_center/success_form', $data);
                    $this->load->view('data_center/data_center');
                }
            }else{
                redirect('accueil/accueil','refresh');
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

/* End of file ajout_relation.php */
/* Location : ./application/controllers/data_center/ajout_relation.php */
