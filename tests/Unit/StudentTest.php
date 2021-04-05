<?php

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('can fetch all students', function () {
    $students = Student::factory(20)->create();

    foreach ($students->toArray() as $student) {
        $this->assertDatabaseHas('students', $student);
    }

    $response = $this->getJson('/api/v1/students');
    $response->assertStatus(200)->assertJsonCount(20, 'data');
});

it('does not create a new student without empty field', function () {
    $response = $this->postJson('/api/v1/students', []);
    $response->assertStatus(422);
});

it('can create a student', function () {
    $attributes = Student::factory()->raw();

    $response = $this->postJson('/api/v1/students', $attributes);

    $data = [
        'status' => 201,
        'success' => true,
        'data' => [
            'uiid' => $attributes['id'],
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'cpf' => $attributes['cpf'],
            'ra' => $attributes['ra'],
            'date' => date('d/m/Y')
        ]
    ];

    $response->assertStatus(201)->assertJson($data);

    $this->assertDatabaseHas('students', $attributes);
});

it('can fetch a student', function () {
    $student = Student::factory()->create();

    $response = $this->getJson('/api/v1/students/' . $student['id']);

    $data = [
        'status' => 200,
        'success' => true,
        'data' => [
            'uiid' => $student['id'],
            'name' => $student['name'],
            'email' => $student['email'],
            'cpf' => $student['cpf'],
            'ra' => $student['ra'],
            'date' => $student['created_at']->format('d/m/Y')
        ]
    ];

    $response->assertStatus(200)->assertJson($data);
});

it('can update a student', function () {
    $student = Student::factory()->create();

    $newStudent = [
        'name' => 'Updated name student',
        'email' => $student['email'],
        'cpf' => $student['cpf'],
        'ra' => $student['ra'],
    ];

    $response = $this->putJson('/api/v1/students/' . $student['id'], $newStudent);

    $data = [
        'status' => 202,
        'success' => true,
        'data' => [
            'uiid' => $student['id'],
            'name' => $newStudent['name'],
            'email' => $newStudent['email'],
            'cpf' => $student['cpf'],
            'ra' => $student['ra'],
            'date' => $student['created_at']->format('d/m/Y')
        ]
    ];

    $response->assertStatus(202)->assertJson($data);

    $this->assertDatabaseHas('students', $newStudent);
});

it('can delete a student', function () {
    $student = Student::factory()->create();

    $response = $this->deleteJson('/api/v1/students/' . $student['id']);

    $response->assertStatus(204);

    $this->assertCount(0, Student::all());
});
