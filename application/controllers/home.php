<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

/**
 * Homepage controller
 * 
 * @package default
 * @author Dan Trenz <dtrenz@gmail.com>
 */
class Home extends CI_Controller
{

    /**
     * Default homepage controller method
     */
	public function index()
	{
		// phpinfo();exit;
        // load the view
		$this->load->view( 'home.php' );
	}

}