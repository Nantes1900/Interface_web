<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Application Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		WanWizard
 * @link		http://www.exitecms.org
 */

class Admin_Model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_config()
	{
		if ( isset($this->db) && is_object($this->db) )
		{
			$this->output->append_output(
				"database found: <br />"
			);

			$this->load->dbutil();

			$dbs = $this->dbutil->list_databases();

			foreach($dbs as $db)
			{
				$this->output->append_output(
					"> ".$db."<br />"
				);
			}
		}
		else
		{
			$this->output->append_output(
				"No database configured, skipping database connection test!<br />"
			);
		}
	}
}
// END Controller class

/* End of file Controller.php */
/* Location: ./application/core/MY_Controller.php */
