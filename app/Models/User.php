<?php

namespace App\Models;

use App\Helpers\StringHelper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles, \Laravel\Sanctum\HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'name2',
        'email',
        'avatar',
        'email_verified_at',
        'password',
        'last_login',
        'email_token',
        'verification_code',
        'is_locked',
        'phone_number',
        'birth_date',
        'address',
        'address2',
        'last_password_change',
        'twitter_id',
        'file_upload',
        'wrong_login',
        'is_active',
        'nib',
        'lokasi_kantor_url',
        'cop_surat', 
        'jabatan',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login' => 'datetime', 
            'last_password_change' => 'datetime',

        ];
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'avatar_url',
        'cop_surat_url' // <-- Tambahkan ini
    ];

    /**
     * add custom column avatar url
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            if (Storage::exists('public/avatars/' . $this->avatar)) {
                return asset('storage/avatars/' . $this->avatar);
            }
            if (StringHelper::isUrl($this->avatar)) {
                return $this->avatar;
            }
        }
        return null;
    }

    /**
     * add custom column cop surat url
     *
     * @return string
     */
    public function getCopSuratUrlAttribute()
    {
        if ($this->cop_surat) {
            if (Storage::exists('public/cop_surat/' . $this->cop_surat)) {
                return asset('storage/cop_surat/' . $this->cop_surat);
            }
        }
        return null;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // Helper untuk mengecek role (menggunakan Spatie Permissions)
    public function isAdmin()
    {
        return $this->hasRole('admin'); // Menggunakan Spatie Permissions
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('superadmin'); // Menggunakan Spatie Permissions
    }
}
