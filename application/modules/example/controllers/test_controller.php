<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


class Test_controller extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();

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
			"Welcome from the module 'Example', controller 'test_controller', method index!<br />".$dump
		);
	}

	// to test a named method
	function example()
	{
		// check how we need to load our modules classes
		// this depends on the module configuration
		$thisclass = $this->__modulereference;

		ob_start();
		var_dump(func_get_args());
		$dump = ob_get_clean();
  		$this->output->append_output(
			"Welcome from the module 'Example', controller 'test_controller', method example!<br />".$dump
		);

		// load a view from our module
		$this->output->append_output( '<h3>Calling: $this->'.$thisclass.'->model->example_model->example(); from inside the example module test controller</h3>' );

		$this->$thisclass->model->example_model->example();

		$this->output->append_output( '<h3>Calling: $this->'.$thisclass.'->view(\'example\'); from inside the example module test controller</h3>' );

		$this->$thisclass->view('example');

		$this->output->append_output( '<h3>Calling: echo $this->'.$thisclass.'->library->example_library->example; from inside the example test controller</h3>' );
		$this->output->append_output( $this->$thisclass->library->example_library->example('x') . '<br/>' );

		$this->output->append_output( '<h3>Calling: echo $this->'.$thisclass.'->model->example_model->example; from inside the example test controller</h3>' );
		$this->output->append_output( $this->$thisclass->model->example_model->example('y') . '<br/>' );

		$this->load->model('admin_model');

		$this->admin_model->get_config();

		return 'Controller return value';
	}
}
