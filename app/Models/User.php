<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\LandDistribution\District;
use App\Models\UserSettings\Role;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use \OwenIt\Auditing\Auditable; 

    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'password',
        'img',
        'status',
        'district_id',
        'first_login',
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
        ];
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }
    public function district()
    {
        return $this->hasOne(District::class, 'id', 'district_id')->where('name_da', 'like', '%ناحیه%');
    }
    public function hasRole($role)
    {

        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        //
        //        foreach ($role as $r) {
        //            if($this->hasRole($r->name)) {
        //                return true;
        //            }
        //        }
        //        return false;

        return !!$role->intersect($this->roles)->count();
    }


    public function isOnline()
    {
        $sessionLifetime = config('session.lifetime'); // مقدار به دقیقه

        return DB::table('sessions')
            ->where('user_id', $this->id)
            ->where('last_activity', '>=', Carbon::now()->subMinutes($sessionLifetime)->timestamp)
            ->exists();
    }
}
