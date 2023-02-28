<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $dates = ['deleted_at'];

    public function PaidLeave()
    {
        return $this->hasMany(PaidLeave::class);
    }

    public function HistoryPosition()
    {
        return $this->hasMany(HistoryPosition::class);
    }

    public function HistoryDivision()
    {
        return $this->hasMany(HistoryDivision::class);
    }

    public function Manager()
    {
        return $this->hasMany(Employee::class);
    }

    public function WarningLatter()
    {
        return $this->hasMany(WarningLatter::class);
    }

    public function Position()
    {
        return $this->belongsTo(Position::class, 'pisition_id', 'id');
    }

    public function Division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function Subordinate()
    {
        return $this->belongsTo(Employee::class, 'manager_id', 'id');
    }
}
