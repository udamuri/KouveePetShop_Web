<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawais';
    protected $primaryKey = 'NIP';
    public $timestamps = false;
    public $incrementing = false;
}