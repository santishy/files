<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Student;
use App\File;
class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $fileRule = 'required|file|max:2048';
         Validator::make($request->all(),
         [
           'name' => 'required',
           'birth_certificate' => $fileRule,
           'current_grade_report_card' => $fileRule,
           'previous_grade_report_card' => $fileRule,
           'curp' => $fileRule,
           'pic' => 'required|image|max:2048',
         ])->validate();

         $student = Student::create(['name' => $request->name]);

         $birthCertificate['path'] = $request->file('birth_certificate')->storeAs('actas',$student->id);
         $currentGradeReportCard['path'] = $request->file('current_grade_report_card')->storeAs('boletas_actuales',$student->id);
         $previousGradeReportCard['path'] = $request->file('previous_grade_report_card')->storeAs('boletas_ateriores',$student->id);
         $curp['path'] = $request->file('curp')->storeAs('curp',$student->id);
         $pic['path'] = $request->file('pic')->storeAs('pic',$student->id);

         $files = $student->files()->createMany([
           $birthCertificate,
           $currentGradeReportCard,
           $previousGradeReportCard,
           $curp,
           $pic
         ]);

         return response()->json(['files' => $files]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
