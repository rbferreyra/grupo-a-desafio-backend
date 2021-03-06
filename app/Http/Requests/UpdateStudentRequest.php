<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Log;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => ['required', 'min:3', 'max:100'],
            'email' => ['required', 'email'],
            'cpf'   => ['required', 'min:11', 'max:14'],
            'ra'    => ['required', 'min:6', 'max:20', 'unique:students,ra,' . $this->route('id') . ',id'],
        ];
    }

    public function attributes()
    {
        return [
            'name'  => 'Nome',
            'email' => 'E-mail',
            'cpf'   => 'CPF',
            'ra'    => 'RA',
        ];
    }
}
