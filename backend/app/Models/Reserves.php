<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserves extends Model
{
    protected $table = 'reserves';

    protected $fillable = [
        'data',
        'id_user',
        'id_service',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class);
    }

    public function service()
    {
        return $this->belongsTo(Services::class);
    }
}
