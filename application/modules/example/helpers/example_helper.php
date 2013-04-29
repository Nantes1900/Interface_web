<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('example'))
{
	function example()
	{
		$CI =& get_instance();
		$CI->output->append_output(
			"This is the example helper, loaded from the example module.<br/>"
		);
	}
}
