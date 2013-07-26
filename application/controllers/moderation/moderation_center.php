<?php

/**
 * render the different elements of moderation bundle
 *
 * @author paulyves
 */

class Moderation_center extends MY_Controller {

    public function index() {
        if ($this->session->userdata('user_level') >= 5) {
            $this->moderation_center();
        }
    }

    public function __construct() {
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        $this->lang->load('moderation', $this->language);
        $this->load->library('form_validation');
        if (!$this->session->userdata('username')) { //checking that user is connected
            redirect('accueil/accueil/not_connected/', 'refresh');
        }
    }

    private function moderation_center() {
        $this->layout->view('moderation/moderation_center');
    }
}

/* End of file moderation_center.php */
/* Location : ./application/models/moderation_center.php */

