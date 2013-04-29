<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Example_model extends MY_Model
{
	function __construct()
	{
		ob_start();
		var_dump(func_get_args());
		$dump = ob_get_contents();
		ob_end_clean();

		parent::__construct();

		$this->output->append_output(
			"Example_model constructed.<br />".$dump."<br />"
		);
	}

	function example()
	{
		ob_start();
		var_dump(func_get_args());
		$dump = ob_get_contents();
		ob_end_clean();

  		$this->output->append_output(
			"Welcome from the module 'Example', model 'example_model', method 'example'.<br />".$dump
		);

		// test the database

  		$this->output->append_output(
			"<h4>Testing the database connection from the model:</h4>"
		);

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
					"* ".$db."<br />"
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
