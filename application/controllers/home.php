<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

/**
 * Homepage controller
 * @package default
 */
class Home extends CI_Controller
{

    /**
     * Default homepage controller method
     */
	public function index()
	{
        // load the view
		$this->load->view( 'home.php' );
	}

}