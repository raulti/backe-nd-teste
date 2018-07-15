<?php

namespace App\Http\Controllers;

use App\BO\CountryBO;
use App\Models\Country;

/**
 * Classe de controle referente a entidade 'Country'.
 *
 * @author Raul Oliveira
 */
class CountryController extends Controller
{

    private $countryBO;

    private $country;

    public function __construct(CountryBO $countryBO, Country $country)
    {
        $this->country = $country;
        $this->countryBO = $countryBO;
    }

    /**
     * Retorna lista de países.
     */
    public function getCountrys()
    {
        try{
            $file = $this->countryBO->getCountrys();

            $countrys = [];
            foreach ($file as $data){

                $line = explode('   ', $data);
                if(count($line) == 2){
                    $this->country->setName($line[1]);
                    $this->country->setInitial($line[0]);

                    $country = [
                        'name' => $this->country->getName(),
                        'initial' => $this->country->getInitial()
                    ];

                    array_push($countrys, $country);
                }
            }

            return $countrys;
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
