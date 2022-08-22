<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteEndereco extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cliente() {
        return $this->belongsTo('App\Models\Cliente');
    }
}
