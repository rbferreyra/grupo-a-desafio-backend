<?php

namespace App\Contracts;

interface StudentInterface
{
    public function getStudents(int $perPage, string $keywords = null);
    public function getStudent($id);
    public function createStudent(array $data);
    public function updateStudent($id, $data);
    public function destroyStudent($id);
}
