<?php

namespace App\Http\Controllers;

use App\BO\CountryBO;
use App\Models\Country;
use App\Exports\InvoicesExport;

use Maatwebsite\Excel\Excel;



/**
 * Classe de controle referente a entidade 'Country'.
 *
 * @author Raul Oliveira
 */
class CountryController extends Controller
{

    private $countryBO;

    private $country;

    private $excel;

    public function __construct(CountryBO $countryBO, Country $country, \Maatwebsite\Excel\Exporter $excel)
    {
        $this->country = $country;
        $this->countryBO = $countryBO;
        $this->excel = $excel;
    }

    /**
     * Retorna lista de países.
     */
    public function getCountrys()
    {
        try{
            return $this->fileToArrayContrys();
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    /**
     * Gera arquivo no formato .csv.
     */
    public function makeCsv(Excel $excel)
    {
        $export = new InvoicesExport($this->fileToArrayContrys());
        return $excel->download($export, 'invoices.csv');
    }

    /**
     * Gera arquivo no formato .xlsx.
     */
    public function makeXlsx(Excel $excel)
    {
        $export = new InvoicesExport($this->fileToArrayContrys());
        return $excel->download($export, 'invoices.xlsx');
    }

    /**
     * Converte o arquivo .txt contendo a lista de países em array.
     */
    public function fileToArrayContrys()
    {
        try{

            $file = $this->countryBO->getCountrys();

            $countries = [];
            foreach ($file as $data){

                $line = explode('   ', $data);
                if(count($line) == 2){

                    $this->country->setName($line[1]);
                    $this->country->setInitial($line[0]);

                    array_push($countries, [
                        'initial' => $this->country->getInitial(),
                        'name' => $this->country->getName()
                    ]);
                }
            }

            $countries = array_reverse($countries);

            return array_slice($countries, 9);
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
