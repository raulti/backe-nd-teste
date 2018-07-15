<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Responsável por 'Country'.
 */
class Country extends Model
{

    protected $table = 'country';

    public $fillable = [
        'status_backup'
    ];

    public $name;

    public $initial;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getInitial()
    {
        return $this->initial;
    }

    /**
     * @param mixed $initial
     */
    public function setInitial($initial): void
    {
        $this->initial = $initial;
    }
}