<?php

/**
 * Generic Flickr REST API Client
 * 
 * @package third-party
 * @author Dan Trenz <dtrenz@gmail.com>
 */
class Flickr
{

	const URI = 'http://api.flickr.com/services/rest/';
	const APIKEY = '71646522feab100f095baf66932a8511';

	/**
	 * Generic API request client method
	 * 
	 * @param string $method 
	 * @param array $params 
	 * @return bool|array
	 */
	public function request( $method, $params )
	{
		$return = false; 

		$request_uri = self::URI . '?method=' . $method . '&api_key=' . self::APIKEY;

		if ( ! empty($params) ) {
			$request_uri .= '&' . http_build_query($params);
		}

		$response = file_get_contents($request_uri);

		if ( ! empty($response) ) {
			$return = unserialize($response);
		}

		return $return;
	}

	/**
	 * Utility method for creating a Flickr image URL from photo info
	 * 
	 * @param array $photo 
	 * @return string
	 */
	public static function create_image_url( $photo )
	{
		$params = array();
		$params[] = $photo['farm'];
		$params[] = $photo['server'];
		$params[] = $photo['id'];
		$params[] = $photo['secret'];

		return vsprintf( 'http://farm%s.staticflickr.com/%s/%s_%s_q.jpg', $params );
	}

}