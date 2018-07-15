<?php

namespace App\BO;

use App\Models\Country;
use App\Service\CountryService;
use App\Repositories\CountryRepository;

/**
 * Resonsável por implementar as regras de negócio referênte a 'Country'
 */
class CountryBO
{
    private $countryService;
    private $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryService = CountryService::newInstance();
        $this->countryRepository = $countryRepository;
    }

    /**
     * Retorna lista de países.
     */
   public function getCountrys(){
       return $this->countryService->getDocCountrys();
   }
}
