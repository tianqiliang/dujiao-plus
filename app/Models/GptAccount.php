<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class GptAccount extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'gpt_account';
    
}
