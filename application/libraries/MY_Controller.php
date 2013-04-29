<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to and replaces the standard
 * CI Controller Class, which doesn't support sub-controllers (HMVC)
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		WanWizard
 * @link		http://www.exitecms.org
 */

// CI 2.x compatibility
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

class MY_Controller extends Controller
{
	// CI 1.x compatibility
	function MY_Controller()
	{
		// get the CI superobject
		$CI =& get_instance();

		// call the parent constructor
		if ( (int) CI_VERSION < 2 )
		{
			parent::CI_Base();
		}
		else
		{
			parent::__construct();
		}

		// do we have a superobject?
		if ( ! $CI )
		{
			// no, this must be the HMVC root-controller.

			// assign the base classes and run the autoloader based
			// on the version of CI we're running on
			if ( (int) CI_VERSION < 2 )
			{
				$this->_ci_initialize();
			}
			else
			{
				// Assign all the class objects that were instantiated by the
				// bootstrap file (CodeIgniter.php) to local class variables
				// so that CI can run as one big super object.
				foreach (is_loaded() as $var => $class)
				{
					$this->$var =& load_class($class);
				}

				// In PHP 5 the Loader class is run as a discreet
				// class.  In PHP 4 it extends the Controller @PHP4
				if (is_php('5.0.0') == TRUE)
				{
					$this->load =& load_class('Loader', 'core');

					$this->load->_base_classes =& is_loaded();

					$this->load->_ci_autoloader();
				}
				else
				{
					$this->_ci_autoloader();

					// sync up the objects since PHP4 was working from a copy
					foreach (array_keys(get_object_vars($this)) as $attribute)
					{
						if (is_object($this->$attribute))
						{
							$this->load->$attribute =& $this->$attribute;
						}
					}
				}
			}
		}
		else
		{
			// yes, so this is an HMVC sub-controller.

			// check how we reference the module itself
			$config = $CI->config->item('module');
			$self = isset($config['self']) ? $config['self'] : false;

			// copy all objects from the parent controller to the sub-controller
			foreach (array_keys(get_object_vars($CI)) as $attribute)
			{
				if ($attribute != $self && is_object($CI->$attribute))
				{
					$this->$attribute =& $CI->$attribute;
				}
			}

			// inform the loader we're now in HVMC mode
			if ( is_null($this->load->_ci_root) )
			{
				$this->load->_ci_root =& $CI;
			}
		}
	}
}
// END MY_Controller class

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
