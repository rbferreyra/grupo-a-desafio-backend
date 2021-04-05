<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Services\StudentService;
use Exception;
use Flugg\Responder\Responder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentsController extends Controller
{

    protected $studentService;
    protected $responder;

    public function __construct(StudentService $studentService, Responder $responder)
    {
        $this->studentService = $studentService;
        $this->responder = $responder;;
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->get('perPage', 20);
        $keywords = (string) strip_tags($request->get('keywords'));

        $students = $this->studentService->getStudents($perPage, $keywords);

        return $this->responder->success($students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateStudentRequest  $request
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder
     */
    public function store(CreateStudentRequest $request)
    {
        $data = $request->all();

        $student = $this->studentService->createStudent($data);

        return $this->responder->success($student)->respond(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder
     */
    public function show($id)
    {
        try {
            $student = $this->studentService->getStudent($id);

            if (!$student) {
                return $this->responder->error(404, 'Student not found or not exists!')->respond(404);
            }

            return $this->responder->success($student);
        } catch (Exception $e) {
            Log::error($e);
            return $this->responder->error(500, 'An error occurred while trying to fetch the student!')->respond(500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  string  $id
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        try {
            $student = $this->studentService->getStudent($id);

            if (!$student) {
                return $this->responder->error(404, 'Student not found or not exists!')->respond(404);
            }

            $data = $request->all();
            
            //não atualizar o ra
            unset($data['ra']);

            //não atualizar o cpf
            unset($data['cpf']);

            $newStudent = $this->studentService->updateStudent($id, $data);

            return $this->responder->success($newStudent)->respond(202);
        } catch (Exception $e) {
            Log::error($e);
            return $this->responder->error(500, 'An error occurred while trying to update the student!')->respond(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder
     */
    public function destroy($id)
    {
        if ($this->studentService->destroyStudent($id)) {
            return $this->responder->success()->respond(204);
        } else {
            return $this->responder->error(500, 'An error occurred while trying to delete the student!')->respond(500);
        }
    }
}
