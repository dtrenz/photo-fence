<?php

/**
 * Photos model
 *
 * @package default
 * @author Dan Trenz <dtrenz@gmail.com>
 */
class Photos_model extends CI_Model
{

    /**
     * Find photos that satisfy the search criteria.
     *
     * @param array $params
     * @return array
     */
    public function search( $coords, $timestamp )
    {
        $photos = array();

        // $latitude  = 40.759011;
        // $longitude = -73.984472;
        // $min_timestamp = 1356991200;
        // $max_timestamp = 1357023600;

        $max_timestamp = strtotime( '+1 day', $timestamp );

        // search flickr for photos
        $flickr_photos = $this->_search_flickr( $coords->lat, $coords->lng, $timestamp, $max_timestamp );

        // merge all photos into one photo array
        $photos = array_merge( $flickr_photos );

        return $photos;
    }

    /**
     * Find photos on Flickr that satisfy the search criteria.
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $min_timestamp
     * @param int $max_timestamp
     * @return array
     */
    private function _search_flickr( $latitude, $longitude, $min_timestamp, $max_timestamp )
    {
        $photos = array();

        // bypassing CI loader because it is to restrictive for proper OOP, grr...
        require( APPPATH . '/libraries/Flickr.php');

        // instantiate the client
        $flickr = new Flickr();

        // request params
        $params = array(
            'lat' => $latitude,
            'lon' => $longitude,
            'min_taken_date' => $min_timestamp,
            'max_taken_date' => $max_timestamp,
            'per_page' => 20,
            'sort'     => 'relevance',
            'format'   => 'php_serial'
        );

        // make the request
        $response = $flickr->request( 'flickr.photos.search', $params );

        // if we found photos...
        if ( ! empty($response) &&
             ! empty($response['photos']) &&
             ! empty($response['photos']['photo']) ) {

            // ...loop through them and append to the photos array
            foreach ( $response['photos']['photo'] as $photo ) {
                // generate & append image url to photo array
                $photos[] = Flickr::create_image_url($photo);
            }
        }

        return $photos;
    }

}