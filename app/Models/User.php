<?php

namespace App\Models;

use App\Mail\RegistrationMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
    ];

    /**
     * @return void
     */
    public function sendRegistrationMail(): void
    {
        Mail::to($this->email)->send(new RegistrationMail($this));
    }

    /**
     * @return HasOne
     */
    public function userCountry(): HasOne
    {
        return $this->hasOne(UserCountry::class);
    }

    /**
     * @return HasOne
     */
    public function phoneBook(): HasOne
    {
        return $this->hasOne(PhoneBook::class);
    }
}
