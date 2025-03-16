<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function tarefas(): HasMany
    {
        return $this->hasMany(Tarefa::class);
    }

    public function equipes()
    {
        return $this->belongsToMany(Equipe::class)->withPivot('role');
    }

    public function isGestorOf(Equipe $equipe)
    {
        return $this->equipes()->wherePivot('role', 'gestor')->where('equipe_id', $equipe->id)->exists();
    }

    public function isMembroOf(Equipe $equipe)
    {
        return $this->equipes()->wherePivot('role', 'membro')->where('equipe_id', $equipe->id)->exists();
    }
}
