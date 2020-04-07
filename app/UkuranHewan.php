<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UkuranHewan extends Model
{
    protected $table = 'ukuranHewans';
    protected $primaryKey = 'id_ukuranHewan';
    public $incrementing = false;
    public $timestamps = false;
}
