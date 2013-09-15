<?php

/**
 * Search controller
 * 
 * @package default
 * @author Dan Trenz <dtrenz@gmail.com>
 */
class Search extends CI_Controller
{

    /**  
     * Default search controller method
     */
    public function index()        
    {
        $response = false;
   
        $params = $this->input->get();

        // if ( ! empty($params['start-date']) && ! empty($params['location']) ) {
            $this->load->model('search_model');

            $response = $this->search_model->get_photos( $params );
        // }

        echo( json_encode($response) );
    }

}