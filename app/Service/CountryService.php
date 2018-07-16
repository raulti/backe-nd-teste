<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;

/**
 * Resonsável por consumir serviços de 'Country'.
 */
class CountryService
{
    //URL base para acesso a API da integra commerce
    const URL_UMASS_COUNTRYS = 'http://www.umass.edu/msicrobio/rasmol/country-.txt';

    //Nome do arquivo para cache
    const NAME_FILE_LOCAL = 'country.txt';

    /**
     * Recupera documento do tipo .txt contendo países.
     */
    public function getCountrys()
    {
        $this->saveLocalFile();

        $arrayCountries = [];

        if ($this->verificUrl()) {

            $arrayCountries = file(self::URL_UMASS_COUNTRYS, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES | FILE_TEXT);
        } else {
            $arrayCountries = $this->getLocalFile();
        }

        if (empty($arrayCountries)) {
            throw new \App\Exceptions\NotFoundmonException('Não foi possível acessar o arquivo externo!');
        }

        return $arrayCountries;
    }

    /**
     * Verifica se o arquivo está disponível para acesso.
     */
    public function verificUrl()
    {
        $isValid = false;

        $handle = curl_init(self::URL_UMASS_COUNTRYS);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);

        curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($httpCode >= 200 && $httpCode <= 400) {
            $isValid = true;
        }

        curl_close($handle);

        return $isValid;
    }

    /**
     * Retorna arquivo local, caso existe.
     */
    public function getLocalFile()
    {
        if (Storage::disk('local')->exists(self::NAME_FILE_LOCAL)) {
            $file = Storage::disk('local')->get(self::NAME_FILE_LOCAL);
            return explode("\n", $file);
        }
    }

    /**
     * Salva o arquivo de cache local, caso este exita.
     */
    public function saveLocalFile()
    {
        if (!Storage::disk('local')->exists(self::NAME_FILE_LOCAL) && $this->verificUrl()) {
            Storage::disk('local')->put(self::NAME_FILE_LOCAL, file(self::URL_UMASS_COUNTRYS));
        }
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