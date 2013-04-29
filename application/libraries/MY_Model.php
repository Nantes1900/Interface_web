<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ExiteCMS
 *
 * An open source application development framework for PHP 5+
 * ExiteCMS is based on CodeIgniter, Copyright (c) Ellislab Inc.
 *
 * Default model parent class to transparently support both CI 1.7.2 and 2.0
 *
 * @package		ExiteCMS
 * @author		WanWizard
 * @copyright	Copyright (c) 2010, ExiteCMS.org
 * @link		http://www.exitecms.org
 * @filesource
 */

// ------------------------------------------------------------------------

if ( ! class_exists('CI_Model') )
{
	class CI_Model extends Model
	{
		function CI_Model()
		{
			parent::Model();
		}
	}
}

/**
 * CodeIgniter Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/config.html
 */
class MY_Model extends CI_Model {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	function MY_Model()
	{
		// call the parent constructor
		parent::CI_Model();
	}

}
// END MY_Model Class

/* End of file MY_Model.php */
/* Location: ./application/libraries/MY_Model.php */
