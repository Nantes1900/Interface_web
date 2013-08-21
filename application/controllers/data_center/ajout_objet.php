<?php

/**
 * Ajout_objet class
 * 
 * Génére un formulaire afin d'ajouter un objet à la base.
 * 
 * @author NATIVEL Pierre-Alexandre
 * 
 */

class Ajout_objet extends MY_Controller {

    /**
     * Redirige automatiquement vers la génération de formulaire
     * @access public
     */
    public function index() {
        $userLevel = $this->session->userdata('user_level');
        $data['userLevel'] = $userLevel;
        $this->layout->views('data_center/data_center', $data);
        if ($userLevel >= 4) {
            $this->formulaire();
        } else {
            redirect('accueil/accueil/', 'refresh');
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
            $this->layout->view('data_center/ajout_objet');
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
                $data = array('success' => TRUE, 'message' => sprintf($this->lang->line('common_add_obj_form_success'),
                                                                        $objetdata['nom_objet']));
            } else {
                $data = array('success' => FALSE, 'message' => sprintf($this->lang->line('common_add_obj_form_failure'),
                                                                        $objetdata['nom_objet']));
            }
            $this->layout->add_js('close_message');
            $this->layout->view('data_center/success_form', $data);
        }
    }
    
    //setting the sort option of the objet list
    //
    // $goal is always add_geo and this correspond to adding a geometry in arg
    // to an existing objet so that it would be visible on this particular location of the map
    public function sort_sel_obj($goal, $latitude = null, $longitude = null){
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
        $valid = 't';
        if ($goal == 'add_doc') { //we put some info about the related ressource if we are adding a documentation
            $ressource_id = $this->input->post('ressource_id');
            $typeRessource = $this->input->post('typeRessource');
            require_once ('application/models/' . $typeRessource . '.php');
            $this->load->model($typeRessource . '_model');
            $typeRessourceMethod = ucfirst($typeRessource);
            $ressource = new $typeRessourceMethod($ressource_id);
            $valid = null;
        }
        $this->session->set_userdata('sel_obj_valid', $valid);
        $this->select_objet_geo($goal, $latitude, $longitude);
    }
    
    
    //powerful method to render a sorted list of objet for geometrical selection, 
    //with various button to different controllers, depending on input attributes
    //
    // $goal is always add_geo and this correspond to adding a geometry in arg
    // to an existing objet so that it would be visible on this particular location of the map
    public function select_objet_geo($goal, $latitude = null, $longitude = null, $page = 1) {
        if ($this->session->userdata('user_level') >= 4) {
            //getting the sort option
            if ($this->session->userdata('sel_obj_orderBy') != null) {
                $orderBy = $this->session->userdata('sel_obj_orderBy');
            } else {
                $orderBy = 'nom_objet';
            }
            if ($this->session->userdata('sel_obj_orderDirection') != null) {
                $orderDirection = $this->session->userdata('sel_obj_orderDirection');
            } else {
                $orderDirection = 'asc';
            }
            if ($this->session->userdata('sel_obj_speAttribute') != null) {
                $speAttribute = $this->session->userdata('sel_obj_speAttribute');
            } else {
                $speAttribute = null;
            }
            if ($this->session->userdata('sel_obj_speAttributeValue') != null) {
                $speAttributeValue = $this->session->userdata('sel_obj_speAttributeValue');
            } else {
                $speAttributeValue = null;
            }
            $valid = null; //we select objet to add a geometry, so valid and non-valid objet should be selectable

            //creating the list
            $data = array('listObjet' => $this->objet_model->get_objet_list($orderBy, $orderDirection, $speAttribute, $speAttributeValue, $valid, $page));
            $data['numPage'] = $this->objet_model->count_page_obj($speAttribute, $speAttributeValue, $valid);
            $data['currentPage'] = $page;
            $data['goal'] = $goal;
            $data['latitude'] = $latitude;
            $data['longitude'] = $longitude;
            $this->layout->view('view_data/select_objet', $data);
        } else {
            redirect('accueil/accueil/', 'refresh');
        }
    }

    //render the form for adding a geometry to an existing object
    //if form is valid, call the objet_model to add the geometry
    public function geometry_form($latitude, $longitude) {
        $objet_id = $this->input->post('objet_id');
        if ($this->session->userdata('user_level') >= 4 && $objet_id!='') {
            $objet = new Objet($objet_id);
            if ($this->form_validation->run('ajout_geom') == FALSE) {
                $this->layout->view('data_center/ajout_geom', array('objet' => $objet, 'latitude' => $latitude, 'longitude' => $longitude));
            } else {
                $geomdata = array('objet_id' => $objet->get_objet_id(), 'username' => $this->session->userdata('username'));
                //checking if we have a point or a polygon
                if(!preg_match("#%20#", $latitude)){
                    //point case
                    $geomdata['the_geom'] = 'ST_SetSRID(ST_MakePoint(' . $longitude . ', ' . $latitude . '), 4326)';
                }else{
                    //polygon case
                    $latitudes = explode('%20', $latitude);
                    $longitudes = explode('%20', $longitude);
                    $length = count($latitudes);
                    if ($length!=count($longitudes)){
                        redirect('accueil');
                    }
                    $polygon = 'POLYGON((';
                    for($i=0; $i<$length; $i++){
                        if($i!=0){
                            $polygon.=', ';
                        }
                        $polygon.=$longitudes[$i].' '.$latitudes[$i];
                    }
                    $polygon.=', '.$longitudes[0].' '.$latitudes[0];
                    $polygon.='))';
                    $geomdata['the_geom'] = 'ST_SetSRID(ST_GeomFromText(\'' . $polygon . '\'),4326)';
                }
                $geomdata['mots_cles'] = $this->input->post('mots_cles');
                $dates_infos = conc_2_date($this->input->post('jour_debut'), $this->input->post('mois_debut'), $this->input->post('annee_debut'), $this->input->post('jour_fin'), $this->input->post('mois_fin'), $this->input->post('annee_fin'));

                $geomdata['date_debut_geom'] = $dates_infos['date_debut'];
                $geomdata['date_fin_geom'] = $dates_infos['date_fin'];
                $geomdata['date_precision'] = $dates_infos['date_precision'];
                $geomdata['datation_indication_debut'] = $this->input->post('datation_indication_debut');
                $geomdata['datation_indication_fin'] = $this->input->post('datation_indication_fin');

                if ($this->objet_model->ajout_geom($geomdata)) {
                    $data = array('success' => TRUE, 'message' => sprintf($this->lang->line('common_add_geo_form_success'),
                                                                            $objet->get_nom_objet()));
                } else {
                    $data = array('success' => FALSE, 'message' => sprintf($this->lang->line('common_add_geo_form_failure'),
                                                                            $objet->get_nom_objet()));
                }
                update_coordonnes(); //we update the coordonnees.json file for the map
                $this->layout->add_js('close_message');
                $this->layout->view('data_center/success_form', $data);
            }
        } else {
            redirect('accueil/accueil/', 'refresh');
        }
    }

    //this method render or collect information about a form corresponding to 
    //a new objet directly linked to a particular location through geometrical information
    public function formulaire_objet_geo($latitude, $longitude) {
        if ($this->session->userdata('user_level') >= 4) {
            if ($this->form_validation->run('ajout_objet_geom') == FALSE) {
                $this->layout->view('data_center/ajout_objet_geom', array('latitude' => $latitude, 'longitude' => $longitude));
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
                        $data = array('success' => TRUE, 
                                      'message' => sprintf($this->lang->line('common_add_obj_geo_form_success'),
                                                           $objetdata['nom_objet']));
                    } else {
                        $data = array('success' => FALSE, 
                                      'message' => sprintf($this->lang->line('common_add_obj_geo_form_failure'),
                                                           $objetdata['nom_objet']));
                    }
                } else {
                    $data = array('success' => FALSE, 
                                  'message' => sprintf($this->lang->line('common_add_obj_form_failure'),
                                                           $objetdata['nom_objet']));
                }
                update_coordonnes(); //we update the coordonnees.json file for the map
                $this->layout->add_js('close_message');
                $this->layout->view('data_center/success_form', $data);
            }
        } else {
            redirect('accueil/accueil/', 'refresh');
        }
    }

    public function check_nom($name) {
        $objet = $this->objet_model->get_objet('nom_objet', $name);
        if ($objet != null) {
            $this->form_validation->set_message('check_nom', sprintf($this->lang->line('common_add_obj_check_nom'),
                                                                     $name));
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
            $this->form_validation->set_message('check_date', $this->lang->line('common_add_obj_check_date'));
        }
        return $valid;
    }

}

/* End of file ajout_objet.php */
/* Location : ./application/controllers/data_center/ajout_objet.php */
