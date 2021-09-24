<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorcyclist extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = "user_id";

    protected $fillable = ["license", "model", "km"];

    public function orders(){
        return $this->hasMany(Order::class, "motorcyclist_id", "user_id");
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
