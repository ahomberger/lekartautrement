<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trophee;

class TropheeController extends Controller {

    public function __construct() {
        $this->middleware('api.auth', ['except' => ['index', 'show']]);
    }

    public function index() {
        try {
            $trophees = Trophee::get()->toArray();
            return response()->json($trophees);
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
            $trophee = New Trophee;
            $trophee->circuit = $request->get('circuit');
            $trophee->date = $request->get('date');
            $trophee->sens_inverse = $request->get('sens_inverse');
            $trophee->annulee = $request->get('annulee');
            $trophee->save();

            return response()->json(['course' => $trophee->toArray()],201);
        }
        catch(Exception $e) {
            return response()->json(['message' => 'Echec de création'], 404);
        }
    }

    public function show($id) {
        try {
            $trophee = Trophee::findOrFail($id);
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
            $trophee = Trophee::findOrFail($id);
            $trophee->delete();
            return response(204);
        }
        catch(Exception $e) {
            return response()->json(['Echec de suppression'], 404);
        }
    }
  
}

?>