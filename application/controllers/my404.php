<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * This load the custom 404 page
 *
 * @author paulyves
 */

class my404 extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }

    public function index() {
        $this->output->set_status_header('404');
        $data['content'] = 'error_404'; // View name
        $this->load->view('error404',$data);//loading in my template
    }
}


/* End of file my404.php */
/* Location : ./application/models/my404.php */

