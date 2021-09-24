<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "name",
        "dni",
        "telephone"
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

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function locations(){
        return $this->hasMany(Location::class);
    }
}
