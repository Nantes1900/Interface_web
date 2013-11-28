<?php

class Import_csv extends MY_Controller {

    public function index() {
        if ($this->session->userdata('username') && $this->session->userdata('user_level') >= 4) {
            $userLevel = $this->session->userdata('user_level');
            $data['userLevel'] = $userLevel;
            $this->layout->views('data_center/data_center', $data);
            $this->formulaire();
        } else {
            $this->layout->view('accueil/login/formulaire_login', 
                                array('titre'=>$this->lang->line('common_do_need_login')));
        }
    }

    public function __construct() {
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        $this->lang->load('csv', $this->language);
        $this->load->library('upload');
        $this->load->helper(array('form', 'csv', 'file', 'dates'));
    }

    private function formulaire() {
        $this->layout->view('data_center/import_csv', array('error' => ' '));
    }

    function do_upload() {
        $config['upload_path'] = FCPATH.'assets/csv/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '256';

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('csv_file')) {
            $error = array('error' => $this->upload->display_errors());
            $this->layout->view('data_center/import_csv', $error);
        } else {
            $this->load->library('csvreader');
            $csv_file = $this->upload->data();
            //getting the data out of the file thanks to the library
            $data = $this->csvreader->parse_file($csv_file['full_path']);
            delete_files($csv_file['file_path']); //deleting the csv file, we won't need it anymore
            $csv_type = guess_csv_type($data['1']);
            if ($this->input->post('transaction') == 'FALSE') { //seeing if we want transaction or not
                $transaction = FALSE;
            } else {
                $transaction = TRUE;
            }
            $critError = FALSE;

            //depending on csv_type, we load various model and call their import_csv method
            if ($csv_type == 'relation') {
                $csv_type = strtolower($this->lang->line('common_obj_link')); //preparing success/failure message
                $this->load->model('relation_model');
                $failure = $this->relation_model->import_csv($data, $transaction);
                $message = array('csvType' => $csv_type, 'transaction' => $transaction, 'failure' => $failure);
                
            } elseif ($csv_type == 'objet') {
                
                $csv_type = strtolower($this->lang->line('common_objets')); //preparing success/failure message
                $this->load->model('objet_model');
                $failure = $this->objet_model->import_csv($data, $transaction);
                $message = array('csvType' => $csv_type, 'transaction' => $transaction, 'failure' => $failure);
                
            } elseif ($csv_type == 'ressource_textuelle') {
                
                $csv_type = strtolower($this->lang->line('common_ressources_txt')); //preparing success/failure message
                require_once('application/models/ressource_texte.php');
                $this->load->model('ressource_texte_model');
                $failure = $this->ressource_texte_model->import_csv($data, $transaction);
                $message = array('csvType' => $csv_type, 'transaction' => $transaction, 'failure' => $failure);
                
            } elseif ($csv_type == 'ressource_grapĥique') {
                
                $csv_type = strtolower($this->lang->line('common_ressources_img'));
                require_once('application/models/ressource_graphique.php');
                $this->load->model('ressource_graphique_model');
                $failure = $this->ressource_graphique_model->import_csv($data, $transaction);
                $message = array('csvType' => $csv_type, 'transaction' => $transaction, 'failure' => $failure);
                
            } elseif ($csv_type == 'ressource_video') {
                
                $csv_type = strtolower($this->lang->line('common_ressources_vid'));
                require_once('application/models/ressource_video.php');
                $this->load->model('ressource_video_model');
                $failure = $this->ressource_video_model->import_csv($data, $transaction);
                $message = array('csvType' => $csv_type, 'transaction' => $transaction, 'failure' => $failure);
                
            } elseif ($csv_type == 'documentation') {
                
                $csv_type = strtolower($this->lang->line('common_documentation'));
                $this->load->model('documentation_model');
                $failure = $this->documentation_model->import_csv($data, $transaction);
                $message = array('csvType' => $csv_type, 'transaction' => $transaction, 'failure' => $failure);
                
            } else { //no type has been found
                $critError = TRUE;
            }
            if (!$critError) { //printing success message
                $this->layout->views('data_center/succes_csv', $message);
                $this->index();
            } else {
                $message = $this->lang->line('csv_rel_crit_error');
                $this->layout->view('data_center/import_csv', array('error' => $message));
            }
        }
    }

    public function rollback($data) {
        $this->layout->view('footer');
    }

}

/* End of file import_csv.php */
/* Location : ./application/controllers/data_center/import_csv.php */