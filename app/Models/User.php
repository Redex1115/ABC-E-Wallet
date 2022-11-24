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
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Wallet
{
    use HasApiTokens, HasFactory, Notifiable, HasWallet, HasWallets, HasRoles;

    const MEMBER = 4;
    const AGENT = 3;
    const BRANCH = 2;
    const ADMIN = 1;

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
    
    public function accLevel()
    {
        return (int) $this->accountLevel;
    }

    public function isAdmin(): bool
    {
        return $this->accLevel() === self::ADMIN;
    }

    public function isAgent(): bool
    {
        return $this->accLevel() === self::AGENT;
    }

    public function isMember(): bool
    {
        return $this->accLevel() === self::MEMBER;
    }

    public function isBranch(): bool
    {
        return $this->accLevel() === self::BRANCH;
    }

    public function subparent(){

        return $this->hasMany('App\Models\User', 'created_by');

    }
}
