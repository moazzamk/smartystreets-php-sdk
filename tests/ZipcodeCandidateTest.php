<?php

use DDM\SmartyStreets\ZipcodeCandidate as Candidate;

class ZipcodeCandidateTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->candidate = new Candidate();

    }

    public function testSetData()
    {
        // arrange
        $expected = array(
            'inputIndex'  => 0,
            'zipcode'     => '90230',
            'zipcodeType' => 'S',
            'countyFips'  => '06037',
            'countyName'  => 'Los Angeles',
            'latitude'    => 33.996155,
            'longitude'   => -118.395494
        );

        // act
        $actual = $this->candidate->setData($expected)->toArray();

        // assert
        $this->assertEquals($expected, $actual, 'These should match');
    }

    public function testSetFromObject()
    {
        // arrange
        $responseJson = $this->getValidResponseJson();
        $response = json_decode($responseJson);

        $expected = array(
            'inputIndex'  => 0,
            'zipcode'     => '90230',
            'zipcodeType' => 'S',
            'countyFips'  => '06037',
            'countyName'  => 'Los Angeles',
            'latitude'    => 33.996155,
            'longitude'   => -118.395494
        );

        // act

        $this->candidate->setFromObject($response);
        $actual = $this->candidate->toArray();

        // assert
        $this->assertEquals($expected, $actual, 'Properties not set correctly');
    }

    protected function getValidResponseJson()
    {
        $responseJsonPartial = '
        {
            "zipcode": "90230",
            "zipcode_type": "S",
            "county_fips": "06037",
            "county_name": "Los Angeles",
            "latitude": 33.996155,
            "longitude": -118.395494
        }';

        return $responseJsonPartial;
    }
}
