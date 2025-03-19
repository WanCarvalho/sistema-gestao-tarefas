<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipe extends Model
{
    use SoftDeletes, HasFactory;

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
