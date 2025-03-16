<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
    ];

    public function membros()
    {
        return $this->belongsToMany(User::class);
    }

    public function gestores()
    {
        return $this->belongsToMany(User::class)->wherePivot('role', 'gestor');
    }
}
