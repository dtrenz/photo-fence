<?php

/**
 * Places model
 *
 * @package default
 * @author Dan Trenz <dtrenz@gmail.com>
 */
class Places_model extends CI_Model
{
    public static $places_client;

    public function __construct()
    {
        parent::__construct();

        // bypassing CI loader because it is to restrictive for proper OOP, grr...
        require_once( APPPATH . '/libraries/GooglePlaces.php');

        self::$places_client = new GooglePlaces( 'AIzaSyCUkvHRkQSWR7S8Zbv5aLGSHEz_7alljE0' );
    }

    public function autocomplete( $input )
    {
        $return = false;

        $response = self::$places_client->autocomplete( $input );

        if ( isset($response->predictions) ) {
            $return = $response->predictions;
        }

        return $return;
    }

    public function details( $reference )
    {
        $place = false;

        $response = self::$places_client->details( $reference );

        if ( isset($response->result) &&
             isset($response->result->name) &&
             isset($response->result->geometry->location) ) {

            $place = new stdClass();
            $place->name     = $response->result->name;
            $place->location = $response->result->geometry->location;

        }

        return $place;
    }

}