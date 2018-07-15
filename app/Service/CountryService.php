<?php
namespace App\Service;

/**
 * Resonsável por consumir serviços de 'Country'.
 */
class CountryService
{
    //URL base para acesso a API da integra commerce
    const URL_UMASS_COUNTRYS ='http://www.umass.edu/microbio/rasmol/country-.txt';

    /**
     * Recupera documento do tipo .txt contendo países.
     */
    public function getDocCountrys()
    {
        return file( self::URL_UMASS_COUNTRYS, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES | FILE_TEXT );
    }

    /**
     * Retorna nova instância de 'CountryService'
     *
     * @return CountryService
     */
    public static function newInstance()
    {
        return new CountryService();
    }
}