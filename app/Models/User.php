<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'is_active' => 'boolean',
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if user is editor
     */
    public function isEditor(): bool
    {
        return $this->hasRole('editor');
    }

    /**
     * Check if user is parent
     */
    public function isParent(): bool
    {
        return $this->hasRole('parent');
    }

    /**
     * Get the payments confirmed by this user.
     */
    public function confirmedPayments(): HasMany
    {
        return $this->hasMany(Payment::class, 'confirmed_by');
    }

    /**
     * Get parent's students (placeholder - would typically be a relationship)
     */
    public function students()
    {
        // In a real application, this would be a proper relationship
        // return $this->hasMany(Student::class, 'parent_id');
        return collect([
            (object) [
                'id' => 1,
                'name' => 'Ahmad Rizki',
                'student_id' => 'STD001',
                'class' => 'Grade 5A',
                'parent_id' => $this->id
            ],
            (object) [
                'id' => 2,
                'name' => 'Siti Nurhaliza',
                'student_id' => 'STD002',
                'class' => 'Grade 3B',
                'parent_id' => $this->id
            ]
        ]);
    }
}
