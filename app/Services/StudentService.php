<?php

namespace App\Services;

use App\Contracts\StudentInterface;

class StudentService
{
    private $repository;

    public function __construct(StudentInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getStudents(int $perPage, string $keywords = null)
    {
        return $this->repository->getStudents($perPage, $keywords);
    }

    public function createStudent(array $data)
    {
        return $this->repository->createStudent($data);
    }
}
