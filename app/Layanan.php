<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanans';
    protected $primaryKey = 'id_layanan';
    public $timestamps = false;
    public $incrementing = false;
}
