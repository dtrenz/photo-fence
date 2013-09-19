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
     * Photo search controller method
     */
    public function photos()
    {
        $response = false;

        $params = $this->input->get();

        // if ( ! empty($params['start-date']) && ! empty($params['location']) ) {
            $this->load->model('photos_model');

            $response = $this->photos_model->search( $params );
        // }

        echo( json_encode($response) );
    }

    public function places( $query )
    {
        $response = false;

        $this->load->model('places_model');

        $query = urlencode( $query );

        $response = $this->places_model->autocomplete( $query );

        if ( ! empty($response) ) {
            $response = $this->places_model->details( $response[0]->reference );
        }

        echo( json_encode($response) );
    }

}