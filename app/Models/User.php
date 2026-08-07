<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // =============================================
    // RELASI KE DOSEN
    // =============================================

    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }

    // =============================================
    // CEK ROLE
    // =============================================

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin_lppm');
    }

    public function isReviewer(): bool
    {
        return $this->hasRole('reviewer');
    }

    public function isDosen(): bool
    {
        return $this->hasRole('dosen');
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isInactive(): bool
    {
        return $this->status === 'inactive';
    }

    // =============================================
    // ACCESSOR
    // =============================================

    public function getInitialAttribute(): string
    {
        $words = explode(' ', $this->name);
        $initial = '';
        foreach ($words as $word) {
            if (!empty($word)) {
                $initial .= strtoupper($word[0]);
            }
        }
        return substr($initial, 0, 2);
    }

    public function getRoleLabelAttribute(): string
    {
        $roles = $this->getRoleNames();
        return $roles->first() ?? 'Unknown';
    }

    public function getRoleBadgeAttribute(): string
    {
        $colors = [
            'super_admin' => 'bg-purple-100 text-purple-800',
            'admin_lppm' => 'bg-rose-100 text-rose-800',
            'reviewer' => 'bg-amber-100 text-amber-800',
            'dosen' => 'bg-blue-100 text-blue-800',
        ];

        $role = $this->getRoleNames()->first() ?? 'unknown';
        $color = $colors[$role] ?? 'bg-gray-100 text-gray-800';
        $label = ucwords(str_replace('_', ' ', $role));

        return '<span class="px-2.5 py-1 rounded-full text-xs font-medium ' . $color . '">' . $label . '</span>';
    }

    public function getStatusBadgeAttribute(): string
    {
        if ($this->status === 'active') {
            return '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                        Aktif
                    </span>';
        }
        return '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-700">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                    Tidak Aktif
                </span>';
    }
}