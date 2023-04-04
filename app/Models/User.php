<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function Division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }
}
