<?php

namespace App\Admin\Repositories;

use App\Models\Capital as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Capital extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
