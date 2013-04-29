<?php

class Test extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		// load the Admin base controller to test indirect controller extension
		if ( (int) CI_VERSION < 2 )
		{
			require_once APPPATH.'libraries/Admin_controller'.EXT;
		}
		else
		{
			require_once APPPATH.'core/Admin_controller'.EXT;
		}

		/* Uncomment this if you want to test the database
		 * connection from within the example module model
		 */

//		$this->load->database();
	}

	function index()
	{
		// set the location of our modules
		$this->load->module_path( 'modules' );

		// Activate the "example" module
		$this->load->module( 'example' );

		// initialisation of a module library with a config array
		$config = array('var1' => 'value1', 'var2' => 'value2');
		$this->example->library->example_library( $config );

		// to load the library using the config file from the config folder,
		// comment the line above, and uncomment the line below
//		$this->example->library->example_library();

		// call a method in a library of our module
		$this->output->append_output( '<h3>Calling: $this->example->library->example_library->example(\'varA\', \'varB\');</h3>' );
		$this->example->library->example_library->example('varA', 'varB');

		// set a library propertu
		$this->output->append_output( '<h3>Calling: $this->example->library->example_library->property = "this is a library property";</h3>' );
		$this->example->library->example_library->property = 'this is a library property';

		$this->output->append_output( '<h3>Calling: echo $this->example->library->example_library->property;</h3>' );
		$this->output->append_output( $this->example->library->example_library->property );

		// load a model ORM style
		$this->output->append_output( '<h3>Loading the model ORM style: $model = $this->example->model->example_model( array("var1" => "value1") );</h3>' );
		$model = $this->example->model->example_model( array('var1' => 'value1') );

		// and call the method
		$this->output->append_output( '<h3>Calling the model ORM style: $model->example(\'var1\', \'var2\');</h3>' );
		$model->example('var1', 'var2');

		// call a method in a model of our module
		$this->output->append_output( '<h3>Calling the model CI style: $this->example->model->example_model->example(\'var1\', \'var2\');</h3>' );
		$this->example->model->example_model->example('var1', 'var2');

		// call a method in a controller of our module
		$this->output->append_output( '<h3>Calling: $this->example->controller->example_controller(\'varX\', \'varY\', \'varZ\');</h3>' );
		$this->example->controller->example_controller('varX', 'varY', 'varZ');

		// call a method in a controller of our module
		$this->output->append_output( '<h3>Calling: $this->example->controller->example_controller(\'varX\', \'varY\', \'varZ\'); again</h3>' );
		$this->example->controller->example_controller('varX', 'varY', 'varZ');
		$this->output->append_output( '<h4>Notice that this time, the parameters are ignored, as the controller is already instantiated!</h4>' );

		// call a method in a controller of our module
		$this->output->append_output( '<h3>Calling: $this->example->controller->example_controller->example(\'varA\', \'varB\', \'varC\');</h3>' );
		$result = $this->example->controller->example_controller->example('varA', 'varB', 'varC');

		if ( $result )
		{
			ob_start();
			var_dump($result);
			$dump = ob_get_clean();
			$this->output->append_output(
				"Return value of the controller method call:<br />".$dump
			);
		}

		// load a view from our module
		$this->output->append_output( '<h3>Calling: $this->example->view(\'example\'); from the test controller</h3>' );
		$view = $this->example->view('example', array(), TRUE);
		$this->output->append_output( $view );

		// load a helper from our module
		$this->output->append_output( '<h3>Calling: $this->example->helper(\'example\');</h3>' );
		$this->example->helper('example');
		// add see if it works
		$this->output->append_output( '<h3>Calling: Calling: example();</h3>' );
		example();

		// load a language file from our module
		$this->output->append_output( '<h3>Calling: $this->example->lang(\'example\');</h3>' );
		$this->example->lang('example');

		// add see if it works
		if ( $this->config->config['module']['use_language_array'] )
		{
			$this->output->append_output( '<h3>Calling: $this->lang->line(\'example_language\', \'example\')</h3>' );
			$this->output->append_output( $this->lang->line('example_language', 'example') );
		}
		else
		{
			$this->output->append_output( '<h3>Calling: $this->lang->line(\'example_language\')</h3>' );
			$this->output->append_output( $this->lang->line('example_language') );
		}

		// validate loading a config in a module
		$this->output->append_output( '<h3>Validating the config loaded in the module controller:</h3>' );
		ob_start();

		// if you use sections, configs are stored in the config array
		// using the 'modulename/configfilename' key, to make them unique
		var_dump($this->config->config['example/example_config']);
		$dump = ob_get_clean();
		$this->output->append_output(
			"Config loaded in the example controller:<br />".$dump
		);
	}
}

/* End of file test.php */
/* Location: ./application/controllers/test.php */
