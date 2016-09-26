<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Circuit;

class CircuitController extends Controller {

public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['index', 'show']]);
    }

    public function index() {
        try {
            $circuits = Circuit::get()->toArray();
            return response()->json($circuits);
        }
            catch(Exception $e) {
            return response()->json(['message' => 'Echec de récupération'], 404);
        }
    }

    public function create() {

    }

    public function store() {
        $this->validate($request, [
        'nom' => 'required|alpha',
        // 'adresse_id' => 'required',
        // 'user_id' => 'required',
        // 'web' => 'required',
        // 'tel_fixe' => 'required',
        // 'tel_port' => 'required',
        ]);

        try {
            $circuit = New Circuit;
            $circuit->nom = $request->get('nom');
            $circuit->save();

            return response()->json(['circuit' => $circuit->toArray()],201);
        }
        catch(Exception $e) {
            return response()->json(['message' => 'Echec de création'], 404);
        }
    }

    public function show($id) {
        try {
            $circuit = Circuit::findOrFail($id);
            return response()->json(compact('circuit'));
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
            $circuit = Circuit::findOrFail($id);
            $circuit->delete();
            return response(204);
        }
        catch(Exception $e) {
            return response()->json(['Echec de suppression'], 404);
        }
    }
  
}

?>