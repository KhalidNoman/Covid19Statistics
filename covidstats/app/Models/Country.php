<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;


class Country extends Model
{
    public $timestamps = false;
    public $keyType = 'string';

    protected $table = 'country';
    protected $fillable = [
        'Country',
        'CountryCode',
        'Date',
        'id',
        'NewConfirmed',
        'NewDeaths',
        'NewRecovered',
        'Slug',
        'TotalConfirmed',
        'TotalDeaths',
        'TotalRecovered',
    ];
}
