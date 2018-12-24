<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    /**
     * @var array
     */
    protected $fillable = [ 'name', 'address', 'phone' ];
}
