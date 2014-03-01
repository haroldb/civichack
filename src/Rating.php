<?php
namespace RateMyLandlord;

require_once 'guzzle.phar';

use Guzzle\Http\Client;

class Rating
{
    const API_KEY = 'L7H8-NU6V-BYBS-9L2L';
    const API_URL = 'https://dock2014.wufoo.com';
    const API_PATH = '/api/v3/forms/rate-my-landlord/entries.json';

    public $streetAddress;
    public $postcode;
    public $email;
    public $timeToRespond;
    public $qualityOfSolution;
    public $location;
    public $propertyCondition;
    public $communication;

    function __construct() {
        $this->streetAddress = '';
        $this->postcode = '';
        $this->email = '';
        $this->timeToRespond = 0;
        $this->qualityOfSolution = 0;
        $this->location = 0;
        $this->propertyCondition = 0;
        $this->communication = 0;
    }

    private function populate($result)
    {
        $this->streetAddress = $result->Field1;
        $this->postcode = $result->Field5;
        $this->email = $result->Field22;
        $this->timeToRespond = $result->Field13;
        $this->qualityOfSolution = $result->Field14;
        $this->location = $result->Field17;
        $this->propertyCondition = $result->Field16;
        $this->communication = $result->Field20;
    }

    public static function getRatings()
    {
        $client = new Client(self::API_URL);
        $request = $client->get(self::API_PATH)->setAuth(self::API_KEY, 'footastic');
        $response = $request->send();
        $json = $response->getBody();
        $results = json_decode($json);

        $ratings = array();

        foreach ($results->Entries as $result)
        {
            $rating = new self();
            $rating->populate($result);
            $ratings[] = $rating;
        }

        return $ratings;
    }
}
