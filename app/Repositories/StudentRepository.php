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

    public function getStudent(string $id)
    {
        return $this->entity::find($id);
    }

    public function createStudent(array $data): Student
    {
        return $this->entity->create($data);
    }

    public function updateStudent(string $id, array $data)
    {
        $student = $this->getStudent($id);
        $student->update($data);
        return $student;
    }

    public function destroyStudent($id)
    {
    }
}
