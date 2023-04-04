<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function Employee()
    {
        return $this->hasMany(User::class);
    }

    public function HistoryDivision()
    {
        return $this->hasMany(HistoryDivision::class);
    }
}
