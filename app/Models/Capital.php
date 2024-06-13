<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Capital extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'dj_capitals';
    
}
