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
        $results = array();

        $response = self::$places_client->autocomplete( $input );

        if ( isset($response->predictions) ) {
            foreach( $response->predictions as $place ) {
                $result = new stdClass();
                $result->name      = $place->description;
                $result->value     = $place->description;
                $result->reference = $place->reference;

                $results[] = $result;
            }
        }

        return $results;
    }

    public function coords( $reference )
    {
        $coords = false;

        $response = self::$places_client->details( $reference );

        if ( isset($response->result) &&
             isset($response->result->geometry) &&
             isset($response->result->geometry->location) ) {

            $coords = $response->result->geometry->location;

        }

        return $coords;
    }

}