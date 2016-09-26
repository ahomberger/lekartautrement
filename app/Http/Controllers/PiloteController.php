<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pilote;

class PiloteController extends Controller {

    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['index', 'show']]);
    }

    public function index() {
        try {
            $pilotes = Pilote::get()->toArray();
            return response()->json($pilotes);
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
            $pilote = New Course;
            $pilote->circuit = $request->get('circuit');
            $pilote->date = $request->get('date');
            $pilote->sens_inverse = $request->get('sens_inverse');
            $pilote->annulee = $request->get('annulee');
            $pilote->save();

            return response()->json(['pilote' => $pilote->toArray()],201);
        }
        catch(Exception $e) {
            return response()->json(['message' => 'Echec de création'], 404);
        }
    }

    public function show($id) {
        try {
            $pilote = Pilote::findOrFail($id);
            return response()->json(compact('pilote'));
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
            $pilote = Pilote::findOrFail($id);
            $pilote->delete();
            return response(204);
        }
        catch(Exception $e) {
            return response()->json(['Echec de suppression'], 404);
        }
    }
  
}

?>