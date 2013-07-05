<?php

/**
 * Ajout_objet class
 * 
 * Génére un formulaire afin d'ajouter un objet à la base.
 * 
 * @author NATIVEL Pierre-Alexandre
 * 
 */

class Ajout_objet extends CI_Controller {

    /**
     * Redirige automatiquement vers la génération de formulaire
     * @access public
     */
    public function index() {
        $userLevel = $this->session->userdata('user_level');
        $data['userLevel'] = $userLevel;
        $this->load->view('data_center/data_center', $data);
        if ($userLevel >= 4) {
            $this->formulaire();
        }
    }

    /**
     * Charge automatiquement le modèle "objet_model", la bibliothèque "form_validation" et le helper "form" à chaque appel du contrôleur
     * @access public
     */
    public function __construct() {
        parent::__construct();

        $this->load->model('objet_model');
        require('application/models/objet.php');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'dates', 'geom_helper'));
        $this->load->view('header');
        if (!$this->session->userdata('username')) { //checking that user is connected
            redirect('accueil/accueil/not_connected/', 'refresh');
        }
    }

    /**
     * Génére le formulaire permettant d'ajouter un objet à la base, valide les données et les transmets au modèle objet_model
     * 
     * @access private
     * 
     */
    private function formulaire() {

        if ($this->form_validation->run('ajout_objet') == FALSE) {
            $this->load->view('data_center/ajout_objet');
            $this->load->view('footer');
        } else {
            $objetdata = array();
            $objetdata['nom_objet'] = $this->input->post('nom_objet');
            $objetdata['resume'] = $this->input->post('resume');
            $objetdata['historique'] = $this->input->post('historique');
            $objetdata['description'] = $this->input->post('description');
            $objetdata['adresse_postale'] = $this->input->post('adresse_postale');
            $objetdata['mots_cles'] = $this->input->post('mots_cles');
            $objetdata['username'] = $this->session->userdata('username');

            if ($this->objet_model->ajout_objet($objetdata)) {
                $data = array('success' => TRUE, 'message' => 'L\'ajout de l\'objet <b>' .
                    $objetdata['nom_objet'] . '</b> s\'est déroulé avec succès');
            } else {
                $data = array('success' => FALSE, 'message' => 'Une erreur a eu lieu, l\'objet <b>' .
                    $objetdata['nom_objet'] . '</b> n\'a pas été ajouté');
            }
            
            $this->load->view('data_center/success_form', $data);
        }
    }

    //powerful method to render a sorted list of objet, with various button 
    //to different controllers, depending on input attributes
    public function select_objet_geo($goal, $latitude = null, $longitude = null) {
        if ($this->session->userdata('user_level') >= 4) {
            //managing the sort option
            $orderBy = $this->input->post('orderBy');
            if ($orderBy == null) {
                $orderBy = 'nom_objet';
            }
            $orderDirection = $this->input->post('orderDirection');
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

            //creating the list
            $data = array('listObjet' => $this->objet_model->get_objet_list($orderBy, $orderDirection, $speAttribute, $speAttributeValue));
            $data['goal'] = $goal;
            $data['latitude'] = $latitude;
            $data['longitude'] = $longitude;
            $this->load->view('view_data/select_objet', $data);
            $this->load->view('footer');
        } else {
            redirect('accueil/accueil/', 'refresh');
        }
    }

    //render the form for adding a geometry to an existing object
    //if form is valid, call the objet_model to add the geometry
    public function geometry_form($latitude, $longitude) {
        if ($this->session->userdata('user_level') >= 4) {
            $objet_id = $this->input->post('objet_id');
            $objet = new Objet($objet_id);
            if ($this->form_validation->run('ajout_geom') == FALSE) {
                $this->load->view('data_center/ajout_geom', array('objet' => $objet, 'latitude' => $latitude, 'longitude' => $longitude));
                $this->load->view('footer');
            } else {
                $geomdata = array('objet_id' => $objet->get_objet_id(), 'username' => $this->session->userdata('username'));
                $geomdata['the_geom'] = 'ST_SetSRID(ST_MakePoint(' . $longitude . ', ' . $latitude . '), 4326)';
                $geomdata['mots_cles'] = $this->input->post('mots_cles');
                $dates_infos = conc_2_date($this->input->post('jour_debut'), $this->input->post('mois_debut'), $this->input->post('annee_debut'), $this->input->post('jour_fin'), $this->input->post('mois_fin'), $this->input->post('annee_fin'));

                $geomdata['date_debut_geom'] = $dates_infos['date_debut'];
                $geomdata['date_fin_geom'] = $dates_infos['date_fin'];
                $geomdata['date_precision'] = $dates_infos['date_precision'];
                $geomdata['datation_indication_debut'] = $this->input->post('datation_indication_debut');
                $geomdata['datation_indication_fin'] = $this->input->post('datation_indication_fin');

                if ($this->objet_model->ajout_geom($geomdata)) {
                    $data = array('success' => TRUE, 'message' => 'L\'objet <b>' .
                        $objet->get_nom_objet() . '</b> a été localisé avec succès');
                } else {
                    $data = array('success' => FALSE, 'message' => 'Une erreur a eu lieu, l\'objet <b>' .
                        $objet->get_nom_objet() . '</b> n\'a pas été localisé');
                }
                update_coordonnes(); //we update the coordonnees.json file for the map
                $this->load->view('data_center/success_form', $data);
            }
        } else {
            redirect('accueil/accueil/', 'refresh');
        }
    }

    public function formulaire_objet_geo($latitude, $longitude) {
        if ($this->session->userdata('user_level') >= 4) {
            if ($this->form_validation->run('ajout_objet_geom') == FALSE) {
                $this->load->view('data_center/ajout_objet_geom', array('latitude' => $latitude, 'longitude' => $longitude));
                $this->load->view('footer');
            } else {
                //getting objet infos
                $objetdata = array();
                $objetdata['nom_objet'] = $this->input->post('nom_objet');
                $objetdata['resume'] = $this->input->post('resume');
                $objetdata['historique'] = $this->input->post('historique');
                $objetdata['description'] = $this->input->post('description');
                $objetdata['adresse_postale'] = $this->input->post('adresse_postale');
                $objetdata['mots_cles'] = $this->input->post('mots_cles');
                $objetdata['username'] = $this->session->userdata('username');

                //inserting the objet and continuing on geometrical data
                if ($this->objet_model->ajout_objet($objetdata)) {
                    //getting geometrical data
                    $geomdata = array();
                    $geomdata['objet_id'] = $this->objet_model->last_insert_id();
                    $geomdata['username'] = $this->session->userdata('username');
                    $geomdata['the_geom'] = 'ST_SetSRID(ST_MakePoint(' . $longitude . ', ' . $latitude . '), 4326)';
                    $geomdata['mots_cles'] = $this->input->post('mots_cles');
                    $dates_infos = conc_2_date($this->input->post('jour_debut'), $this->input->post('mois_debut'), 
                                                $this->input->post('annee_debut'), $this->input->post('jour_fin'), 
                                                $this->input->post('mois_fin'), $this->input->post('annee_fin'));

                    $geomdata['date_debut_geom'] = $dates_infos['date_debut'];
                    $geomdata['date_fin_geom'] = $dates_infos['date_fin'];
                    $geomdata['date_precision'] = $dates_infos['date_precision'];
                    $geomdata['datation_indication_debut'] = $this->input->post('datation_indication_debut');
                    $geomdata['datation_indication_fin'] = $this->input->post('datation_indication_fin');


                    if ($this->objet_model->ajout_geom($geomdata)) {
                        $data = array('success' => TRUE, 'message' => 'L\'objet <b>' .
                            $objetdata['nom_objet'] . '</b> a été créé et localisé avec succès');
                    } else {
                        $data = array('success' => FALSE, 'message' => 'Une erreur a eu lieu, l\'objet <b>' .
                            $objetdata['nom_objet'] . '</b> a été créé mais pas localisé');
                    }
                } else {
                    $data = array('success' => FALSE, 'message' => 'Une erreur a eu lieu, l\'objet <b>' .
                        $objetdata['nom_objet'] . '</b> n\'a pas été ajouté');
                }
                update_coordonnes(); //we update the coordonnees.json file for the map
                $this->load->view('data_center/success_form', $data);
            }
        } else {
            redirect('accueil/accueil/', 'refresh');
        }
    }

    public function check_nom($name) {
        $objet = $this->objet_model->get_objet('nom_objet', $name);
        if ($objet != null) {
            $this->form_validation->set_message('check_nom', 'Cet objet existe déjà');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function check_date($field, $extension = null) { //callback function checking date validity
        $day = (int) $this->input->post('jour_' . $extension);
        $month = (int) $this->input->post('mois_' . $extension);
        $year = (int) $this->input->post('annee_' . $extension);
        $valid = checkdate($month, $day, $year);
        if (!$valid) {
            $this->form_validation->set_message('check_date', 'Date invalide');
        }
        return $valid;
    }

}

/* End of file ajout_objet.php */
/* Location : ./application/controllers/data_center/ajout_objet.php */
