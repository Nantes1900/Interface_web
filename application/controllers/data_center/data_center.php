<?php

/**
 * data_center class
 * 
 * Accessible uniquement aux utilisateurs autorisés.
 * Menu d'accueil proposant à l'utilisateur d'ajouter objets, relations, 
 * ressources à la base, ainsi que d'y importer les données contenues dans un fichier CSV
 * 
 * @author NATIVEL Pierre-Alexandre
 * 
 */

class Data_center extends MY_Controller {

    public function index() {
        $this->data_center();
    }

    public function __construct() {
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé

        $this->load->library('form_validation');
        $this->load->view('header');
        if (!$this->session->userdata('username')) { //checking that user is connected
            redirect('accueil/accueil/not_connected/', 'refresh');
        }
    }

    public function data_center() {
        $this->load->view('data_center/data_center');
    }

}

/* End of file data_center.php */
/* Location: ./application/controllers/data_center/data_center.php */
