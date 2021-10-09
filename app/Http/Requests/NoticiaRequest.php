<?php

namespace App\Http\Requests;   

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NoticiaRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'titulo' => 'required',
            'conteudo' => 'required',
            'status' => [
                'required',
                Rule::in(['A', 'I'])
            ],
            'data_publicacao' => 'date_format:d/m/Y',
            'imagem' => 'nullable|image'
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'É obrigatório preencher o campo título.',
            'conteudo.required' => 'É obrigatório preencher o campo conteúdo.',
            'status.required' => 'É obrigatório preencher o campo status.',
            'data_publicacao.date_format' => 'O campo data da publicação é obrigatório.',
            'imagem.image' => 'Adicione uma imagem.',
            'status.in' => 'O status só pode ser Ativo ou Inativo.'
        ];
    }
}
