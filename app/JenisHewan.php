<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisHewan extends Model
{
    protected $table = 'jenisHewans';
    protected $primaryKey = 'id_jenisHewan';
    public $incrementing = false;
    public $timestamps = false;
}
