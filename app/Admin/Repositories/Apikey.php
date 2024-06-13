<?php

namespace App\Admin\Repositories;

use App\Models\Apikey as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Apikey extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
