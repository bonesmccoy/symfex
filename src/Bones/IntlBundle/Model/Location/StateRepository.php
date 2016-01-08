<?php

namespace Bones\IntlBundle\Model\Location;


class StateRepository
{

    private $jsonData = '{"CA":{"AB":"Alberta","BC":"British Columbia","MB":"Manitoba","NB":"New Brunswick","NL":"Newfoundland","NT":"Northwest Territories","NS":"Nova Scotia","NU":"Nunavut","ON":"Ontario","PE":"Prince Edward Island","QC":"Quebec","SK":"Saskatchewan","YT":"Yukon Territory"},"US":{"AL":"Alabama","AK":"Alaska","AZ":"Arizona","AR":"Arkansas","CA":"California","CO":"Colorado","CT":"Connecticut","DE":"Delaware","DC":"District of Columbia","FL":"Florida","GA":"Georgia","HI":"Hawaii","ID":"Idaho","IL":"Illinois","IN":"Indiana","IA":"Iowa","KS":"Kansas","KY":"Kentucky","LA":"Louisiana","ME":"Maine","MD":"Maryland","MA":"Massachusetts","MI":"Michigan","Mn":"Minnesota","MS":"Mississippi","MO":"Missouri","MT":"Montana","NE":"Nebraska","NV":"Nevada","NH":"New Hampshire","NJ":"New Jersey","NM":"New Mexico","NY":"New York","NC":"North Carolina","ND":"North Dakota","OH":"Ohio","OK":"Oklahoma","OR":"Oregon","PA":"Pennsylvania","RI":"Rhode Island","SC":"South Carolina","SD":"South Dakota","TN":"Tennessee","TX":"Texas","UT":"Utah","VT":"Vermont","VA":"Virginia","WA":"Washington","WV":"West Virginia","WI":"Wisconsin","WY":"Wyoming"},"AU":{"ACT":"Australian Capital Territory","NSW":"New South Wales","NT":"Northern Territory","QLD":"Queensland","SA":"South Australia","TAS":"Tasmania","VIC":"Victoria","WA":"Western Australia"}}';


    /**
     * @var State[]
     */
    private $states = array();

    public function __construct()
    {
        $arrayStates = json_decode($this->jsonData, 1);

        foreach($arrayStates as $countryCode => $states) {
            foreach($states as $stateCode => $name) {
                $this->states[$countryCode][$stateCode] = new State($stateCode, $name, $countryCode);
            }

        }
    }

    public function findAll()
    {
        return $this->states;
    }

    /**
     * @param $countryCode
     * @return State[]
     */
    public function findAllByCountryCode($countryCode)
    {
        return isset($this->states[$countryCode]) ? $this->states[$countryCode] : array();
    }

    /**
     * @param $stateCode
     * @param $countryCode
     * @return State
     */
    public function findOneByCodeAndCountryCode($stateCode, $countryCode)
    {
        return isset($this->states[$countryCode][$stateCode]) ? $this->states[$countryCode][$stateCode] : null;
    }
}
