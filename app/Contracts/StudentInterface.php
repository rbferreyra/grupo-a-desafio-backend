<?php

namespace App\Contracts;

interface StudentInterface
{
    public function getStudents(int $perPage, string $keywords = null);
    public function getStudent(string $id);
    public function createStudent(array $data);
    public function updateStudent(string $id, array $data);
    public function destroyStudent(string $id);
}
