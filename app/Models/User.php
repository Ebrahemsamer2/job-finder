<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    CONST EMPLOYEE = 'employee';
    CONST EMPLOYER = 'employer';

    private string $employer_default_image = 'assets/img/user/default-company.png';
    private string $employee_default_image = 'assets/img/user/user-default.jpg';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'web',
        'summery',
        'email',
        'user_type',
        'password',
        'avatar',
        'resume',
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
        'password' => 'hashed',
    ];

    public function getAvatar() {
        return $this->avatar ?? ($this->user_type === 'employer' ? asset($this->employer_default_image) : asset($this->employee_default_image));
    }

    // Relations
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function applications() {
        return $this->belongsToMany(Job::class, 'job_applications')->withTimestamps();
    }

}
