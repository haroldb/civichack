<?php
namespace RateMyLandlord;

require_once 'guzzle.phar';

use Guzzle\Http\Client;

class Rating
{
    const API_KEY = 'L7H8-NU6V-BYBS-9L2L';
    const API_URL = 'https://dock2014.wufoo.com';
    const API_PATH = '/api/v3/forms/rate-my-landlord/entries.json';

    public $entryId;
    public $dateCreated;
    public $streetAddress;
    public $postcode;
    public $email;
    public $occupants;
    public $timeToRespond;
    public $qualityOfSolution;
    public $location;
    public $propertyCondition;
    public $communication;

    function __construct() {
        $this->entryId = -1;
        $this->dateCreated = '';
        $this->streetAddress = '';
        $this->postcode = '';
        $this->email = '';
        $this->occupants = 0;
        $this->timeToRespond = 0;
        $this->qualityOfSolution = 0;
        $this->location = 0;
        $this->propertyCondition = 0;
        $this->communication = 0;
    }

    private function populate($result)
    {
        $this->entryId = $result->EntryId;
        $this->dateCreated = $result->DateCreated;
        $this->streetAddress = $result->Field1;
        $this->postcode = $result->Field5;
        $this->email = $result->Field22;
        $this->occupants = $result->Field25;
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

        return array_reverse($ratings);
    }

    public static function getSearchResults($postcode)
    {
        $client = new Client(self::API_URL);
        $request = $client->get(self::API_PATH)->setAuth(self::API_KEY, 'footastic');
        $response = $request->send();
        $json = $response->getBody();
        $results = json_decode($json);

        $ratings = array();

        foreach ($results->Entries as $result)
        {
            //filter
            $postcodeTosearch = strtolower(preg_replace('/\s+/', '', $postcode));
            $postcodeTosearchAgainst = strtolower(preg_replace('/\s+/', '', $result->Field5));          
            if (strpos($postcodeTosearchAgainst, substr($postcodeTosearch, 0, 3)) !== 0) {
                continue;
            }
 
            $rating = new self();
            $rating->populate($result);
            $ratings[] = $rating;
        }

        return $ratings;
    }

    public static function getRatingByID($entryID)
    {
        $client = new Client(self::API_URL);
        $request = $client->get(self::API_PATH)->setAuth(self::API_KEY, 'footastic');
        $response = $request->send();
        $json = $response->getBody();
        $results = json_decode($json);

        $ratings = array();

        foreach ($results->Entries as $result)
        {
            if ($entryID !== $result->EntryId) {
                continue;
            }

            $rating = new self();
            $rating->populate($result);
            $ratings[] = $rating;
        }

        return $ratings;
    }
}
