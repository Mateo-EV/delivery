<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    public $currencies = [
        "SOL" => "S/.",
        "DÓLAR" => "$"
    ];

    protected $fillable = [
        "code",
        "payment",
        "currency",
        "amount",
        "document",
        "ndocument",
        "channel",
        "arrival"
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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function motorcyclist(){
        return $this->belongsTo(Motorcyclist::class, "motorcyclist_id", "user_id");
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function laboratory(){
        return $this->belongsTo(Laboratory::class);
    }

    public function getSymbolAttribute(){
        return $this->currencies[$this->currency];
    }
}
