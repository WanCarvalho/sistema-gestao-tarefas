<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarefaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'responsavel_id' => [
                'nullable',
                'exists:users,id',
            ],
            'status' => [
                'required',
                'string',
                'in:pendente,em_andamento,concluida',
            ],
            'titulo' => [
                'required',
                'string',
                'max:255',
            ],
            'descricao' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'prioridade' => [
                'required',
                'string',
                'in:baixa,media,alta',
            ],
            'prazo_final' => [
                'nullable',
                'date',
                'after_or_equal:today',
            ],
        ];
    }
}
