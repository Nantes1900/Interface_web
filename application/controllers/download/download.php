<?php

/**
 * This class manage the page where user can download things
 * for instance, csv templates
 *
 * @author paulyves
 */
class Download extends MY_Controller {

    public function __construct() {
        parent::__construct();
        //Ce code sera executé charque fois que ce contrôleur sera appelé
        $this->load->helper('download');
        $this->load->library('form_validation');
        $this->load->view('header');
        if (!$this->session->userdata('username')) { //checking that user is connected
            redirect('accueil/accueil/not_connected/', 'refresh');
        }
    }

    public function index() {
        $this->download_page();
    }

    private function download_page() {
        $this->load->view('download/download');
        $this->load->view('footer');
    }

    public function do_download() {
        $fileName = $this->input->post('fileName');
        $data = file_get_contents(base_url() . 'assets/utils/' . $fileName); //we prepare the file
        force_download($fileName, $data); //we download the file
        $this->download_page();
    }

}

/* End of file download.php */
/* Location : ./application/models/download.php */

