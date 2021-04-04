<?php

namespace App\Repositories;

use App\Contracts\StudentInterface;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentRepository implements StudentInterface
{
    protected $entity;
    protected $request;

    public function __construct(Student $student, Request $request)
    {
        $this->entity = $student;
        $this->request = $request;
    }

    public function getStudents(int $perPage, string $keywords = null): LengthAwarePaginator
    {
        return $this->entity->where(function ($query) use ($keywords) {
            if ($keywords) {
                $query->where('name', 'like', "%${keywords}%")
                    ->orWhere('email', 'like', "%${keywords}%")
                    ->orWhere('ra', 'like', "%${keywords}%")
                    ->orWhere('cpf', 'like', "%${keywords}%");
            }
        })
            ->paginate($perPage)
            ->appends($this->request->query());
    }

    public function getStudent($id)
    {
    }

    public function createStudent($data)
    {
    }

    public function updateStudent($id, $data)
    {
    }

    public function destroyStudent($id)
    {
    }
}
