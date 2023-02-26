<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Empty_;

class Salary extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
