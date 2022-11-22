<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Bavix\Wallet\Traits\HasWallets;
use Bavix\Wallet\Traits\CanPay;
use Bavix\Wallet\Interfaces\Customer;

class User extends Authenticatable implements Customer
{
    use HasApiTokens, HasFactory, Notifiable, CanPay, HasWallets;

    const MEMBER = 1;
    const AGENT = 2;
    const BRANCH = 3;

    const TABLE = 'users';

    protected $table = self::TABLE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'account_id',
        'email',
        'loginID',
        'password',
        'currency',
        'accountLevel',
        'created_by',
        'deleted_by',
        'credit_limit',
        'join_date',
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

    public function accountLevel()
    {
        return (int) $this->accountLevel;
    }

    public function isBranch(): bool
    {
        return $this->accountLevel() === self::BRANCH;
    }

    public function isAgent(): bool
    {
        return $this->accountLevel() === self::AGENT;
    }
    
    public function isMember(): bool
    {
        return $this->accountLevel() === self::MEMBER;
    }

}
