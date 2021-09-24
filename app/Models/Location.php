<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        "address",
        "province",
        "district",
        "reference"
    ];

    protected $keyType = 'string';

    protected $incremente = false;

    protected static function boot(){
        parent::boot();

        static::creating(function($model){
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function orders(){
        return $this->hasMany(Oreder::class);
    }
}
