<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to and replaces the standard
 * CI Controller Class, this will allow language selection
 *
 * @author		Paul-Yves
 */
if ( class_exists('CI_Controller') )
{
	class Controller extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
		}
	}
}

class MY_Controller extends Controller {

    public $language = "french";

    function __construct() {

        // call the parent constructor
        parent::__construct();

        // a new language?
        if ($this->session->userdata('language') != null) {
            $this->language = $this->session->userdata('language');
        } else {
            $this->session->set_userdata('language',$this->language);
        }
        
        //loading language
        $this->lang->load('common', $this->language);
        $this->lang->load('form_validation', $this->language);
    }

}
// END MY_Controller class

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
