<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Exports\InvoicesExport;

use Maatwebsite\Excel\Excel;
use App\Service\CountryService;


/**
 * Classe de controle referente a entidade 'Country'.
 *
 * @author Raul Oliveira
 */
class CountryController extends Controller
{

    private $country;

    private $countryService;

    public function __construct(Country $country)
    {
        $this->country = $country;
        $this->countryService = CountryService::newInstance();
    }

    /**
     * Retorna lista de países.
     */
    public function getCountrys()
    {
        try {

            return $this->fileToArrayContrys();
        } catch (\App\Exceptions\NotFoundmonException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Gera arquivo no formato .csv.
     */
    public function makeCsv(Excel $excel)
    {
        try {

            $export = new InvoicesExport($this->fileToArrayContrys());
            return $excel->download($export, 'invoices.csv');
        } catch (\App\Exceptions\NotFoundmonException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Gera arquivo no formato .xlsx.
     */
    public function makeXlsx(Excel $excel)
    {
        try {

            $export = new InvoicesExport($this->fileToArrayContrys());
            return $excel->download($export, 'invoices.xlsx');
        } catch (\App\Exceptions\NotFoundmonException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Converte o arquivo .txt contendo a lista de países em array.
     */
    public function fileToArrayContrys()
    {
        try {

            $file = $this->countryService->getCountrys();

            $countries = [];
            foreach ($file as $data) {

                $line = explode('   ', $data);
                if (count($line) == 2) {

                    $this->country->setName($line[1]);
                    $this->country->setInitial($line[0]);

                    array_push($countries, [
                        'initial' => $this->country->getInitial(),
                        'name' => $this->country->getName(),
                        'br' => '(BR) BRASIL'
                    ]);
                }
            }

            $countries = array_reverse($countries);

            return array_slice($countries, 9);
        } catch (\App\Exceptions\NotFoundmonException $e) {
            return $e->getMessage();
        }
    }
}
