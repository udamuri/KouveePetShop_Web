<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hewan extends Model
{
    protected $table = 'hewans';
    protected $primaryKey = 'id_hewan';
    public $incrementing = false;
    public $timestamps = false;
}
