<?php

//https://maps.googleapis.com/maps/api/place/autocomplete/json?input=times%20square&sensor=false&key=AIzaSyCUkvHRkQSWR7S8Zbv5aLGSHEz_7alljE0
//https://maps.googleapis.com/maps/api/place/details/json?reference=CkQ4AAAAkYlJHm1emzMnsMp6pnB6LcSqjipmO2UzKAEUnQSu89QL6hYP-TQCLetcxj8JCZ-3SS3tzxAqgvaiG6Dri3tOVxIQSPBVSDt73fYzki4FkVHO5BoUi7nVhL5ZUv9_xUiu0aT5PQKumyw&sensor=false&key=AIzaSyCUkvHRkQSWR7S8Zbv5aLGSHEz_7alljE0

class GooglePlaces
{

    const URI = 'https://maps.googleapis.com/maps/api/place/';

    private $_apikey;

    public function __construct( $apikey )
    {
        $this->_apikey = $apikey;
    }

    public function autocomplete( $input )
    {
        $return = array();

        $params = array(
            'input'  => $input,
            // 'types'  => '(cities)',
            'sensor' => 'false',
            'key'    => $this->_apikey
        );

        $request = self::URI . 'autocomplete/json?' . http_build_query( $params );

        $json_response = file_get_contents( $request );

        $return = json_decode( $json_response );

        return $return;
    }

    public function details( $reference )
    {
        $return = array();

        $params = array(
            'reference' => $reference,
            'sensor'    => 'false',
            'key'       => $this->_apikey
        );

        $request = self::URI . 'details/json?' . http_build_query( $params );

        $json_response = file_get_contents( $request );

        $return = json_decode( $json_response );

        return $return;
    }

}