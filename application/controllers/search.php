<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

/**
 * Search controller
 * @package default
 */
class Search extends CI_Controller
{

    /**
     * Default search controller method
     */
    public function index()
    {
        $response = false;

        $query = $this->input->get();

        if ( ! empty($query['start-date']) && ! empty($query['location']) ) {
            $this->load->model('search_model');

            $response = $this->search_model->get_photos( $query );
        }

        echo( json_encode($response) );
    }

}