<?php
namespace Tripster;

class TripsterApi
{
	/*
	 * URL fro RestAPI
	 */
	const URL = 'http://experience.tripster.ru/partner/';

	/**
	 * Partner marker
	 * @var string
	 * @access private
	 */
	private $partner;
	
	/**
	 * Class constructor
	 * @param string $partner
	 * @return void
	 * @access public
	 * @final
	 */
	final public function __construct($partner)
	{
		$this->partner = $partner;
	}
	
	/**
	 * Get all cities from tripster.ru
	 * @return array
	 * @access public
	 * @final
	 */
	final public function getCities()
	{
		return $this->curlRequest('v1/cities_iata');
	}
	
	/**
	 * Get info by city IATA
	 * @param string $iata
	 * @param boolean $shortText
	 * @return array
	 * @access public
	 * @final
	 */
	final public function getCity($iata, $shortText = false)
	{
		return $this->curlRequest('', [
			'iata' => strtoupper($iata),
			'template' => 'json',
			'order' => 'top',
			'short_text' => $shortText?'true':'false',
			'partner' => $this->partner
		]);
	}

	/**
	 * Execution of the request
	 * @param string $path
	 * @param array $parameters
	 * @return mixed
	 * @access private
	 */
	private function curlRequest($path, $parameters = null)
	{
		$url = self::URL.$path;
		
		$result = file_get_contents($url);
		
		return $result;
	}
}
