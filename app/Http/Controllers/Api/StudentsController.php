<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStudentRequest;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Flugg\Responder\Responder;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo 'exibir o estudante ' . $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        echo 'atualizar um estudante ' . $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo 'deletar um estudante ' . $id;
    }
}
