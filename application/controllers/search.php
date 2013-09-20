<?php

/**
 * Search controller
 *
 * @package default
 * @author Dan Trenz <dtrenz@gmail.com>
 */
class Search extends CI_Controller
{

    public function places( $query )
    {
        $this->load->model('places_model');

        $query = urlencode( $query );

        $results = $this->places_model->autocomplete( $query );

        echo( json_encode($results) );
    }

    /**
     * Photo search controller method
     */
    public function photos()
    {
        $response = false;

        $params = $this->input->get();

        if ( ! empty($params['date']) && ! empty($params['location']) ) {
            $this->load->model('places_model');
            $this->load->model('photos_model');

            $coords = $this->places_model->coords( $params['location'] );

            $timestamp = strtotime( $params['date'] );

            $response = $this->photos_model->search( $coords, $timestamp );
        }

        echo( json_encode($response) );
    }

}