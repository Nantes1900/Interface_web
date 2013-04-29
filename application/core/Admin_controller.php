<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		WanWizard
 * @link		http://www.exitecms.org
 */

class Admin_Controller extends MY_Controller
{
	function __construct()
	{
 		parent::__construct();

		$this->output->append_output( '<h2>Admin Base Controller constructor - start</h2>' );

		$this->load->model('admin_model');

		$result = $this->admin_model->get_config();

		$this->output->append_output( '<h2>Admin Base Controller constructor - end</h2>' );

	}

}
// END Controller class

/* End of file Controller.php */
/* Location: ./application/core/MY_Controller.php */
