<?php

namespace App\Admin\Repositories;

use App\Models\GptAccount as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class GptAccount extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
