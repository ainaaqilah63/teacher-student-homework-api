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

    protected $fillable = [
        'name',
        'role_id',
        'username',
        'email',
        'phone_no',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function isTeacher()
    {
        return $this->tokens->where('name', 'teacher-token')->isNotEmpty();
    }

    public function isStudent()
    {
        return $this->tokens->where('name', 'student-token')->isNotEmpty();
    }

    public function teacherHomeworks()
    {
        return $this->hasMany(Homework::class, 'teacher_id');
    }

    public function studentHomeworks()
    {
        return $this->hasMany(Homework::class, 'student_id');
    }
}
