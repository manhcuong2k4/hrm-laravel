<?php

namespace App\Models;

// 1. Chỉ giữ lại Interface và Trait mới
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions; 

// --- XÓA DÒNG DƯỚI NÀY ĐI (Đây là nguyên nhân gây lỗi) ---
// use Laratrust\Traits\LaratrustUserTrait; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

// Class User implements LaratrustUser
class User extends Authenticatable implements LaratrustUser
{
    // --- XÓA DÒNG DƯỚI NÀY ĐI (Nguyên nhân gây lỗi) ---
    // use LaratrustUserTrait;

    // 2. CHỈ DÙNG DÒNG NÀY LÀ ĐỦ
    use HasRolesAndPermissions; 
    
    use HasFactory, Notifiable;
    // use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'avatar',
        'role'
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
}