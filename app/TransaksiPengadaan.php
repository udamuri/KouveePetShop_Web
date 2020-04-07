<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPengadaan extends Model
{
    protected $table = 'pengadaans';
    protected $primaryKey = 'no_order';
    public $incrementing = false;
    public $timestamps = false;
}
