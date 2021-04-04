<?php

namespace App\Transformers;

use App\Models\Student;
use Flugg\Responder\Transformers\Transformer;

class StudentTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param  \App\Models\Student $student
     * @return array
     */
    public function transform(Student $student)
    {
        return [
            'uiid'  => $student->id,
            'name'  => $student->name,
            'email' => $student->email,
            'cpf'   => $student->cpf,
            'ra'    => $student->ra,
            'date' => $student->created_at->format('d/m/Y'),
        ];
    }
}
