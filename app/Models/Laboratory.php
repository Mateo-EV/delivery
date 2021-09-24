<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Laboratory extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $incremente = false;

    protected $fillable = ["name", "description"];

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
}
