<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipCodes extends Model
{
    use HasFactory;

    protected $table = "zip_codes";

    protected $fillable = [
        'zip_code',
        'locality',
        'federal_entity',
        'settlements',
        'municipality',
    ];

    protected $casts = [
        'federal_entity' => 'array',
        'settlements'    => 'array',
        'municipality'   => 'array'
    ];

    public function getFederalEntityAttribute($value){
        return json_decode($value);
    }

    public function getSettlementsAttribute($value){
        return json_decode($value);
    }

    public function getMunicipalityAttribute($value){
        return json_decode($value);
    }

    public function setFederalEntityAttribute($value){
        $this->attributes['federal_entity'] =  json_encode($value);
    }

    public function setSettlementsAttribute($value){
        $this->attributes['settlements'] =  json_encode($value);
    }

    public function setMunicipalityAttribute($value){
        $this->attributes['municipality'] =  json_encode($value);
    }
}
