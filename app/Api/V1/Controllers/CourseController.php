<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class CourseController extends Controller {

    public function __construct() {
        $this->middleware('api.auth', ['except' => ['index', 'show']]);
    }

    public function index() {
        try {
            $courses = Course::get()->toArray();
            return response()->json($courses);
        }
            catch(Exception $e) {
            return response()->json(['message' => 'Echec de récupération'], 404);
        }
    }

    public function create() {

    }

    public function store() {
        $this->validate($request, [
        'circuit' => 'required',
        'date' => 'required|date',
        'sens_inverse' => 'required',
        'annulee' => 'required',
        ]);

        try {
            $course = New Course;
            $course->circuit = $request->get('circuit');
            $course->date = $request->get('date');
            $course->sens_inverse = $request->get('sens_inverse');
            $course->annulee = $request->get('annulee');
            $course->save();

            return response()->json(['course' => $course->toArray()],201);
        }
        catch(Exception $e) {
            return response()->json(['message' => 'Echec de création'], 404);
        }
    }

    public function show($id) {
        try {
            $course = Course::findOrFail($id);
            return response()->json(compact('course'));
        }
        catch(Exception $e) {
            return response()->json(['message' => 'Echec de récupération'], 404);
        }
    }

    public function edit($id) {

    }

    public function update($id) {

    }

    public function destroy($id) {
        try {
            $course = Course::findOrFail($id);
            $course->delete();
            return response(204);
        }
        catch(Exception $e) {
            return response()->json(['Echec de suppression'], 404);
        }
    }
  
}

?>