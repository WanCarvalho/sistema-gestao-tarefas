<?php

namespace App\Models;

use App\Traits\HasSlugTrait;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Tarefa extends Model
{
    use HasFactory, SoftDeletes, HasSlugTrait;

    protected $fillable = [
        'id',
        'user_id',
        'responsavel_id',
        'status',
        'titulo',
        'slug',
        'descricao',
        'prioridade',
        'prazo_final',
    ];

    public function getTitleColumnName()
    {
        return static::$titleColumnName ?? 'titulo';
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Tarefa $model) {
            $model->user_id = Auth::id();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsavel_id');
    }
}
