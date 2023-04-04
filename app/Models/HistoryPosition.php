<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryPosition extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function Employee()
    {
        return $this->belongsTo(User::class,'employee_id','employee_id');
    }

    public function Position()
    {
        return $this->belongsTo(Position::class,'position_id','id');

    }
}
