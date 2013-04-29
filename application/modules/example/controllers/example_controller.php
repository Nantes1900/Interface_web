<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


class Example_controller extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');

		ob_start();
		var_dump(func_get_args());
		$dump = ob_get_clean();

  		$this->output->append_output(
			"Controller constructor parameters:<br />".$dump
		);

		$this->output->append_output(
			"Example controller constructed.<br /><br />"
		);
	}

	// to test the default index method
	function index()
	{
		ob_start();
		var_dump(func_get_args());
		$dump = ob_get_clean();

  		$this->output->append_output(
			"Welcome from the module 'Example', controller 'example_controller', method index!<br />".$dump
		);
	}

	// to test a named method
	function example()
	{
  		$this->output->append_output(
			"Welcome from the module 'Example', controller 'example_controller', method example!<br />"
		);

		// check how we need to load our modules classes
		// this depends on the module configuration
		$thisclass = $this->__modulereference;

		$this->output->append_output( '<h3>Calling: Test controller</h3>' );

		$this->$thisclass->controller->test_controller->example();

		ob_start();
		var_dump(func_get_args());
		$dump = ob_get_clean();
  		$this->output->append_output(
			"Welcome from the module 'Example', controller 'example_controller', method example!<br />".$dump
		);

		// Load a module config file
		$this->output->append_output( '<h3>Calling: $this->example->config(\'example\');</h3>' );
		$loaded = $this->$thisclass->config('example_config', TRUE);
		if ( $loaded )
		{
			ob_start();
			// if you use sections, configs are stored in the config array
			// using the 'modulename/configfilename' key, to make them unique
			var_dump($this->config->config['example/example_config']);
			$dump = ob_get_clean();
			$this->output->append_output(
				"Config loaded:<br />".$dump
			);
		}

		// load a view from our module
		$this->output->append_output( '<h3>Calling: $this->'.$thisclass.'->model->example_model->example(); from inside the example module controller</h3>' );

		$this->$thisclass->model->example_model->example();

		$this->output->append_output( '<h3>Calling: $this->'.$thisclass.'->view(\'example\'); from inside the example module controller</h3>' );

		$this->$thisclass->view('example');

		// dynamic module language support
		$this->output->append_output( '<h3>Dynamic Language support, calling: $this->'.$thisclass.'->lang("dynamic")->line("example"); from inside the example module controller</h3>' );

		ob_start();
		var_dump($this->$thisclass->lang('dynamic')->line('example'));
		$dump = ob_get_clean();
  		$this->output->append_output(
			"Language string returned:<br />".$dump
		);

		$this->output->append_output( '<h3>Calling: echo $this->'.$thisclass.'->library->example_library->example; from inside the example controller</h3>' );
		$this->output->append_output( $this->$thisclass->library->example_library->example('x') . '<br/>' );

		$this->output->append_output( '<h3>Calling: echo $this->'.$thisclass.'->model->example_model->example; from inside the example controller</h3>' );
		$this->output->append_output( $this->$thisclass->model->example_model->example('y') . '<br/>' );

		return 'Controller return value';
	}
}
