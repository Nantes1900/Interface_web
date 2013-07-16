<?php

class Import_csv extends MY_Controller {

    public function index() {
        if ($this->session->userdata('username') && $this->session->userdata('user_level') >= 4) {
            $userLevel = $this->session->userdata('user_level');
            $data['userLevel'] = $userLevel;
            $this->load->view('data_center/data_center', $data);
            $this->formulaire();
        } else {
            $this->load->view('accueil/login/formulaire_login', array('titre' => 'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
        }
    }

    public function __construct() {
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé

        $this->load->library('upload');
        $this->load->helper(array('form', 'csv', 'file'));
        $this->load->view('header');
    }

    private function formulaire() {
        $this->load->view('data_center/import_csv', array('error' => ' '));
    }

    function do_upload() {
        $config['upload_path'] = './assets/csv/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '256';

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('csv_file')) {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('data_center/import_csv', $error);
            $this->load->view('footer');
        } else {

            $this->load->library('csvreader');

            $csv_file = $this->upload->data();
            //getting the data out of the file thanks to the library
            $data = $this->csvreader->parse_file($csv_file['full_path']);
            delete_files($csv_file['file_path']); //deleting the csv file, we won't need it anymore

            $csv_type = guess_csv_type($data['0']);

            if ($this->input->post('transaction') == 'FALSE') { //seeing if we want transaction or not
                $transaction = FALSE;
            } else {
                $transaction = TRUE;
            }
            $error = FALSE;

            //depending on csv_type, we load various model and call their import_csv method
            if ($csv_type == 'relation') {
                $this->load->model('relation_model');

                $failure = $this->relation_model->import_csv($data, $transaction);
                $message = array('csvType' => 'relation entre objets', 'transaction' => $transaction, 'failure' => $failure);
            } elseif ($csv_type == 'objet') {
                $this->load->model('objet_model');
                $failure = $this->objet_model->import_csv($data, $transaction);
                $message = array('csvType' => 'objet', 'transaction' => $transaction, 'failure' => $failure);
            } elseif ($csv_type == 'ressource_textuelle') {
                require_once('application/models/ressource_texte.php');
                $this->load->model('ressource_texte_model');
                $failure = $this->ressource_texte_model->import_csv($data, $transaction);
                $message = array('csvType' => 'ressource textuelle', 'transaction' => $transaction, 'failure' => $failure);
            } elseif ($csv_type == 'ressource_grapĥique') {
                require_once('application/models/ressource_graphique.php');
                $this->load->model('ressource_graphique_model');
                $failure = $this->ressource_graphique_model->import_csv($data, $transaction);
                $message = array('csvType' => 'ressource graphique', 'transaction' => $transaction, 'failure' => $failure);
            } elseif ($csv_type == 'ressource_video') {
                require_once('application/models/ressource_video.php');
                $this->load->model('ressource_video_model');
                $failure = $this->ressource_video_model->import_csv($data, $transaction);
                $message = array('csvType' => 'ressource video', 'transaction' => $transaction, 'failure' => $failure);
            } elseif ($csv_type == 'documentation') {
                $this->load->model('documentation_model');
                $failure = $this->documentation_model->import_csv($data, $transaction);
                $message = array('csvType' => 'documentation', 'transaction' => $transaction, 'failure' => $failure);
            } else { //no type has been found
                $error = TRUE;
            }
            if (!$error) { //printing success message
                $this->load->view('data_center/succes_csv', $message);
                $this->index();
            } else {
                $message = 'Le fichier n\'a pas pu être reconnu, vérifiez le format et les séparateurs de votre fichier csv';
                $this->load->view('data_center/import_csv', array('error' => $message));
                $this->load->view('footer');
            }
        }
    }

    public function rollback($data) {
        $this->load->view('footer');
    }

}

/* End of file import_csv.php */
/* Location : ./application/controllers/data_center/import_csv.php */