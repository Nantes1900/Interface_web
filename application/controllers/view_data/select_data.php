<?php

/**
 * select_data class
 * 
 * Accessible à tous
 * Menu permettant de sélectionner des objets, ressources... pour les visualiser
 * 
 * @author LUCAS Paul-Yves
 * 
 */
class Select_data extends MY_Controller {

    public function index($dataType = null, $goal = 'view') {
        if ($dataType == null) {
            $this->select_type();
        } elseif ($dataType == 'objet') {
            $this->select_objet($goal);
        } elseif (($dataType == 'ressource_texte') || ($dataType == 'ressource_graphique') || ($dataType == 'ressource_video')) {
            $this->select_ressource($dataType, $goal);
        } elseif ($dataType == 'carte') {
            $this->select_geo();
        }
    }

    public function __construct() {

        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        require_once ('application/models/objet.php');
        $this->load->model('objet_model');
        $this->load->library('form_validation');
        $this->load->helper(array('dates', 'ressource'));
        $this->load->view('header');
        if (!$this->session->userdata('username')) {
            redirect('accueil/accueil/not_connected/', 'refresh');
        }
    }

    private function select_type() {
        $this->load->view('view_data/select_type');
        $this->load->view('footer');
    }

    //setting the sort option of the objet list
    //
    //$goal can be :
    // - view, to display a detailed view with numerous information about the ressource
    // - add_doc, to link this objet to a particular ressource (as posted argument) and create a documentation link
    public function sort_sel_obj($goal) {
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
            
            $valid = null;
        }
        $this->session->set_userdata('sel_obj_valid', $valid);
        $this->select_objet($goal);
    }
    
    // method to display a list of objet depending on arguments and sort/filter option
    //
    //$goal can be :
    // - view, to display a detailed view with numerous information about the ressource
    // - add_doc, to link this objet to a particular ressource (as posted argument) and create a documentation link
    public function select_objet($goal, $page = 1, $typeRessource = null, $ressource_id = null) {
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
        if ($this->session->userdata('sel_obj_valid') != null && $goal != 'view') {
            $valid = $this->session->userdata('sel_obj_valid');
        } else {
            if ($goal != 'add_doc' && $goal != 'add_geo') {
                $valid = 't';
            } else {
                $valid = null;
            }
        }

        if ($goal == 'add_doc') { //we put some info about the related ressource if we are adding a documentation
            if ($ressource_id == null && $typeRessource == null) {
                $ressource_id = $this->input->post('ressource_id');
                $typeRessource = $this->input->post('typeRessource');
            }
            if (!check_ressource($typeRessource, $ressource_id)) {
                redirect('accueil/accueil');
            }
            require_once ('application/models/' . $typeRessource . '.php');
            $this->load->model($typeRessource . '_model');
            $typeRessourceMethod = ucfirst($typeRessource);
            $ressource = new $typeRessourceMethod($ressource_id);
            $valid = null;
        }

        //creating the list
        $data = array('listObjet' => $this->objet_model->get_objet_list($orderBy, $orderDirection, $speAttribute, $speAttributeValue, $valid, $page));
        $data['numPage'] = $this->objet_model->count_page_obj($speAttribute, $speAttributeValue, $valid);
        $data['currentPage'] = $page;
        $data['goal'] = $goal;
        if ($goal == 'add_doc') { //we put some info about the related ressource if we are adding a documentation
            $data['ressource'] = $ressource;
            $data['typeRessource'] = $typeRessource;
        }
        $this->load->view('view_data/select_objet', $data);
        $this->load->view('footer');
    }

    //setting the sort option of the ressource list
    //
    //$goal can be :
    // - view, to display a detailed view with numerous information about the ressource
    // - add_doc, to link this ressource to a particular objet (through another list) and create a documentation link
    public function sort_sel_ress($typeRessource, $goal) {
        //security
        if (!check_typeRessource($typeRessource)) {
            redirect('accueil/accueil');
        }
        //managing the sort option
        $orderBy = $this->input->post('orderBy');
        if ($orderBy == null) {
            $orderBy = 'nom_objet';
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
        if ($goal != 'add_doc') {
            $valid = 't';
        } else {
            $valid = null;
        }
        $this->session->set_userdata('sel_obj_valid', $valid);

        $this->select_ressource($typeRessource, $goal);
    }

    // method to display a list of ressources depending on arguments and sort/filter option
    //
    //$goal can be :
    // - view, to display a detailed view with numerous information about the ressource
    // - add_doc, to link this ressource to a particular objet (through another list) and create a documentation link
    public function select_ressource($typeRessource, $goal, $page = 1) {
        //security
        if (!check_typeRessource($typeRessource)) {
            redirect('accueil/accueil');
        }
        //loading the models and class
        require_once ('application/models/' . $typeRessource . '.php');
        $this->load->model($typeRessource . '_model');

        //managing the sort option

        if ($this->session->userdata('sel_ress_orderBy') != null) {
            $orderBy = $this->session->userdata('sel_ress_orderBy');
        } else {
            $orderBy = 'titre';
        }
        if ($this->session->userdata('sel_ress_orderDirection') != null) {
            $orderDirection = $this->session->userdata('sel_ress_orderDirection');
        } else {
            $orderDirection = 'asc';
        }
        if ($this->session->userdata('sel_ress_speAttribute') != null) {
            $speAttribute = $this->session->userdata('sel_ress_speAttribute');
        } else {
            $speAttribute = null;
        }
        if ($this->session->userdata('sel_ress_speAttributeValue') != null) {
            $speAttributeValue = $this->session->userdata('sel_ress_speAttributeValue');
        } else {
            $speAttributeValue = null;
        }
        if ($goal != 'add_doc') {
            $valid = 't';
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
        //add info pages
        $this->load->view('view_data/select_ressource', $data);
        $this->load->view('footer');
    }

    private function select_geo() {
        $this->lang->load('map', $this->language);
        $data = array();
        //we consider if there is a focus on a particular objet
        if ($this->input->post('latitude') != null && $this->input->post('longitude') != null) {
            $data['latitude'] = $this->input->post('latitude');
            $data['longitude'] = $this->input->post('longitude');
        }

        $this->load->view('view_data/select_geo', $data);
        $this->load->view('footer');
    }

}

/* End of file select_data.php */
/* Location : ./application/controllers/view_data/select_data.php */