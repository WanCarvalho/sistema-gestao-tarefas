<?php

namespace App\Models;

use App\Enums\StatusTarefaEnum;
use App\Traits\HasSlugTrait;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
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

    public function getPrazoFinalAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    protected static function boot(): void
    {
        parent::boot();

        if (!app()->runningInConsole()) {  // Verifica se não está rodando no console
            static::creating(function (Tarefa $model) {
                // Verifica se há um usuário logado
                if (Auth::check()) {
                    $model->user_id = Auth::id();  // Usuario logado que cria a tarefa
                } else {
                    // Caso não tenha um usuário logado, use um usuário de fallback (exemplo, id 1)
                    $model->user_id = 1; // Ou qualquer id válido de usuário no seu sistema
                }

                $model->status = StatusTarefaEnum::EM_ANDAMENTO;

                // Verifica se não há responsável e atribui o responsável
                if (!$model->responsavel_id) {
                    $model->responsavel_id = $model->user_id; // Ou qualquer outro critério
                }
            });
        }
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
