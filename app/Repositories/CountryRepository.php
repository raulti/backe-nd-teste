<?php

namespace App\Repositories;

use App\Models\Country;

/**
 * Repositório resonsável por implementar inteirações com o banco de dados referente ao 'Country'.
 */
class CountryRepository
{

    protected $pessoa;

    public function __construct(Country $pessoa)
    {
        $this->pessoa = $pessoa;
    }

    /**
     * Insere ou altera registro na base de dados.
     *
     * @param Country $pessoa
     */
    public function salvar($pessoa)
    {
        $data = (array) $pessoa;

        if (empty($pessoa->id)) {
            return $this->pessoa->create($data);
        } else {
            $this->pessoa::find($pessoa->id)->update($data);
        }
    }

    /**
     * Inativa registro na base de dados.
     */
    public function inativar($id)
    {
        $this->pessoa
             ->find($id)
             ->update(['st_ativo' => false]);
    }
}
