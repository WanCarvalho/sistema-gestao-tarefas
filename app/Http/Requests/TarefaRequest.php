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
                'nullable',
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

    public function messages(): array
    {
        return [
            'responsavel_id.exists' => 'O responsável selecionado não existe.',

            'status.string' => 'O status deve ser um texto.',
            'status.in' => 'O status deve ser um dos seguintes valores: pendente, em andamento ou concluída.',

            'titulo.required' => 'O título da tarefa é obrigatório.',
            'titulo.string' => 'O título deve ser um texto.',
            'titulo.max' => 'O título não pode ter mais de 255 caracteres.',

            'descricao.string' => 'A descrição deve ser um texto.',
            'descricao.max' => 'A descrição não pode ter mais de 1000 caracteres.',

            'prioridade.required' => 'A prioridade é obrigatória.',
            'prioridade.string' => 'A prioridade deve ser um texto.',
            'prioridade.in' => 'A prioridade deve ser uma das seguintes opções: baixa, média ou alta.',

            'prazo_final.date' => 'O prazo final deve ser uma data válida.',
            'prazo_final.after_or_equal' => 'O prazo final deve ser hoje ou uma data futura.',
        ];
    }
}
