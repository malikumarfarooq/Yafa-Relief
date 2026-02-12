<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, LogsActivity, SoftDeletes;

    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'password',
        'user_type',
        'avatar',
        'phone',
        'bio',
        'is_active',
        'is_deletable',
        'mfa_enabled',
        'mfa_secret',
        'last_login_at',
        'last_login_ip',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'mfa_secret',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'mfa_enabled' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['f_name', 'l_name', 'email', 'is_active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope for filtering users by role (using Spatie's package)
     */
    public function scopeWithRole($query, $roleNameOrId = null)
    {
        if ($roleNameOrId && $roleNameOrId != '*') {
            $query->role($roleNameOrId); // Spatie built-in scope
        }
        return $query;
    }

    // Accessors
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->f_name . ' ' . $this->l_name) . '&color=F4F9F9&background=1F2A44';
    }

    public function getStatusBadgeAttribute(): string
    {
        return $this->is_active
            ? '<span class="badge bg-success">Active</span>'
            : '<span class="badge bg-danger">Inactive</span>';
    }

    public function updateLastLogin(): void
    {
        $this->update([
            'last_login_at' => now(),
            'last_login_ip' => request()->ip(),
        ]);
    }
    public function getRoleNameAttribute(): string
    {
        // $this->getRoleNames() returns a collection of role names
        $role = $this->getRoleNames()->first();
        return ucfirst($role ?? 'N/A');
    }
    public function getUserAddressAttribute(): array
    {
        // Assuming you have address fields like 'street', 'city', 'state', 'postal_code'
        $address = UserAddress::where('user_id', $this->id)->first();
        return $address ? $address->toArray() : [];
    }
    public function sendPasswordResetNotification($token)
    {
        $url = url(route('admin.reset-password', [
            'token' => $token,
            'email' => $this->getEmailForPasswordReset(),
        ], false));

        \Mail::to($this->email)->send(new \App\Mail\Admin\ForgotPassword($url));
    }
    public function address()
    {
        return $this->hasOne(\App\Models\UserAddress::class, 'user_id');
    }
}
